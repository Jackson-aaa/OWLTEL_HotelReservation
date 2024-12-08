<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $table = 'payment_details';

    protected $fillable = [
        'payment_id',
        'name',
        'description',
        'icon_link'
    ];

    public $timestamps = true;

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function extraFees()
    {
        return $this->hasMany(ExtraFee::class);
    }
}
