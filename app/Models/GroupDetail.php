<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupDetail extends Model
{
    use HasFactory;

    public function users() {
        return $this->hasMany(User::class);
    }

    public function group() {
        return $this->belongsTo(GroupRight::class);
    }
}
