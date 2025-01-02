<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingPayment extends Model
{
    use HasFactory;

    protected $table = 'booking_payments';

    protected $fillable = [
        'payment_detail_id',
        'booking_id',
        'payment_information'
    ];

    public function booking(){
        return $this->belongsTo(Booking::class);
    }

    public function paymentDetail(){
        return $this->belongsTo(PaymentDetail::class);
    }

    public $timestamps = true;
}
