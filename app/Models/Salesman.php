<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salesman extends Model
{
    use HasFactory, Uuid, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['name','address','phone','branch_id','user_id','area_id'];

    public function branch() {
        return $this->belongsTo(Branch::class);
    }

    public function area() {
        return $this->belongsTo(Area::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function order() {
        return $this->hasMany(Order::class);
    }

    public function customer() {
        return $this->hasMany(Customer::class);
    }
}
