<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $fillable = ['name','branch_id'];
    protected $dates = ['deleted_at'];

    public function user() {
        return $this->hasMany(User::class);
    }

    public function branch() {
        return $this->belongsTo(Branch::class);
    }

    public function salesman() {
        return $this->hasMany(Salesman::class);
    }
}
