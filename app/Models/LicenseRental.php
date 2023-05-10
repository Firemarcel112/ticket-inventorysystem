<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseRental extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'license_id',
    ];

    public function asset() {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function license() {
        return $this->belongsTo(License::class, 'license_id');
    }
}
