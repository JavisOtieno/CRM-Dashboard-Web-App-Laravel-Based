<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id',
        'contact_id',
        'duration',
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
    

}
