<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'customname',
        'serialnumber',
        'macaddress',

        'purchasedate',
        'purchasecost',
        'purchaselink',

        'monthprice',
        'duration',

        'ordernumber',

        'warranty',
        'model_id',
        'category_id',
        'status_id',
        'manufacturer_id',
        'location_id',
        'department_id',
    ];

    public function model() {
        return $this->belongsTo(AssetModel::class, 'model_id');
    }

    public function category() {
        return $this->belongsTo(AssetCategory::class, 'category_id');
    }

    public function status() {
        return $this->belongsTo(AssetStatus::class, 'status_id');
    }

    public function manufacturer() {
        return $this->belongsTo(AssetManufacturer::class, 'manufacturer_id');
    }

    public function location() {
        return $this->belongsTo(AssetLocation::class, 'location_id');
    }

    public function department() {
        return $this->belongsTo(AssetDepartment::class, 'department_id');
    }

    public function licenseRental() {
        return $this->hasMany(LicenseRental::class, 'license_id');
    }

    public function rental() {
        return $this->hasOne(AssetRental::class, 'asset_id');
    }

}
