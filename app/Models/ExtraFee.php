<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraFee extends Model
{
    use HasFactory;

    protected $table = 'extra_fees';

    protected $fillable = [
        'percentage',
        'name',
        'payment_detail_id'
    ];

    public $timestamps = true;

    public function paymentDetail()
    {
        return $this->belongsTo(PaymentDetail::class);
    }
}
