<?php

namespace App\Models;

use App\Models\Scopes\DefaultScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'lat',
        'long',
        'description',
        'account_id',
    ];

    public function account(){
        //return $this->belongsTo(User::class);
        return $this->belongsTo(Account::class,'account_id');
    }
    protected static function booted()
    {
        // static::addGlobalScope(new OrganizationScope);
        static::addGlobalScope(new DefaultScope);
    }
}
