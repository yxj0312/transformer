<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'phone_number',
        'company_name',
        'apartment_number',
        'is_default',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shippingCarts()
    {
        return $this->hasMany(Cart::class, 'shipping_address_id');
    }

    public function billingCarts()
    {
        return $this->hasMany(Cart::class, 'billing_address_id');
    }

    // Add any other relationships or methods here
}
