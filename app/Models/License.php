<?php

namespace App\Models;

use App\Http\Controllers\ConfigController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'licensekey',
        'manufacturer_id',
        'total',
        'expirationdate',
        'purchasedate',
        'purchaselink',
        'purchasecost',
        'ordernumber',
        'monthprice',
        'duration'
    ];


    public function manufacturer() {
        return $this->belongsTo(AssetManufacturer::class, 'manufacturer_id');
    }

    public function rentals() {
        return $this->hasMany(LicenseRental::class);
    }

    public function getExpiringLicenses() {
        $results = $this->whereDate('expirationdate', '<=', now()->addDays(ConfigController::LICENSENOTIFICATIONDAYSBEFOREEXPIRED)->setTime(0, 0, 0)->toDateTimeString())->select('*')->orderBy('expirationdate')->limit(8)->get();
        $count = count($this->whereDate('expirationdate', '<=', now()->addDays(ConfigController::LICENSENOTIFICATIONDAYSBEFOREEXPIRED)->setTime(0, 0, 0)->toDateTimeString())->select('*')->orderBy('expirationdate')->get());
        for($i = 0; $i < count($results); $i++) {
            $expiredSeconds = strtotime($results[$i]['expirationdate']);
            $currentSeconds = strtotime(date('Y-m-d'));
            $difference = $expiredSeconds - $currentSeconds;
            $day = $difference / 86400;
            $results[$i]['expiredTime'] = $day;
            $results[$i]['totalLicenses'] = $count;
        }
        return $results;
    }


}
