<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'customer_id',
        'order_quantity',
        'discount_amount',
        'total',
        'status',
        'temporary_status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
}
