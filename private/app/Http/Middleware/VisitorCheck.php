<?php

namespace App\Http\Middleware;

use Closure;

class VisitorCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ((bool)get_option('ads_protector', 0) === false) {
            return $next($request);
        }

        if ($request->route()->getPrefix() === '/admin') {
            return $next($request);
        }

        if ($request->session()->has('VisitorStatus')) {
            //debug($request->session()->pull('VisitorStatus'));
            return $next($request);
        }

        if ($request->route()->getName() === 'visitor-check') {
            return $next($request);
        }

        /*
        if ($this->excludeTrustedBots($request)) {
            $request->session()->put('VisitorStatus', 1);
            return $next($request);
        }
        */

        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';

        if (stripos($userAgent, "google") !== false) {
            if ($this->isGoogleReverseDns()) {
                $request->session()->put('VisitorStatus', 1);
            } else {
                $request->session()->put('VisitorStatus', 0);
            }
            return $next($request);
        }

        if (stripos($userAgent, "bot") !== false ||
            stripos($userAgent, "facebook") !== false ||
            stripos($userAgent, "whatsapp") !== false
        ) {
            $request->session()->put('VisitorStatus', 0);
            return $next($request);
        }

        return response()
            ->view('visitor-check')
            ->setStatusCode(503);
        //->withHeaders(['Retry-After' => 5]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
//    protected function excludeTrustedBots($request)
//    {
//        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
//
//        if (stripos($userAgent, "twitter") !== false ||
//            stripos($userAgent, "facebook") !== false
//        ) {
//            $ip = get_ip();
//
//            $ips = file_get_contents(app_path('binary/trusted_bots_ips.txt'));
//            $ips = array_unique(array_filter(array_map('trim', explode("\n", $ips))));
//
//            return \Symfony\Component\HttpFoundation\IpUtils::checkIp($ip, $ips);
//        }
//
//        return false;
//    }

    protected function isGoogleReverseDns()
    {
        $ip = get_ip();

        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            return false;
        }

        $hostName = gethostbyaddr($ip);
        if ($hostName === false) {
            return false;
        }

        $hostName = mb_strtolower($hostName);

        if (!(preg_match('/\.(googlebot|google)\.com$/', $hostName) ||
            in_array($hostName, ['googlebot.com', 'google.com']))) {
            // Not Google
            return false;
        }

        $hostIp = $this->getHostByName($hostName, true);

        if ($hostIp === false) {
            return false;
        }

        if ($hostIp === $ip) {
            return true;
        }

        return false;
    }

    protected function getHostByName($host, $try_a = false)
    {
        $ip = get_ip();
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $dns = gethostbynamel($host);
            if ($dns === false) {
                return false;
            } else {
                return $dns[0];
            }
        }


        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            // get AAAA record for $host
            // if $try_a is true, if AAAA fails, it tries for A
            // the first match found is returned
            // otherwise returns false

            $dns = $this->getHostByNameL6($host, $try_a);
            if ($dns === false) {
                return false;
            } else {
                return $dns[0];
            }
        }

        return false;
    }

    protected function getHostByNameL6($host, $try_a = false)
    {
        // get AAAA records for $host,
        // if $try_a is true, if AAAA fails, it tries for A
        // results are returned in an array of ips found matching type
        // otherwise returns false

        $dns6 = dns_get_record($host, DNS_AAAA);
        if ($try_a == true) {
            $dns4 = dns_get_record($host, DNS_A);
            $dns = array_merge($dns4, $dns6);
        } else {
            $dns = $dns6;
        }
        $ip6 = [];
        $ip4 = [];
        foreach ($dns as $record) {
            if ($record["type"] == "A") {
                $ip4[] = $record["ip"];
            }
            if ($record["type"] == "AAAA") {
                $ip6[] = $record["ipv6"];
            }
        }
        if (count($ip6) < 1) {
            if ($try_a === true) {
                if (count($ip4) < 1) {
                    return false;
                } else {
                    return $ip4;
                }
            } else {
                return false;
            }
        } else {
            return $ip6;
        }
    }

}
