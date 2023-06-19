<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'shipping_address_id',
        'billing_address_id',
        'session_id',
        'total_items',
        'total_price',
        'discount',
        'coupon_code',
        'notes',
        'is_checked_out',
        'checked_out_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shippingAddress()
    {
        return $this->belongsTo(Address::class, 'shipping_address_id');
    }

    public function billingAddress()
    {
        return $this->belongsTo(Address::class, 'billing_address_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_product')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
