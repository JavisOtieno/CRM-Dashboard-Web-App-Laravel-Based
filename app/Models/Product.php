<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'status',

        'target_type',
        'target_amount'
    ];

    public function deals()
    {
        return $this->hasMany(Deal::class);
    }

}
