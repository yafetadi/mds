<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pricelist extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $fillable = ['product_id','customer_id','branch_id','price','user_id'];

    protected $dates = ['deleted_at'];

    public function branch() {
        return $this->belongsTo(Branch::class);
    }
    
    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
