<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];

    public function user() {
        return $this->hasMany(User::class);
    }

    public function stock() {
        return $this->hasMany(Stock::class);
    }

    public function order() {
        return $this->hasMany(Order::class);
    }

    public function area() {
        return $this->hasMany(Area::class);
    }

    public function operational() {
        return $this->hasMany(Operational::class);
    }

    public function product() {
        return $this->hasMany(Product::class);
    }

    public function pricelist() {
        return $this->hasMany(Pricelist::class);
    }

    public function salesman() {
        return $this->hasMany(Salesman::class);
    }
}
