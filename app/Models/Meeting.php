<?php

namespace App\Models;

use App\Models\Scopes\DefaultScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'account_id',
        'contact_id',
        'type',
        'location',
        'date',
        'time',
        'description',
        'status'
    ];

    public function account(){
        //return $this->belongsTo(User::class);
        return $this->belongsTo(Account::class,'account_id');
    }
    public function contact(){
        //return $this->belongsTo(User::class);
        return $this->belongsTo(Contact::class,'contact_id');
    }
    public function user(){
        //return $this->belongsTo(User::class);
        return $this->belongsTo(User::class,'user_id');
    }


    protected $appends = ['modelcalendartype'];

    public function getModelcalendartypeAttribute()
    {
        return 'meeting';
    }
    protected static function booted()
    {
        // static::addGlobalScope(new OrganizationScope);
        static::addGlobalScope(new DefaultScope);
    }
}
