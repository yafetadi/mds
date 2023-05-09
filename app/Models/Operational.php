<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operational extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $fillable = ['code','name','desc', 'type', 'nominal','user_id','operational_category_id','branch_id'];
    protected $dates = ['deleted_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function operational_category() {
        return $this->belongsTo(Operational_category::class);
    }

    public function branch() {
        return $this->belongsTo(Branch::class);
    }
}
