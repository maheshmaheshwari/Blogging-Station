<?php

namespace App\Helpers;

use DB;

class Activation
{
    public static function checkLicense()
    {
        $personal_token = DB::table('options')->where('name', 'personal_token')->first();
        $purchase_code = DB::table('options')->where('name', 'purchase_code')->first();

        if (empty($personal_token->value) || empty($purchase_code->value)) {
            return false;
        }

        if (!self::validateLicense()) {
            return false;
        }

        return true;
    }

    public static function validateLicense()
    {
        $result = \Cache::remember('license_response_result', 30 * 24 * 60 * 60, function () {
            $personal_token = get_option('personal_token');
            $purchase_code = get_option('purchase_code');

            $response = self::licenseCurlRequest([
                'personal_token' => $personal_token,
                'purchase_code' => $purchase_code,
            ]);

            return encrypt(json_decode($response->body, true));
        });

        if (!is_string($result)) {
            return false;
        }

        try {
            $result = decrypt($result);
        } catch (\Exception $exception) {
            return false;
        }

        if (isset($result['item']['id']) && intval($result['item']['id']) === 23491785) {
            return true;
        }

        return false;
    }

    public static function licenseCurlRequest($data = [])
    {
        return curlRequest('https://api.envato.com/v3/market/buyer/purchase', 'GET', [
            'code' => trim($data['purchase_code']),
        ], ['Authorization: Bearer ' . trim($data['personal_token'])]);
    }

}
