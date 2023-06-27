<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'gateway',
        'is_active',
    ];

    // Relationships
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
