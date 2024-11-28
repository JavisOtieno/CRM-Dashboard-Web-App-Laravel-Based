<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'website',
        'address',

    ];

    public function locations()
    {
        return $this->hasMany(Location::class);
    }
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
