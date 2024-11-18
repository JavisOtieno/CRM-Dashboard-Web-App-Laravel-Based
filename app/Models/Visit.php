<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id',
        'location_id',
        // 'location',
        'status'
    ];

    public function account(){
        //return $this->belongsTo(User::class);
        return $this->belongsTo(Account::class,'account_id');
    }
    public function location(){
        //return $this->belongsTo(User::class);
        return $this->belongsTo(Location::class,'location_id');
    }

    protected $appends = ['type'];

    public function getTypeAttribute()
    {
        return 'meeting';
    }
    
}
