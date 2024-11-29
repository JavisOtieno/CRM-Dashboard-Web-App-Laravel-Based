<?php

namespace App\Models;

use App\Models\Scopes\DefaultScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'account_id',
        'contact_id',
        'name',
        'description',
        'status',
        'date',
        'time'
    ];

    public function account(){
        //return $this->belongsTo(User::class);
        return $this->belongsTo(Account::class,'account_id');
    }
    public function contact(){
        //return $this->belongsTo(User::class);
        return $this->belongsTo(Contact::class,'contact_id');
    }

    protected $appends = ['modelcalendartype'];

    public function getModelcalendartypeAttribute()
    {
        return 'task';
    }
    protected static function booted()
    {
        // static::addGlobalScope(new OrganizationScope);
        static::addGlobalScope(new DefaultScope);
    }
}
