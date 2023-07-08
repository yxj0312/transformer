<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    public const DISCOUNT_TYPE_FIXED = 'fixed';
    public const DISCOUNT_TYPE_PERCENTAGE = 'percentage';

    protected $fillable = [
        'code', 'discount_amount', 'discount_type'
    ];

    public function couponable()
    {
        return $this->morphTo();
    }
}
