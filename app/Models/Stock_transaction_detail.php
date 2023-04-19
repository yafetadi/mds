<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock_transaction_detail extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $fillable = [
        'stock_transaction_id',
        'stock_id',
        'qty',
        'price',
        'total',
        'ppn',
        'desc',
        'expired'
    ];
    protected $dates = ['deleted_at'];

    public function stock_transaction() {
        return $this->belongsTo(Stock_transaction::class);
    }

    public function stock() {
        return $this->hasMany(Stock::class);
    }
}