<?php

namespace App\Http\Controllers;

use App\Models\License;

class NotificationController extends Controller
{
    public static function notificationBell() {
        $license = new License();
        return $license->getExpiringLicenses();
    }
}
