<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    protected $fillable = [
        'payment_number', 'admitionNumber', 'name', 'payment_date',
    ];

    public function PaymentUp()
    {
        return $this->belongsTo(PaymentUp::class, 'payment_number', 'payment_no');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'admitionNumber', 'admition_no');
    }
}
