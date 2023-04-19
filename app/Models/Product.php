<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'price',
        'unit',
        'desc',
        'category_id',
        'user_id'
    ];
    protected $dates = ['deleted_at'];
    
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function order_detail() {
        return $this->hasMany(Order_detail::class);
    }

    public function stock() {
        return $this->hasMany(Stock::class);
    }

    public function pricelist() {
        return $this->hasMany(Pricelist::class);
    }
}
