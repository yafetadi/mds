<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class Credit_detail extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $fillable = ['credit_id','date','nominal','term'];
    protected $dates = ['deleted_at'];

    public function credit() {
        return $this->belongsTo(Credit::class);
    }
}
