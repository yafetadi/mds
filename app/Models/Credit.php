<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class Credit extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $fillable = ['order_id','nominal','remaining','due','tenor','status'];
    protected $dates = ['deleted_at'];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function credit_detail() {
        return $this->hasMany(Credit_detail::class);
    }
}
