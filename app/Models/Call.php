<?php

namespace App\Models;

use App\Models\Scopes\DefaultScope;
use App\Models\Scopes\DefaultTeamScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Call extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'account_id',
        'contact_id',
        'duration',
        'date',
        'time',
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

    protected $appends = ['modelcalendartype'];

    public function getModelcalendartypeAttribute()
    {
        return 'call';
    }


    protected static function booted()
    {
        // static::addGlobalScope(new OrganizationScope);
        static::addGlobalScope(new DefaultScope);
    }
    

}
