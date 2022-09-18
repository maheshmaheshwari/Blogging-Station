<?php

namespace App;

use GeoIp2\Database\Reader;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $guarded = ['id'];

    const UPDATED_AT = null;

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function get_country($ip)
    {
        if (!empty($_SERVER["HTTP_CF_IPCOUNTRY"])) {
            if (!in_array($_SERVER["HTTP_CF_IPCOUNTRY"], ['XX', 'T1'])) {
                return $_SERVER["HTTP_CF_IPCOUNTRY"];
            }
        }

        try {
            $reader = new Reader(app_path('binary/geoip/GeoLite2-Country.mmdb'));

            $record = $reader->country($ip);

            $countryCode = (trim($record->country->isoCode)) ? $record->country->isoCode : null;
        } catch (\Exception $exception) {
            $countryCode = null;
        }
        return $countryCode;
    }
}
