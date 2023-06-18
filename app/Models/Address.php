<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

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

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Add any other relationships or methods here
}
