<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Uuid, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'role',
        'branch_id',
        'area_id'
    ];
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function branch() {
        return $this->belongsTo(Branch::class);
    }

    public function customer() {
        return $this->hasMany(Customer::class);
    }

    public function operational_category() {
        return $this->hasMany(Operational_category::class);
    }

    public function operational() {
        return $this->hasMany(Operational::class);
    }

    public function category() {
        return $this->hasMany(Category::class);
    }

    public function product() {
        return $this->hasMany(Product::class);
    }

    public function stock() {
        return $this->hasMany(Stock::class);
    }

    public function stock_transaction() {
        return $this->hasMany(Stock_transaction::class);
    }

    public function order() {
        return $this->hasMany(Order::class);
    }

    public function area() {
        return $this->belongsTo(Area::class);
    }

    public function pricelist() {
        return $this->hasMany(Pricelist::class);
    }

    public function supplier() {
        return $this->hasMany(Supplier::class);
    }

    public function salesman() {
        return $this->hasMany(Salesman::class);
    }
}
