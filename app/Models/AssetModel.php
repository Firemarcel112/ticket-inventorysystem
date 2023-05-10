<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'website'
    ];

    public function assets() {
        return $this->hasMany(Asset::class, 'model_id');
    }
}
