<?php

function is_app_installed()
{
    if ((bool)env('APP_INSTALLED', 0)) {
        return true;
    }

    return false;
}

function database_connect()
{
    static $connected;

    if (!isset($connected)) {
        try {
            \DB::connection()->getPdo();
            $connected = true;
        } catch (\Exception $exception) {
            $connected = false;
        }
    }
    return $connected;
}

function get_option($name, $default = '')
{
    if (!database_connect()) {
        return $default;
    }

    try {
        static $settings;

        if (!isset($settings)) {
            $options = \DB::table('options')->select(['name', 'value'])->where('auto', 1)->get();
            $settings = [];
            foreach ($options as $option) {
                $settings[$option->name] = (is_serialized($option->value)) ?
                    unserialize($option->value) : $option->value;
            }
        }

        if (!array_key_exists($name, $settings)) {
            return $default;
        }

        if (is_array($settings[$name])) {
            return (!empty($settings[$name])) ? $settings[$name] : $default;
        } else {
            return (isset($settings[$name]) && strlen($settings[$name]) > 0) ? $settings[$name] : $default;
        }
    } catch (\Exception $exception) {
        return $default;
    }
}

function get_option_db($name, $default = '')
{
    try {
        return \DB::table('options')->where('name', $name)->first()->value;
    } catch (\Exception $exception) {
        return $default;
    }
}

/**
 * @param $name
 * @param string $default
 * @return string|array
 */
function get_style($name, $default = '')
{
    try {
        static $style;

        if (!isset($style)) {
            $style = \DB::table('options')->where('name', 'style')->first();
            $style = unserialize($style->value);
        }

        if (!array_key_exists($name, $style)) {
            return $default;
        }

        if (is_array($style[$name])) {
            return (!empty($style[$name])) ? $style[$name] : $default;
        } else {
            return (isset($style[$name]) && strlen($style[$name]) > 0) ? $style[$name] : $default;
        }
    } catch (\Exception $exception) {
        return $default;
    }
}

// check this if error happened
// https://core.trac.wordpress.org/browser/tags/4.0.1/src/wp-includes/functions.php#L283
function is_serialized($data)
{
    if (@unserialize($data) === false) {
        return false;
    } else {
        return true;
    }
}

/**
 * @return \App\User|\Illuminate\Contracts\Auth\Authenticatable|null
 */
function user()
{
    return auth()->user();
}

function get_http_headers($url, $options = [])
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_NOBODY, true);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 3);

    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    foreach ($options as $option => $value) {
        curl_setopt($ch, $option, $value);
    }
    $headers_string = curl_exec($ch);

    curl_close($ch);

    $data = [];
    //$headers = explode(PHP_EOL, $headers_string);
    $headers = explode("\n", str_replace("\r", "\n", $headers_string));
    foreach ($headers as $header) {
        $parts = explode(':', $header);
        if (count($parts) === 2) {
            $data[strtolower(trim($parts[0]))] = strtolower(trim($parts[1]));
        }
    }

    return $data;
}

function curlRequest($url, $method = 'GET', $data = [], $headers = [], $options = [])
{
    $ch = curl_init();

    switch ($method) {
        case "POST":
            curl_setopt($ch, CURLOPT_POST, 1);

            if ($data) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
            break;
        case "PUT":
            curl_setopt($ch, CURLOPT_PUT, 1);
            break;
        default:
            if ($data) {
                $url = sprintf("%s?%s", $url, http_build_query($data));
            }
    }

    curl_setopt($ch, CURLOPT_URL, $url);
    if ($headers) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    if (empty(@ini_get('open_basedir'))) {
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
    }
    //curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    if (!empty($_SERVER['HTTP_USER_AGENT'])) {
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    }

    foreach ($options as $option => $value) {
        curl_setopt($ch, $option, $value);
    }

    $response = curl_exec($ch);
    //$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    $error = '';
    if (curl_errno($ch)) {
        $error = curl_error($ch);
        \Log::error(curl_error($ch));
    }

    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

    curl_close($ch);

    $result = new \stdClass();
    $result->header = substr($response, 0, $header_size);
    $result->body = substr($response, $header_size);
    $result->error = $error;

    return $result;
}

function curlHtmlHeadRequest($url, $method = 'GET', $data = [], $headers = [], $options = [])
{
    $obj = new \stdClass(); //create an object variable to access class functions and variables
    $obj->result = '';

    $ch = curl_init();

    switch ($method) {
        case "POST":
            curl_setopt($ch, CURLOPT_POST, 1);

            if ($data) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
            break;
        case "PUT":
            curl_setopt($ch, CURLOPT_PUT, 1);
            break;
        default:
            if ($data) {
                $url = sprintf("%s?%s", $url, http_build_query($data));
            }
    }

    curl_setopt($ch, CURLOPT_URL, $url);
    if ($headers) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }

    //curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_WRITEFUNCTION, function ($ch, $str) use ($obj) {
        $obj->result .= $str;
        /*
          if (stripos($obj->result, '<body') !== false) {
          return false;
          }
         */
        return strlen($str); //return the exact length
    });
    curl_setopt($ch, CURLOPT_NOPROGRESS, false);
    curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, function ($ch, $downloadSize, $downloaded, $uploadSize, $uploaded) {
        // If $Downloaded exceeds 128KB, returning non-0 breaks the connection!
        return ($downloaded > (128 * 1024)) ? 1 : 0;
    });

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    if (empty(@ini_get('open_basedir'))) {
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
    }
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    if (!empty($_SERVER['HTTP_USER_AGENT'])) {
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    }

    foreach ($options as $option => $value) {
        curl_setopt($ch, $option, $value);
    }

    curl_exec($ch);
    //$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if (curl_errno($ch)) {
        //\Log::error(curl_error($ch));
    }

    curl_close($ch);

    return $obj->result;
}

function emptyCache()
{
    $files = \File::allFiles(storage_path(), true);

    foreach ($files as $file) {
        if (!in_array($file->getFilename(), ['.gitignore', 'ms_license_response_result'])) {
            \File::delete($file);
        }
    }
}

function emptyLogs()
{
    $files = \File::allFiles(storage_path('logs'), true);

    foreach ($files as $file) {
        if (!in_array($file->getFilename(), ['.gitignore'])) {
            \File::delete($file);
        }
    }
}

function isset_captcha()
{
    $captcha = (bool)get_option('captcha', 0);
    if (!$captcha) {
        return false;
    }

    $captcha_type = get_option('captcha_type', 'recaptcha_v2_checkbox');

    if ($captcha_type === 'recaptcha_v2_checkbox') {
        $recaptcha_v2_checkbox_site_key = get_option('recaptcha_v2_checkbox_site_key');
        $recaptcha_v2_checkbox_secret_key = get_option('recaptcha_v2_checkbox_secret_key');
        if (!empty($recaptcha_v2_checkbox_site_key) && !empty($recaptcha_v2_checkbox_secret_key)) {
            return true;
        }
    }

    if ($captcha_type === 'recaptcha_v2_invisible') {
        $recaptcha_v2_invisible_site_key = get_option('recaptcha_v2_invisible_site_key');
        $recaptcha_v2_invisible_secret_key = get_option('recaptcha_v2_invisible_secret_key');
        if (!empty($recaptcha_v2_invisible_site_key) && !empty($recaptcha_v2_invisible_secret_key)) {
            return true;
        }
    }

    if ($captcha_type === 'solvemedia') {
        $solvemedia_challenge_key = get_option('solvemedia_challenge_key');
        $solvemedia_verification_key = get_option('solvemedia_verification_key');
        $solvemedia_authentication_key = get_option('solvemedia_authentication_key');
        if (!empty($solvemedia_challenge_key) &&
            !empty($solvemedia_verification_key) &&
            !empty($solvemedia_authentication_key)
        ) {
            return true;
        }
    }

    return false;
}

/**
 * Generate random IP address
 * @return string Random IP address
 */
function random_ipv4()
{
    // http://stackoverflow.com/a/10268612
    //return mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255);
    // // http://board.phpbuilder.com/showthread.php?10346623-Generating-a-random-IP-Address&p=10830872&viewfull=1#post10830872
    return long2ip(rand(0, 255 * 255) * rand(0, 255 * 255));
}

/**
 * Get client IP address
 * @return string IP address
 */
function get_ip()
{
    static $ip;

    if (!isset($ip)) {
        if (!empty($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
        } elseif (!empty($_SERVER["HTTP_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        } elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            if (!empty($_SERVER["SERVER_ADDR"]) && ($ip === $_SERVER["SERVER_ADDR"])) {
                $ip = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            $ip = $_SERVER["REMOTE_ADDR"];
        }

        if (strstr($ip, ',')) {
            $tmp = explode(',', $ip);
            $ip = trim($tmp[0]);
        }
        //$ip = random_ipv4();
    }

    return $ip;
}

/**
 * @see https://www.sitepoint.com/localizing-dates-currency-and-numbers-with-php-intl/
 */
function price_database_format($price = 0)
{
    return number_format(floatval($price), 9, '.', '');
}

/**
 * @see https://www.sitepoint.com/localizing-dates-currency-and-numbers-with-php-intl/
 */
function display_price_currency($price)
{
    $decimals = get_option('price_decimals', 6);

    $price_string = '';

    if (get_option('currency_position', 'before') === 'before') {
        $price_string .= get_option('currency_symbol', '$');
    }

    $numberFormatter = new \NumberFormatter(app()->getLocale(), \NumberFormatter::DECIMAL);
    $numberFormatter->setAttribute(\NumberFormatter::FRACTION_DIGITS, $decimals);

    $price_string .= $numberFormatter->format($price);

    if (get_option('currency_position', 'before') === 'after') {
        $price_string .= get_option('currency_symbol', '$');
    }

    return $price_string;
}

function display_number($number)
{
    $numberFormatter = new \NumberFormatter(app()->getLocale(), \NumberFormatter::DECIMAL);

    $numberFormatter->setAttribute(\NumberFormatter::FRACTION_DIGITS, 0);

    return $numberFormatter->format($number);
}

/**
 * @param $date \Carbon\Carbon|string
 *
 * @return \Carbon\Carbon|string
 *
 * @throws \Exception
 */
function display_date_timezone($date)
{
    $date = (string)$date;
    if (!$date) {
        return '';
    }

    $pattern = get_option('datetime_format', 'MMM d, Y, h:mm a');

    $tz = get_option('timezone', 'UTC');

    $date = new \DateTime($date, new \DateTimeZone('UTC'));
    $date->setTimezone(new \DateTimeZone($tz));

    $formatter = new \IntlDateFormatter(
        app()->getLocale(),
        \IntlDateFormatter::SHORT,
        \IntlDateFormatter::SHORT,
        $tz,
        IntlDateFormatter::GREGORIAN,
        $pattern // http://userguide.icu-project.org/formatparse/datetime#TOC-Date-Time-Format-Syntax
    );
    return $formatter->format($date);

    /*
    if (is_string($date)) {
        $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date, 'UTC');
    }

    return $date->setTimezone(get_option('timezone', 'UTC'));
    */
}

function require_database_upgrade()
{
    if (version_compare(APP_VERSION, get_option('version', '1.0.0'), '>')) {
        return true;
    }
    return false;
}

function get_allowed_types()
{
    $types = [];

    if ((bool)get_option('enable_ppv', 'yes') == 'yes') {
        $types[1] = __('Pay Per View(PPV)');
    }

    if ((bool)get_option('enable_ppa', 'yes') == 'yes') {
        //$types[2] = __('Pay Per Article(PPA)');
    }

    return $types;
}

function get_statistics_reasons($id)
{
    $reasons = [
        0 => '---',
        1 => __("Earn"),
        2 => __("Not reached article read time"),
        3 => __("reCAPTCHA V3 is incorrect"),
        4 => __("reCAPTCHA V3 low score"),
        5 => __("User disabled earnings"),
        6 => __("Earnings disabled"),
        7 => __("Invalid Country"),
        8 => __("Disabled cookie"),
        9 => __("IP changed"),
        10 => __("Adblock"),
        11 => __("Proxy"),
        12 => __("Not unique"),
        13 => __("PPA"),
        14 => __("Article disable earnings"),
        15 => __("Old article"),
        16 => __("Ads Protector"),
    ];

    if ($id) {
        return isset($reasons[$id]) ? $reasons[$id] : $id;
    }

    return $reasons;
}

function get_withdrawal_methods()
{
    $all_withdrawal_methods = unserialize(\App\Option::whereName('withdrawal_methods')->first()->value);

    $withdrawal_methods = [];

    foreach ($all_withdrawal_methods as $method) {
        if ($method['status'] != 1) {
            continue;
        }

        $withdrawal_methods[] = [
            'id' => $method['id'],
            'name' => $method['name'],
            'amount' => floatval($method['amount']),
            'image' => $method['image'],
        ];
    }

    return $withdrawal_methods;
}

function get_site_languages($all = false)
{
    $default_language = get_option('language');
    $site_languages = get_option('site_languages', []);
    $site_languages = array_combine($site_languages, $site_languages);
    unset($site_languages[$default_language]);
    if ($all === true) {
        $site_languages[$default_language] = $default_language;
    }
    ksort($site_languages);
    return $site_languages;
}

function buildEnvVars($data2 = array())
{
    $env_path = base_path('env.php');

    $envs = [];
    if (file_exists($env_path)) {
        $envs = (array)require $env_path;
    }

    $env_example_path = base_path('env.example.php');
    $envs_example = (array)require $env_example_path;

    $envs = array_merge($envs_example, $envs);

    $data = [
        'APP_NAME' => get_option_db('site_name'),
        'APP_URL' => url(''),
        'MAIL_DRIVER' => get_option_db('email_method', 'sendmail'),
        'MAIL_HOST' => get_option_db('email_smtp_host'),
        'MAIL_PORT' => get_option_db('email_smtp_port'),
        'MAIL_USERNAME' => get_option_db('email_smtp_username'),
        'MAIL_PASSWORD' => get_option_db('email_smtp_password'),
        'MAIL_ENCRYPTION' => get_option_db('email_smtp_security'),
        'FACEBOOK_CLIENT_ID' => get_option_db('social_login_facebook_app_id'),
        'FACEBOOK_CLIENT_SECRET' => get_option_db('social_login_facebook_app_secret'),
        'TWITTER_CLIENT_ID' => get_option_db('social_login_twitter_api_key'),
        'TWITTER_CLIENT_SECRET' => get_option_db('social_login_twitter_api_secret'),
        'GOOGLE_CLIENT_ID' => get_option_db('social_login_google_client_id'),
        'GOOGLE_CLIENT_SECRET' => get_option_db('social_login_google_client_secret'),
    ];

    if ($data2) {
        foreach ($data2 as $key => $value) {
            $data[$key] = $value;
        }
    }

    $envs = array_merge($envs, $data);

    try {
        \File::put($env_path, "<?php\n\nreturn " . var_export($envs, true) . ";\n");

        \Artisan::call('config:clear');

        return true;
    } catch (\Exception $exception) {
        \Log::error($exception->getMessage());
    }

    return false;
}

function get_article_statuses($id = null)
{
    $statuses = [
        1 => __('Approved'),
        2 => __('Disabled'),
        3 => __('New Pending Review'),
        5 => __('New Need Improvements'),
        4 => __('Update Pending Review'),
        6 => __('Update Need Improvements'),
        7 => __('Soft Disabled'),
        //8 => __('Draft'),
    ];

    if ($id) {
        return isset($statuses[$id]) ? $statuses[$id] : $id;
    }

    return $statuses;
}

function get_comment_statuses($id = null)
{
    $statuses = [
        1 => __('Active'),
        2 => __('Pending'),
    ];

    if ($id) {
        return $statuses[$id] ?? $id;
    }

    return $statuses;
}

function get_page_statuses($id = null)
{
    $statuses = [
        1 => __('Active'),
        2 => __('Inactive'),
    ];

    if ($id) {
        return isset($statuses[$id]) ? $statuses[$id] : $id;
    }

    return $statuses;
}

function get_withdraw_statuses($id = null)
{
    $statuses = [
        1 => __('Approved'),
        2 => __('Pending'),
        3 => __('Complete'),
        4 => __('Cancelled'),
    ];

    if ($id) {
        return isset($statuses[$id]) ? $statuses[$id] : $id;
    }

    return $statuses;
}

function get_user_statuses($id = null)
{
    $statuses = [
        1 => __('Active'),
        2 => __('Pending'),
        3 => __('Inactive'),
    ];

    if ($id) {
        return isset($statuses[$id]) ? $statuses[$id] : $id;
    }

    return $statuses;
}

function isProxyIP($ip = null)
{
    if (!empty($_SERVER["HTTP_CF_IPCOUNTRY"])) {
        if ($_SERVER["HTTP_CF_IPCOUNTRY"] === 'T1') {
            return true;
        }
    }

    if (!$ip) {
        $ip = get_ip();
    }

    $proxy_service = get_option('proxy_service', 'free');

    if ($proxy_service === 'free' || empty(get_option('isproxyip_key'))) {
        $url = 'http://proxy.mightyscripts.com/check.php?purchase_code=' . urlencode(get_option('purchase_code')) .
            '&ip=' . urlencode($ip);

        $options = [
            CURLOPT_ENCODING => 'gzip,deflate',
        ];

        $proxy_check = curlRequest($url, 'GET', [], [], $options)->body;

        if (strcasecmp($proxy_check, "Y") === 0) {
            return true;
        }
    }

    if ($proxy_service === 'isproxyip') {
        $url = 'http://api.isproxyip.com/v1/check.php?key=' . urlencode(get_option('isproxyip_key')) .
            '&ip=' . urlencode($ip);

        $options = [
            CURLOPT_ENCODING => 'gzip,deflate',
        ];

        $proxy_check = curlRequest($url, 'GET', [], [], $options)->body;

        if (strcasecmp($proxy_check, "Y") === 0) {
            return true;
        }
    }

    return false;
}

function get_countries($campaign = false)
{
    $countries = [
        "AF" => __("Afganistan"),
        "AL" => __("Albania"),
        "DZ" => __("Algeria"),
        "AS" => __("American Samoa"),
        "AD" => __("Andorra"),
        "AO" => __("Angola"),
        "AI" => __("Anguilla"),
        "AQ" => __("Antarctica"),
        "AG" => __("Antigua and Barbuda"),
        "AR" => __("Argentina"),
        "AM" => __("Armenia"),
        "AW" => __("Aruba"),
        "AU" => __("Australia"),
        "AT" => __("Austria"),
        "AX" => __("Åland Islands"),
        "AZ" => __("Azerbaijan"),
        "BS" => __("Bahamas"),
        "BH" => __("Bahrain"),
        "BD" => __("Bangladesh"),
        "BB" => __("Barbados"),
        "BY" => __("Belarus"),
        "BE" => __("Belgium"),
        "BZ" => __("Belize"),
        "BJ" => __("Benin"),
        "BM" => __("Bermuda"),
        "BT" => __("Bhutan"),
        "BO" => __("Bolivia"),
        "BA" => __("Bosnia and Herzegowina"),
        "BW" => __("Botswana"),
        "BV" => __("Bouvet Island"),
        "BR" => __("Brazil"),
        "IO" => __("British Indian Ocean Territory"),
        "BN" => __("Brunei Darussalam"),
        "BG" => __("Bulgaria"),
        "BF" => __("Burkina Faso"),
        "BI" => __("Burundi"),
        "KH" => __("Cambodia"),
        "CM" => __("Cameroon"),
        "CA" => __("Canada"),
        "CV" => __("Cape Verde"),
        "KY" => __("Cayman Islands"),
        "CF" => __("Central African Republic"),
        "TD" => __("Chad"),
        "CL" => __("Chile"),
        "CN" => __("China"),
        "CX" => __("Christmas Island"),
        "CC" => __("Cocos (Keeling) Islands"),
        "CO" => __("Colombia"),
        "KM" => __("Comoros"),
        "CG" => __("Congo"),
        "CD" => __("Congo, the Democratic Republic of the"),
        "CK" => __("Cook Islands"),
        "CR" => __("Costa Rica"),
        "CI" => __("Cote d'Ivoire"),
        "CW" => __("Curaçao"),
        "HR" => __("Croatia(Hrvatska)"),
        "CU" => __("Cuba"),
        "CY" => __("Cyprus"),
        "CZ" => __("Czech Republic"),
        "DK" => __("Denmark"),
        "DJ" => __("Djibouti"),
        "DM" => __("Dominica"),
        "DO" => __("Dominican Republic"),
        "TP" => __("East Timor"),
        "EC" => __("Ecuador"),
        "EG" => __("Egypt"),
        "SV" => __("El Salvador"),
        "GQ" => __("Equatorial Guinea"),
        "ER" => __("Eritrea"),
        "EE" => __("Estonia"),
        "ET" => __("Ethiopia"),
        "FK" => __("Falkland Islands(Malvinas)"),
        "FO" => __("Faroe Islands"),
        "FJ" => __("Fiji"),
        "FI" => __("Finland"),
        "FR" => __("France"),
        "FX" => __("France, Metropolitan"),
        "GF" => __("French Guiana"),
        "PF" => __("French Polynesia"),
        "TF" => __("French Southern Territories"),
        "GA" => __("Gabon"),
        "GM" => __("Gambia"),
        "GE" => __("Georgia"),
        "DE" => __("Germany"),
        "GH" => __("Ghana"),
        "GI" => __("Gibraltar"),
        "GR" => __("Greece"),
        "GL" => __("Greenland"),
        "GD" => __("Grenada"),
        "GP" => __("Guadeloupe"),
        "GU" => __("Guam"),
        "GT" => __("Guatemala"),
        "GN" => __("Guinea"),
        "GW" => __("Guinea - Bissau"),
        "GY" => __("Guyana"),
        "HT" => __("Haiti"),
        "HM" => __("Heard and Mc Donald Islands"),
        "VA" => __("Holy See(Vatican City State)"),
        "HN" => __("Honduras"),
        "HK" => __("Hong Kong"),
        "HU" => __("Hungary"),
        "IS" => __("Iceland"),
        "IM" => __("Isle of Man"),
        "IN" => __("India"),
        "ID" => __("Indonesia"),
        "IR" => __("Iran(Islamic Republic of)"),
        "IQ" => __("Iraq"),
        "IE" => __("Ireland"),
        "IL" => __("Israel"),
        "IT" => __("Italy"),
        "JE" => __("Jersey"),
        "JM" => __("Jamaica"),
        "JP" => __("Japan"),
        "JO" => __("Jordan"),
        "KZ" => __("Kazakhstan"),
        "KE" => __("Kenya"),
        "KI" => __("Kiribati"),
        "KP" => __("Korea, Democratic People's Republic of"),
        "KR" => __("Korea, Republic of"),
        "XK" => __("Kosovo"),
        "KW" => __("Kuwait"),
        "KG" => __("Kyrgyzstan"),
        "LA" => __("Lao People's Democratic Republic"),
        "LV" => __("Latvia"),
        "LB" => __("Lebanon"),
        "LS" => __("Lesotho"),
        "LR" => __("Liberia"),
        "LY" => __("Libyan Arab Jamahiriya"),
        "LI" => __("Liechtenstein"),
        "LT" => __("Lithuania"),
        "LU" => __("Luxembourg"),
        "MO" => __("Macau"),
        "MK" => __("Macedonia, The Former Yugoslav Republic of"),
        "MG" => __("Madagascar"),
        "MW" => __("Malawi"),
        "MY" => __("Malaysia"),
        "MV" => __("Maldives"),
        "ML" => __("Mali"),
        "MT" => __("Malta"),
        "MH" => __("Marshall Islands"),
        "MQ" => __("Martinique"),
        "MR" => __("Mauritania"),
        "MU" => __("Mauritius"),
        "YT" => __("Mayotte"),
        "MX" => __("Mexico"),
        "FM" => __("Micronesia, Federated States of"),
        "MD" => __("Moldova, Republic of"),
        "MC" => __("Monaco"),
        "ME" => __("Montenegro"),
        "MN" => __("Mongolia"),
        "MS" => __("Montserrat"),
        "MA" => __("Morocco"),
        "MZ" => __("Mozambique"),
        "MM" => __("Myanmar"),
        "NA" => __("Namibia"),
        "NR" => __("Nauru"),
        "NP" => __("Nepal"),
        "NL" => __("Netherlands"),
        "AN" => __("Netherlands Antilles"),
        "NC" => __("New Caledonia"),
        "NZ" => __("New Zealand"),
        "NI" => __("Nicaragua"),
        "NE" => __("Niger"),
        "NG" => __("Nigeria"),
        "NU" => __("Niue"),
        "NF" => __("Norfolk Island"),
        "MP" => __("Northern Mariana Islands"),
        "NO" => __("Norway"),
        "OM" => __("Oman"),
        "PK" => __("Pakistan"),
        "PW" => __("Palau"),
        "PA" => __("Panama"),
        "PG" => __("Papua New Guinea"),
        "PY" => __("Paraguay"),
        "PE" => __("Peru"),
        "PH" => __("Philippines"),
        "PN" => __("Pitcairn"),
        "PL" => __("Poland"),
        "PT" => __("Portugal"),
        "PR" => __("Puerto Rico"),
        "PS" => __("Palestine"),
        "QA" => __("Qatar"),
        "RE" => __("Reunion"),
        "RO" => __("Romania"),
        "RS" => __("Republic of Serbia"),
        "RU" => __("Russian Federation"),
        "RW" => __("Rwanda"),
        "KN" => __("Saint Kitts and Nevis"),
        "LC" => __("Saint LUCIA"),
        "VC" => __("Saint Vincent and the Grenadines"),
        "WS" => __("Samoa"),
        "SM" => __("San Marino"),
        "ST" => __("Sao Tome and Principe"),
        "SA" => __("Saudi Arabia"),
        "SN" => __("Senegal"),
        "SC" => __("Seychelles"),
        "SL" => __("Sierra Leone"),
        "SG" => __("Singapore"),
        "SK" => __("Slovakia(Slovak Republic)"),
        "SI" => __("Slovenia"),
        "SB" => __("Solomon Islands"),
        "SO" => __("Somalia"),
        "SX" => __("Sint Maarten"),
        "ZA" => __("South Africa"),
        "GS" => __("South Georgia and the South Sandwich Islands"),
        "ES" => __("Spain"),
        "LK" => __("Sri Lanka"),
        "SH" => __("St . Helena"),
        "PM" => __("St . Pierre and Miquelon"),
        "SD" => __("Sudan"),
        "SR" => __("Suriname"),
        "SJ" => __("Svalbard and Jan Mayen Islands"),
        "SZ" => __("Swaziland"),
        "SE" => __("Sweden"),
        "CH" => __("Switzerland"),
        "SY" => __("Syrian Arab Republic"),
        "TW" => __("Taiwan, Province of China"),
        "TJ" => __("Tajikistan"),
        "TZ" => __("Tanzania, United Republic of"),
        "TH" => __("Thailand"),
        "TG" => __("Togo"),
        "TK" => __("Tokelau"),
        "TO" => __("Tonga"),
        "TT" => __("Trinidad and Tobago"),
        "TN" => __("Tunisia"),
        "TR" => __("Turkey"),
        "TM" => __("Turkmenistan"),
        "TC" => __("Turks and Caicos Islands"),
        "TV" => __("Tuvalu"),
        "UG" => __("Uganda"),
        "UA" => __("Ukraine"),
        "AE" => __("United Arab Emirates"),
        "GB" => __("United Kingdom"),
        "US" => __("United States"),
        "UM" => __("United States Minor Outlying Islands"),
        "UY" => __("Uruguay"),
        "UZ" => __("Uzbekistan"),
        "VU" => __("Vanuatu"),
        "VE" => __("Venezuela"),
        "VN" => __("Vietnam"),
        "VG" => __("Virgin Islands(British)"),
        "VI" => __("Virgin Islands(U . S .)"),
        "WF" => __("Wallis and Futuna Islands"),
        "EH" => __("Western Sahara"),
        "YE" => __("Yemen"),
        "YU" => __("Yugoslavia"),
        "ZM" => __("Zambia"),
        "ZW" => __("Zimbabwe"),
    ];

    if ($campaign) {
        $countries = ['all' => __('Worldwide Deal(All Countries)')] + $countries;
    }

    return $countries;
}

function delete_form($route, $id)
{
    $form = uniqid('f_');

    $html = '<form name="' . $form . '" style="display:none;" method="post" action="' . route($route, [$id]) . '">';
    $html .= csrf_field();
    $html .= method_field('DELETE');
    $html .= '</form>';

    $html .= '<a href="#" class="btn btn-sm btn-danger"';
    $html .= 'onclick="if (confirm(&quot;Are you sure?&quot;)) { document.' . $form . '.submit(); } ';
    $html .= 'event.returnValue = false; return false;">';
    $html .= '<i class="fa fa-trash"></i>';
    $html .= '</a>';

    return $html;
}

/**
 * @return \voku\helper\Hooks
 */
function hooks()
{
    return \voku\helper\Hooks::getInstance();
}

/**
 * @param string $content
 * @return string
 */
function applyShortCodes($content)
{
    return \App\Helpers\Elements::apply($content);
}

function menu_display($menuId, $options = [])
{
    if ($menuId) {
        $menu = \App\Menu::find($menuId);
        if ($menu) {
            return $menu->display($options);
        }
    }

    return '';
}

function html_typography($name, $value)
{
    static $fonts;

    if (!isset($fonts)) {
        $fonts = require_once app_path('Helpers/fonts.php');
        $fonts = $fonts['all'];
    }

    $html = '<div class="form-row">';

    $html .= '<div class="col">';
    $html .= \Form::text(
        "style[" . $name . "][color]",
        old("style[" . $name . "][color]", $value['color'] ?? ''),
        ['class' => 'form-control color-select', 'autocomplete' => 'off', 'placeholder' => __('Text Color')]
    );
    $html .= '</div>';

    $html .= '<div class="col">';
    $html .= \Form::text(
        "style[" . $name . "][links_color]",
        old("style[" . $name . "][links_color]", $value['links_color'] ?? ''),
        ['class' => 'form-control color-select', 'autocomplete' => 'off', 'placeholder' => __('Links Color')]
    );
    $html .= '</div>';

    $html .= '<div class="col">';
    $html .= \Form::select(
        "style[" . $name . "][font_family]",
        $fonts,
        old("style[" . $name . "][font_family]", $value['font_family'] ?? ''),
        ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => __('Font Family')]
    );
    $html .= '</div>';

    $html .= '<div class="col">';
    $html .= \Form::text(
        "style[" . $name . "][font_size]",
        old("style[" . $name . "][font_size]", $value['font_size'] ?? ''),
        ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => __('Font Size Ex. 15px')]
    );
    $html .= '</div>';

    $html .= '<div class="col">';
    $html .= \Form::text(
        "style[" . $name . "][line_height]",
        old("style[" . $name . "][line_height]", $value['line_height'] ?? ''),
        ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => __('Line Height')]
    );
    $html .= '</div>';

    $html .= '<div class="col">';
    $html .= \Form::text(
        "style[" . $name . "][font_weight]",
        old("style[" . $name . "][font_weight]", $value['font_weight'] ?? ''),
        ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => __('Font Weight')]
    );
    $html .= '</div>';

    $html .= '</div>';

    return $html;
}

function html_background($name, $value)
{
    $html = '<div class="form-row">';

    $html .= '<div class="col">';
    $html .= Form::text(
        "style[" . $name . "][color]",
        old("style[" . $name . "][color]", $value['color'] ?? ''),
        ['class' => 'form-control color-select', 'autocomplete' => 'off', 'placeholder' => __('Color')]
    );
    $html .= '</div>';

    $html .= '<div class="col">';
    $html .= Form::select(
        "style[" . $name . "][repeat]",
        [
            'no-repeat' => __('No Repeat'),
            'repeat' => __('Repeat All'),
            'repeat-x' => __('Repeat Horizontally'),
            'repeat-y' => __('Repeat Vertically'),
        ],
        old("style[" . $name . "][repeat]", $value['repeat'] ?? ''),
        ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => __('Background Repeat')]
    );
    $html .= '</div>';

    $html .= '<div class="col">';
    $html .= Form::select(
        "style[" . $name . "][attachment]",
        [
            'fixed' => __('Fixed'),
            'scroll' => __('Scroll'),
        ],
        old("style[" . $name . "][attachment]", $value['attachment'] ?? ''),
        ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => __('Background Attachment')]
    );
    $html .= '</div>';

    $html .= '<div class="col">';
    $html .= Form::select(
        "style[" . $name . "][position]",
        [
            'left top' => __('Left Top'),
            'left center' => __('Left Center'),
            'left bottom' => __('Left Bottom'),
            'center top' => __('Center Top'),
            'center center' => __('Center Center'),
            'center bottom' => __('Center Bottom'),
            'right top' => __('Right Top'),
            'right center' => __('Right Center'),
            'right bottom' => __('Right Bottom'),
        ],
        old("style[" . $name . "][position]", $value['position'] ?? ''),
        ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => __('Background Position')]
    );
    $html .= '</div>';

    $html .= '<div class="col">';
    $html .= Form::text(
        "style[" . $name . "][size]",
        old("style[" . $name . "][size]", $value['size'] ?? ''),
        ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => __('Background Size')]
    );
    $html .= '</div>';

    $html .= '<div class="col">';
    $html .= Form::text(
        "style[" . $name . "][image]",
        old("style[" . $name . "][image]", $value['image'] ?? ''),
        ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => __('Background Image URL')]
    );
    $html .= '</div>';

    $html .= '</div>';

    return $html;
}

function html_background_css($option = [])
{
    $style = '';

    if (isset($option['color']) && strlen($option['color'])) {
        $style .= 'background-color: ' . $option['color'] . ';';
    }
    if (isset($option['repeat']) && strlen($option['repeat'])) {
        $style .= 'background-repeat: ' . $option['repeat'] . ';';
    }
    if (isset($option['attachment']) && strlen($option['attachment'])) {
        $style .= 'background-attachment: ' . $option['attachment'] . ';';
    }
    if (isset($option['position']) && strlen($option['position'])) {
        $style .= 'background-position: ' . $option['position'] . ';';
    }
    if (isset($option['image']) && strlen($option['image'])) {
        $style .= 'background-image: url("' . $option['image'] . '");';
    }
    if (isset($option['size']) && strlen($option['size'])) {
        $style .= 'background-size: ' . $option['size'] . ';';
    }

    return $style;
}

function html_typography_css($option)
{
    $style = '';

    if (strlen($option['color'])) {
        $style .= 'color: ' . $option['color'] . ';';
    }
    if (strlen($option['font_family'])) {
        $style .= 'font-family: ' . $option['font_family'] . ';';
    }
    if (strlen($option['font_size'])) {
        $style .= 'font-size: ' . $option['font_size'] . ';';
    }
    if (strlen($option['line_height'])) {
        $style .= 'line-height: ' . $option['line_height'] . ';';
    }
    if (strlen($option['font_weight'])) {
        $style .= 'font-weight: ' . $option['font_weight'] . ';';
    }

    return $style;
}
