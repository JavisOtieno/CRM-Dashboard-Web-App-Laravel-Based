<?php

namespace App\Models;

use App\Models\Scopes\DefaultScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deal extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'account_id',
        'lead_id',
        // 'name',
        'product_id',
        'amount',
        'status'
    ];
    public function product(){
        //return $this->belongsTo(User::class);
        return $this->belongsTo(Product::class,'product_id');
    }

    public function account(){
        //return $this->belongsTo(User::class);
        return $this->belongsTo(Account::class,'account_id');
    }
    public function lead(){
        //return $this->belongsTo(User::class);
        return $this->belongsTo(Lead::class,'lead_id');
    }
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
