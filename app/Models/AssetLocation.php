<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetLocation extends Model
{
    use HasFactory;

    protected $fillable = [
      'room',
      'storageplace',
      'street',
      'postalcode'
    ];

    public function assets() {
        return $this->hasMany(Asset::class, 'location_id');
    }
}
