<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;

class DateController extends Controller
{
    /**
     * Formats updated_at and created_at from Table
     * @param int $dateTime
     * @return string
     */
    public static function formatDate(mixed $dateTime, $formatOpt = 'd.m.Y H:i'): string {
        $date = strtotime($dateTime);
        $dateNew = new DateTime;
        $dateNew->setTimestamp($date);

        return date_format($dateNew, $formatOpt);
    }}
