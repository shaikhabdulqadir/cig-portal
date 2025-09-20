<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'api_name',
        'price',
        'is_active'
    ];

    protected $casts = [
        'price' => 'float',
        'is_active' => 'boolean'
    ];

    public function features()
    {
        return $this->hasMany(PlanFeature::class);
    }
}
