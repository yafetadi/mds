<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $fillable = ['company','name','address','city','phone','tenor','user_id','salesman_id'];
    protected $dates = ['deleted_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function order() {
        return $this->hasMany(Order::class);
    }

    public function pricelist() {
        return $this->hasMany(Pricelist::class);
    }

    public function salesman() {
        return $this->belongsTo(Salesman::class);
    }
}
