<?php

namespace App\Models;


use App\Models\Scopes\DefaultScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'website',
        'address',
        'status'
        

    ];
    public function user(){
        //return $this->belongsTo(User::class);
        return $this->belongsTo(User::class,'user_id');
    }

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
        static::addGlobalScope(new DefaultScope);
    }
}
