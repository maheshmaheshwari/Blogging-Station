<?php

namespace App\Http\Controllers;

use App\Article;
use App\Helpers\Captcha;
use App\Option;
use App\Statistic;
use App\User;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @param \App\Article $article
     *
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug, Article $article)
    {
        $article->load(['user', 'categories', 'tags']);

        if ($article->user->status !== 1) {
            abort(404);
        }

        if (!in_array($article->status, [1, 4, 6])) {
            abort(404);
        }

        if ($slug !== $article->slug) {
            return redirect($article->permalink(), 301);
        }

        // Update article hits
        DB::statement("UPDATE `articles` SET hits = hits + 1 WHERE id = {$article->id}");

        $this->setVisitorCookie();

        return response()
            ->view('public.articles.show', [
                'article' => $article,
                'view_form_data' => encrypt([
                    'id' => $article->id,
                    't' => time(),
                    'ref' => $_SERVER['HTTP_REFERER'] ?? null,
                ]),
            ])
            ->header('X-Frame-Options', 'SAMEORIGIN');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function go()
    {
        $form_data = request()->post();

        $view_form_data = decrypt($form_data['view_form_data']);

        $view_form_data['g-recaptcha-response'] = $form_data['g-recaptcha-response'] ?? null;

        $view_form_data['country'] = Statistic::get_country(get_ip());

        return json_encode($this->calcEarnings($view_form_data));
    }

    protected function calcEarnings($data)
    {
        /**
         * Views reasons
         * -------------
         * 1- Earn
         * 2- Not reached article read time
         * 3- reCAPTCHA V3 is incorrect
         * 4- reCAPTCHA V3 low score
         * 5- User disabled earnings
         * 6- Earnings disabled
         * 7- Invalid Country
         * 8- Disabled cookie
         * 9- IP changed
         * 10- Adblock
         * 11- Proxy
         * 12- Not unique
         * 13- PPA
         * 14- Article disable earnings
         * 15- Old article
         * 16- Don't pass the ads protector
         */

        $article = Article::with('user')
            ->select(['id', 'user_id', 'pay_type', 'disable_earnings', 'read_time', 'hits', 'published_at'])
            ->find($data['id']);

        /**
         * Check if user disabled earnings
         */
        if ((bool)$article->user->disable_earnings) {
            $this->addNormalStatisticEntry($article, $data, get_ip(), 5);
            $content = [
                'status' => 'success',
                'message' => 'Go without Earn because User disabled earnings',
            ];

            //return $content;
            return [];
        }

        /**
         * Check if earnings are disabled
         */
        if (!(bool)get_option('enable_author_earnings', 1)) {
            $this->addNormalStatisticEntry($article, $data, get_ip(), 6);
            $content = [
                'status' => 'success',
                'message' => 'Go without Earn because earnings are disabled',
            ];

            //return $content;
            return [];
        }

        /**
         * Check if article type is PPA
         */
        if ((int)$article->pay_type === 2) {
            $this->addNormalStatisticEntry($article, $data, get_ip(), 13);
            $content = [
                'status' => 'success',
                'message' => 'Go without Earn because article type is PPA',
            ];

            //return $content;
            return [];
        }

        /**
         * Check if user disabled earnings
         */
        if ((bool)$article->disable_earnings) {
            $this->addNormalStatisticEntry($article, $data, get_ip(), 14);
            $content = [
                'status' => 'success',
                'message' => 'Go without Earn because User disabled earnings',
            ];

            //return $content;
            return [];
        }

        /**
         * Check if old article
         */
        if ((int)get_option('paid_days', 0) !== 0) {
            if ($article->published_at->addDays(get_option('paid_days', 0))->isPast()) {
                $this->addNormalStatisticEntry($article, $data, get_ip(), 15);
                $content = [
                    'status' => 'success',
                    'message' => 'Go without Earn because old article',
                ];

                //return $content;
                return [];
            }
        }

        /**
         * Check if valid country
         */
        if (is_null($data['country'])) {
            $this->addNormalStatisticEntry($article, $data, get_ip(), 7);
            $content = [
                'status' => 'success',
                'message' => 'Go without Earn because invalid country',
            ];

            //return $content;
            return [];
        }

        /**
         * Check if cookie valid
         */
        try {
            //$cookie = decrypt(\Illuminate\Support\Facades\Cookie::get('visitor'));
            $cookie = decrypt($_COOKIE['visitor']);
        } catch (\Exception $exception) {
            $cookie = null;
        }

        if (!is_array($cookie)) {
            $this->addNormalStatisticEntry($article, $data, get_ip(), 8);
            $content = [
                'status' => 'success',
                'message' => 'Go without Earn because no cookie',
            ];

            //return $content;
            return [];
        }

        /**
         * Check if IP changed
         */
        if ($cookie['ip'] != get_ip()) {
            $this->addNormalStatisticEntry($article, $data, get_ip(), 9);
            $content = [
                'status' => 'success',
                'message' => 'Go without Earn because IP changed',
            ];

            //return $content;
            return [];
        }

        /**
         * Check for Adblock
         */
        if (!isset($_COOKIE['ab']) || in_array($_COOKIE['ab'], [0, 1])) {
            $this->addNormalStatisticEntry($article, $data, get_ip(), 10);
            $content = [
                'status' => 'success',
                'message' => 'Go without Earn because Adblock',
            ];

            //return $content;
            return [];
        }

        /**
         * Check if reached the article read time
         */
        $t = (int)$data['t'];
        $diff_seconds = (time() - $t);
        $read_time = (int)$article->read_time;

        if ($diff_seconds < $read_time) {
            $this->addNormalStatisticEntry($article, $data, get_ip(), 2);
            $content = [
                'status' => 'error',
                'message' => 'Not reached article read time',
            ];

            //return $content;
            return [];
        }

        /**
         * Check for ads protector
         */
        if (request()->session()->has('VisitorStatus') && request()->session()->get('VisitorStatus') === 0) {
            $this->addNormalStatisticEntry($article, $data, get_ip(), 16);
            $content = [
                'status' => 'success',
                'message' => 'Go without Earn because false ads protector status',
            ];

            //return $content;
            return [];
        }

        /**
         * Check if proxy
         */
        if (isProxyIP()) {
            $this->addNormalStatisticEntry($article, $data, get_ip(), 11);
            $content = [
                'status' => 'success',
                'message' => 'Go without Earn because proxy',
            ];

            //return $content;
            return [];
        }

        if ((bool)get_option('recaptcha_v3_article', 0) &&
            !empty(get_option('recaptcha_v3_site_key', '')) &&
            !empty(get_option('recaptcha_v3_secret_key', ''))
        ) {
            $captchaVerify = Captcha::recaptchaV3Verify($data);

            if (!$captchaVerify['status']) {
                $this->addNormalStatisticEntry($article, $data, get_ip(), 3);
                $content = [
                    'status' => 'error',
                    'message' => 'reCAPTCHA V3 is incorrect',
                ];

                //return $content;
                return [];
            }

            $recaptcha_v3_score = (float)get_option('recaptcha_v3_score', 0.5);

            if ($captchaVerify['score'] < $recaptcha_v3_score) {
                $this->addNormalStatisticEntry($article, $data, get_ip(), 4);
                $content = [
                    'status' => 'error',
                    'message' => 'reCAPTCHA V3 low score ' . $captchaVerify['score'],
                ];

                //return $content;
                return [];
            }
        }

        /**
         * Check for unique visit within last 24 hour
         */
        $startOfToday = now()->startOfDay()->format('Y-m-d H:i:s');
        $endOfToday = now()->endOfDay()->format('Y-m-d H:i:s');

        $statistics = Statistic::query()
            ->where([
                ['ip', get_ip()],
                ['author_earn', '>', 0],
            ])
            ->whereBetween('created_at', [$startOfToday, $endOfToday])
            ->count();

        if ($statistics >= (int)get_option('paid_views_day', 1)) {
            $this->addNormalStatisticEntry($article, $data, get_ip(), 12);
            $content = [
                'status' => 'success',
                'message' => 'Go without Earn because Not unique.',
            ];

            //return $content;
            return [];
        }

        /**
         * Add statistic record
         */

        $prices = unserialize(Option::where('name', 'payout_rates')->first()->value);

        $author_earn = 0;

        if (!empty($prices[$data['country']][1])) {
            $author_earn = $prices[$data['country']][1] / 1000;
        } elseif (!empty($prices['all'][1])) {
            $author_earn = $prices['all'][1] / 1000;
        }

        /**
         * @var \App\User $user_update
         */
        $user_update = User::query()
            ->where('id', $article->user_id)
            ->first();

        $user_update->author_earnings = price_database_format($user_update->author_earnings +
            $author_earn);
        $user_update->timestamps = false;

        $user_update->save();

        $referral_id = $referral_earn = null;
        $enable_referrals = (bool)get_option('enable_referrals', 1);

        if ($enable_referrals && !empty($user_update->referred_by)) {
            /**
             * @var \App\User $user_referred_by
             */
            $user_referred_by = User::query()
                ->where([
                    ['id', $user_update->referred_by],
                    ['status', 1],
                ])
                ->first();

            if ($user_referred_by) {
                $referral_percentage = get_option('referral_percentage', 20) / 100;
                $referral_value = $author_earn * $referral_percentage;

                $user_referred_by->referral_earnings = price_database_format($user_referred_by->referral_earnings +
                    $referral_value);

                $user_referred_by->timestamps = false;
                $user_referred_by->save();

                $referral_id = $user_update->referred_by;
                $referral_earn = $referral_value;
            }
        }

        $statistic = new Statistic();

        $statistic->article_id = $article->id;
        $statistic->user_id = $article->user_id;
        $statistic->ip = get_ip();
        $statistic->country = $data['country'];
        $statistic->author_earn = price_database_format($author_earn);
        $statistic->referral_id = $referral_id;
        $statistic->referral_earn = (!is_null($referral_earn)) ? price_database_format($referral_earn) : null;
        $statistic->referer_domain = (parse_url($data['ref'], PHP_URL_HOST) ?: null);
        $statistic->reason = 1;

        $statistic->save();

        $content = [
            'status' => 'success',
            'message' => 'Go With earning :)',
        ];

        //return $content;
        return [];
    }

    /**
     * @param \App\Article $article
     * @param array $data
     * @param string $ip
     * @param int $reason
     */
    protected function addNormalStatisticEntry($article, $data, $ip, $reason = 0)
    {
        if (!$ip) {
            $ip = get_ip();
        }

        $statistic_data = [
            'article_id' => $article->id,
            'user_id' => $article->user_id,
            'ip' => $ip,
            'country' => $data['country'],
            'reason' => $reason,
            'referer_domain' => (parse_url($data['ref'], PHP_URL_HOST) ?: null),
        ];

        Statistic::create($statistic_data);

        return;
    }

    protected function setVisitorCookie()
    {
        //$cookie = \Illuminate\Support\Facades\Cookie::get('visitor');

        if (isset($_COOKIE['visitor'])) {
            return;
        }

        $cookie_data = [
            'ip' => get_ip(),
        ];

        //\Illuminate\Support\Facades\Cookie::queue(\cookie('visitor', encrypt($cookie_data), 24 * 60));
        setcookie('visitor', encrypt($cookie_data), 0, '/', '', false, true);
        return;
    }
}
