<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentUp extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'admition_no', 'period', 'ammount', 'payment_date', 'payment_no', 'expiration_date'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {
            $paymentid = rand(100, 9999);
            $payment->payment_no = $paymentid;
        });
    }
}
