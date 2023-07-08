<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;

    public const DISCOUNT_TYPE_FIXED = 'fixed';
    public const DISCOUNT_TYPE_PERCENTAGE = 'percentage';

    protected $fillable = [
        'code', 'discount_amount', 'discount_type', 'couponable_id', 'couponable_type',
    ];

    public function couponable()
    {
        return $this->morphTo();
    }
}
