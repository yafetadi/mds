<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $fillable = [
        'invoice',
        'customer_id',
        'subtotal',
        'disc',
        'ppn',
        'delivery',
        'grandtotal',
        'payment',
        'payment_method',
        'status',
        'due',
        'date',
        'user_id',
        'branch_id',
        'return',
        'salesman_id'
    ];
    protected $dates = ['deleted_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function branch() {
        return $this->belongsTo(Branch::class);
    }

    public function order_detail() {
        return $this->hasMany(Order_detail::class);
    }

    public function credit() {
        return $this->hasOne(Credit::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function salesman() {
        return $this->belongsTo(Salesman::class);
    }
}
