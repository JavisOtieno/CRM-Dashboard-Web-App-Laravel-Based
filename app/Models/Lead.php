<?php

namespace App\Models;

use App\Models\Scopes\DefaultScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lead extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'account_name',
        'contact_id',
        'account_id',
        'status'
    ];
    
    public function user(){
        //return $this->belongsTo(User::class);
        return $this->belongsTo(User::class,'user_id');
    }
    
    protected static function booted()
    {
        // static::addGlobalScope(new OrganizationScope);
        static::addGlobalScope(new DefaultScope);
    }

}
