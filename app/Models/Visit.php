<?php

namespace App\Models;

use App\Models\Scopes\DefaultScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visit extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'account_id',
        'location_id',
        // 'location',
        'status',
        'date',
        'time'
    ];

    public function account(){
        //return $this->belongsTo(User::class);
        return $this->belongsTo(Account::class,'account_id');
    }
    public function location(){
        //return $this->belongsTo(User::class);
        return $this->belongsTo(Location::class,'location_id');
    }

    protected $appends = ['modelcalendartype'];

    public function getModelcalendartypeAttribute()
    {
        return 'visit';
    }
    protected static function booted()
    {
        // static::addGlobalScope(new OrganizationScope);
        static::addGlobalScope(new DefaultScope);
    }

}
