<?php

namespace App\Http\Controllers;

use App\Models\ExtraFee;
use App\Models\Payment;
use App\Models\PaymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentDetailController extends Controller
{
    public function index(Request $request)
    {
        $query = PaymentDetail::with('payment');

        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('payment.name', 'like', '%' . $search . '%');
        }

        $paymentdetails = $query->orderBy('payment_id', 'asc')
                                ->orderBy('id', 'asc')
                                ->paginate(5);

        $payments = Payment::get();
        $paymentdetails->getCollection()->transform(function ($item) use ($payments) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'description' => $item->description,
                'icon_link' => $item->icon_link,
                'payment_name' => $item->payment->name,
                'has_extra_fee' => $item->extrafees()->exists() ? 'Yes' : 'No',
                'payments' => $payments
            ];
        });


        return view('admin.paymentdetails', compact('paymentdetails', 'payments'));
    }

    public function store(Request $request)
    {

        \Log::info($request->all());

        try {
            DB::beginTransaction();

            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'payment' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            ]);

            $image = $request->file('image');
            $imageName = $request->name . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('img/paymentdetails', $imageName);

            $paymentdetail = PaymentDetail::create([
                'name' => $request['name'],
                'description' => $request['description'],
                'payment_id' => $request['payment'],
                'icon_link' => asset('storage') . '/' . $imagePath
            ]);

            if ($request->has('extra_fee') && $request->extra_fee === 'on') {
                $request->validate([
                    'extra_fee_name' => 'required|string|max:255',
                    'extra_fee_percentage' => 'required|numeric|min:0|max:100'
                ]);
                ExtraFee::create([
                    'name' => $request['extra_fee_name'],
                    'percentage' => $request['extra_fee_percentage'],
                    'payment_detail_id' => $paymentdetail->id
                ]);
            }

            DB::commit();
            return redirect()->route('paymentdetails.index')->with('success', 'Payment Details added successfully!');
        } catch (\Exception $e) {

            DB::rollBack();
            \Log::error('Error creating payment detail: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Could not add payment detail.']);
        }
    }

    public function edit($id)
    {
        
        $paymentdetail = PaymentDetail::with('extrafees')->findOrFail($id);

        $extraFee = $paymentdetail->extrafees->first();

        $paymentdetail = [
            'id' => $paymentdetail->id,
            'name' => $paymentdetail->name,
            'description' => $paymentdetail->description,
            'image_link' => $paymentdetail->icon_link,
            'extra_fee' => $extraFee !== null,
            'extra_fee_name' => $extraFee ? $extraFee->name : '',
            'extra_fee_percentage' => $extraFee ? $extraFee->percentage : '',
            'payment' => $paymentdetail->payment_id
        ];
        return response()->json($paymentdetail);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'payment' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480'
            ]);
    
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $request->name . time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('img/paymentdetails', $imageName);
                $request['image_link'] = asset('storage') . '/' . $imagePath;
            }

            $paymentdetails = PaymentDetail::with('extrafees')->findOrFail($id);
            $paymentdetails->update([
                'name' => $request['name'],
                'description' => $request['description'],
                'payment_id' => $request['payment'],
                'icon_link' => $request['image_link'] ?? $paymentdetails->icon_link
            ]);

            if ($request->has('extra_fee') && $request->extra_fee === 'on') {
                $request->validate([
                    'extra_fee_name' => 'required|string|max:255',
                    'extra_fee_percentage' => 'required|numeric|min:0|max:100'
                ]);

                if ($paymentdetails->extrafees->isEmpty()) {
                    ExtraFee::create([
                        'name' => $request['extra_fee_name'],
                        'percentage' => $request['extra_fee_percentage'],
                        'payment_detail_id' => $paymentdetails->id
                    ]);
                } else {
                    $paymentdetails->extrafees->first()->update([
                        'name' => $request['extra_fee_name'],
                        'percentage' => $request['extra_fee_percentage']
                    ]);
                }
            } else {
                $paymentdetails->extrafees->each(function ($extrafee) {
                    $extrafee->delete();
                });
            }


            // Capture the 'page' parameter from the request and redirect back with it
            $page = $request->input('page', 1); // Default to 1 if no page is specified

            DB::commit();
            return redirect()
                ->route('paymentdetails.index', ['page' => $page])
                ->with('success', 'Payment detail updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Error updating payment detail: ' . $e->getMessage());

            DB::rollBack();
            return back()
                ->withInput()
                ->withErrors(['error' => 'Could not update payment detail.']);
        }
    }

    public function destroy($id)
    {
        try {
            $paymentdetail = PaymentDetail::findOrFail($id);
            $extrafees = $paymentdetail->extrafees();

            $extrafees->delete();
            $paymentdetail->delete();

            return redirect()->route('paymentdetails.index')->with('success', 'Payment detail deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error deleting payment detail: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Could not delete payment detail.']);
        }
    }
}
