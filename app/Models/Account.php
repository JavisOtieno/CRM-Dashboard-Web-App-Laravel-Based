<?php

namespace App\Models;

use App\Models\Scopes\DefaultTeamScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    protected static function booted()
    {
        // static::addGlobalScope(new OrganizationScope);
        static::addGlobalScope(new DefaultTeamScope);
    }
}
