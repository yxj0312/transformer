<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_CUSTOMER = 'customer';
    public const ROLE_VENDOR = 'vendor';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_default',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
