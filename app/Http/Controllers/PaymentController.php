<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with('paymentDetails');

        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where('name', 'like', '%' . $search . '%');
        }

        $payments = $query->paginate(5);

        return view('admin.payment', compact('payments'));
    }

    public function store(Request $request)
    {

        \Log::info($request->all());

        try {
            $request->validate([
                'name' => 'required|string|max:255'
            ]);

            Payment::create([
                'name' => $request['name']
            ]);

            return redirect()->route('payments.index')->with('success', 'Location added successfully!');
        } catch (\Exception $e) {
            \Log::error('Error creating payment: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Could not add payment.']);
        }
    }

    public function edit($id)
    {
        $payment = Payment::findOrFail($id);

        return response()->json($payment);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        try {
            $payment = Payment::findOrFail($id);
            $payment->update($request->all());

            // Capture the 'page' parameter from the request and redirect back with it
            $page = $request->input('page', 1); // Default to 1 if no page is specified

            return redirect()
                ->route('payments.index', ['page' => $page])
                ->with('success', 'Payment updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Error updating payment: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors(['error' => 'Could not update payment.']);
        }
    }

    public function destroy($id)
    {
        try {
            $payment = Payment::findOrFail($id);
            $payment->delete();

            return redirect()->route('payments.index')->with('success', 'Payment deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error deleting payment: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Could not delete payment.']);
        }
    }
}
