<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_option_id',
        'customer_id',
        'total_subtotal',
        'total_discount',
        'total_amount',
        'shipping_address',
        'shipping_cost',
        'status'
    ];

    public function people()
    {
        return $this->belongsTo(People::class);
    }
}
