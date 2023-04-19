<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock_transaction extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $fillable = [
        'invoice',
        'date',
        'received_from',
        'supplier_id',
        'dp',
        'remaining',
        'subtotal',
        'type',
        'desc',
        'branch_id',
        'user_id'
    ];
    protected $dates = ['deleted_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function stock_transaction_detail() {
        return $this->hasMany(Stock_transaction_detail::class);
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }
}
