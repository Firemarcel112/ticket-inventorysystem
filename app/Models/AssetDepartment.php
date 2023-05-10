<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetDepartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color',
    ];

    public function assets() {
        return $this->hasMany(Asset::class);
    }

}
