<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $fillable = ['product_id','qty','branch_id','user_id'];
    protected $dates = ['deleted_at'];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function branch() {
        return $this->belongsTo(Branch::class);
    }

    public function stock_transaction_detail() {
        return $this->belongsTo(Stock_transaction_detail::class);
    }
}
