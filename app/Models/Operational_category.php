<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operational_category extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $fillable = ['name','user_id'];
    protected $dates = ['deleted_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function operational() {
        return $this->hasMany(Operational::class);
    }
}
