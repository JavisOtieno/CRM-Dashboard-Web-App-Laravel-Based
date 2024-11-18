<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
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

    protected $appends = ['type'];

    public function getTypeAttribute()
    {
        return 'meeting';
    }
    
}
