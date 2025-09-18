<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'max_quantity',
        'is_recurring',
    ];

    protected $casts = [
        'price' => 'float',
        'max_quantity' => 'integer',
        'is_recurring' => 'boolean',
    ];
}
