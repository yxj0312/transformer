<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    const DISCOUNT_TYPE_FIXED = 'fixed';
    const DISCOUNT_TYPE_PERCENTAGE = 'percentage';

    // 其他属性和方法...

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getDiscountTypeOptions()
    {
        return [
            self::DISCOUNT_TYPE_FIXED => 'Fixed Amount',
            self::DISCOUNT_TYPE_PERCENTAGE => 'Percentage',
        ];
    }
}
