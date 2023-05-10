<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetManufacturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'website',
        'postalcode',
        'email',
        'street'
    ];

    public function licenses() {
        return $this->hasMany(License::class, 'manufacturer_id');
    }

    public function assets() {
        return $this->hasMany(Asset::class, 'manufacturer_id');
    }
}
