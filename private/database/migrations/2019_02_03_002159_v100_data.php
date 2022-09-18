<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class V100Data extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('options')->insert([
            [
                'name' => 'version',
                'value' => '1.0.0',
                'auto' => '1',
            ],
            [
                'name' => 'site_name',
                'value' => 'PressFly',
                'auto' => '1',
            ],
            [
                'name' => 'site_meta_title',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'site_description',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'timezone',
                'value' => 'UTC',
                'auto' => '1',
            ],
            [
                'name' => 'ssl_enable',
                'value' => '0',
                'auto' => '1',
            ],
            [
                'name' => 'cookie_notification_bar',
                'value' => '1',
                'auto' => '1',
            ],
            [
                'name' => 'upload_filetypes',
                'value' => 'jpg,jpeg,png,gif,svg,mov,avi,mpg,pdf,doc,ppt,odt,pptx,docx,pps,ppsx,xls,xlsx,mp3,ogg,wav,mp4,m4v,webm,ogv',
                'auto' => '1',
            ],
            [
                'name' => 'fileupload_max',
                'value' => '2048',
                'auto' => '1',
            ],
            [
                'name' => 'write_paid_page',
                'value' => '3',
                'auto' => '1',
            ],
            [
                'name' => 'privacy_page',
                'value' => '1',
                'auto' => '1',
            ],
            [
                'name' => 'terms_page',
                'value' => '2',
                'auto' => '1',
            ],
            [
                'name' => 'mailchimp_api_key',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'mailchimp_list_id',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'language',
                'value' => 'en',
                'auto' => '1',
            ],
            [
                'name' => 'language_direction',
                'value' => 'ltr',
                'auto' => '1',
            ],
            [
                'name' => 'enable_ppv',
                'value' => '1',
                'auto' => '1',
            ],
            [
                'name' => 'enable_ppa',
                'value' => '0',
                'auto' => '1',
            ],
            [
                'name' => 'enable_author_earnings',
                'value' => '1',
                'auto' => '1',
            ],
            [
                'name' => 'paid_days',
                'value' => '30',
                'auto' => '1',
            ],
            [
                'name' => 'paid_views_day',
                'value' => '1',
                'auto' => '1',
            ],
            [
                'name' => 'force_disable_adblock',
                'value' => '0',
                'auto' => '1',
            ],
            [
                'name' => 'currency_code',
                'value' => 'USD',
                'auto' => '1',
            ],
            [
                'name' => 'currency_symbol',
                'value' => '$',
                'auto' => '1',
            ],
            [
                'name' => 'currency_position',
                'value' => 'before',
                'auto' => '1',
            ],
            [
                'name' => 'price_decimals',
                'value' => '5',
                'auto' => '1',
            ],
            [
                'name' => 'enable_referrals',
                'value' => '1',
                'auto' => '1',
            ],
            [
                'name' => 'referral_percentage',
                'value' => '20',
                'auto' => '1',
            ],
            [
                'name' => 'recaptcha_v3_article',
                'value' => '0',
                'auto' => '1',
            ],
            [
                'name' => 'recaptcha_v3_site_key',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'recaptcha_v3_secret_key',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'recaptcha_v3_score',
                'value' => '0.5',
                'auto' => '1',
            ],
            [
                'name' => 'close_registration',
                'value' => '0',
                'auto' => '1',
            ],
            [
                'name' => 'signup_bonus',
                'value' => '0',
                'auto' => '1',
            ],
            [
                'name' => 'account_activate_email',
                'value' => '1',
                'auto' => '1',
            ],
            [
                'name' => 'reserved_usernames',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'captcha',
                'value' => '0',
                'auto' => '1',
            ],
            [
                'name' => 'captcha_type',
                'value' => 'recaptcha_v2_checkbox',
                'auto' => '1',
            ],
            [
                'name' => 'recaptcha_v2_checkbox_site_key',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'recaptcha_v2_checkbox_secret_key',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'recaptcha_v2_invisible_site_key',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'recaptcha_v2_invisible_secret_key',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'solvemedia_challenge_key',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'solvemedia_verification_key',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'solvemedia_authentication_key',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'captcha_login',
                'value' => '0',
                'auto' => '1',
            ],
            [
                'name' => 'captcha_register',
                'value' => '1',
                'auto' => '1',
            ],
            [
                'name' => 'captcha_forgot_password',
                'value' => '1',
                'auto' => '1',
            ],
            [
                'name' => 'captcha_contact',
                'value' => '1',
                'auto' => '1',
            ],
            [
                'name' => 'frontend_head_code',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'frontend_footer_code',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'facebook_url',
                'value' => 'https://www.example.com/',
                'auto' => '1',
            ],
            [
                'name' => 'twitter_url',
                'value' => 'https://www.example.com/',
                'auto' => '1',
            ],
            [
                'name' => 'google_plus_url',
                'value' => 'https://www.example.com/',
                'auto' => '1',
            ],
            [
                'name' => 'admin_email',
                'value' => 'admin@example.com',
                'auto' => '1',
            ],
            [
                'name' => 'alert_admin_new_article',
                'value' => '1',
                'auto' => '1',
            ],
            [
                'name' => 'alert_admin_update_article',
                'value' => '1',
                'auto' => '1',
            ],
            [
                'name' => 'alert_admin_new_user_register',
                'value' => '1',
                'auto' => '1',
            ],
            [
                'name' => 'alert_admin_new_withdrawal',
                'value' => '1',
                'auto' => '1',
            ],
            [
                'name' => 'alert_member_approved_new_article',
                'value' => '1',
                'auto' => '1',
            ],
            [
                'name' => 'alert_member_approved_update_article',
                'value' => '1',
                'auto' => '1',
            ],
            [
                'name' => 'alert_member_approved_withdraw',
                'value' => '1',
                'auto' => '1',
            ],
            [
                'name' => 'alert_member_completed_withdraw',
                'value' => '1',
                'auto' => '1',
            ],
            [
                'name' => 'alert_member_canceled_withdraw',
                'value' => '1',
                'auto' => '1',
            ],
            [
                'name' => 'email_from',
                'value' => 'no_reply@example.com',
                'auto' => '1',
            ],
            [
                'name' => 'email_method',
                'value' => 'sendmail',
                'auto' => '1',
            ],
            [
                'name' => 'email_smtp_security',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'email_smtp_host',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'email_smtp_port',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'email_smtp_username',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'email_smtp_password',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'social_login_facebook',
                'value' => '0',
                'auto' => '1',
            ],
            [
                'name' => 'social_login_facebook_app_id',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'social_login_facebook_app_secret',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'social_login_twitter',
                'value' => '0',
                'auto' => '1',
            ],
            [
                'name' => 'social_login_twitter_api_key',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'social_login_twitter_api_secret',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'social_login_google',
                'value' => '0',
                'auto' => '1',
            ],
            [
                'name' => 'social_login_google_client_id',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'social_login_google_client_secret',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'payout_rates',
                'value' => 'a:249:{s:3:"all";a:3:{i:1;i:3;i:2;s:0:"";i:3;s:0:"";}s:2:"AF";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"AL";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"DZ";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"AS";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"AD";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"AO";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"AI";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"AQ";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"AG";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"AR";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"AM";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"AW";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"AU";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"AT";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"AX";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"AZ";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"BS";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"BH";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"BD";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"BB";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"BY";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"BE";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"BZ";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"BJ";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"BM";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"BT";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"BO";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"BA";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"BW";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"BV";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"BR";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"IO";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"BN";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"BG";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"BF";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"BI";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"KH";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"CM";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"CA";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"CV";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"KY";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"CF";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"TD";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"CL";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"CN";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"CX";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"CC";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"CO";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"KM";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"CG";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"CD";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"CK";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"CR";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"CI";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"CW";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"HR";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"CU";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"CY";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"CZ";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"DK";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"DJ";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"DM";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"DO";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"TP";a:3:{i:1;s:0:"";i:2;s:0:"";i:3;s:0:"";}s:2:"EC";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"EG";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"SV";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"GQ";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"ER";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"EE";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"ET";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"FK";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"FO";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"FJ";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"FI";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"FR";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"FX";a:3:{i:1;s:0:"";i:2;s:0:"";i:3;s:0:"";}s:2:"GF";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"PF";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"TF";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"GA";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"GM";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"GE";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"DE";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"GH";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"GI";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"GR";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"GL";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"GD";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"GP";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"GU";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"GT";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"GN";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"GW";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"GY";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"HT";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"HM";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"VA";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"HN";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"HK";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"HU";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"IS";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"IM";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"IN";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"ID";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"IR";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"IQ";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"IE";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"IL";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"IT";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"JE";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"JM";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"JP";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"JO";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"KZ";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"KE";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"KI";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"KP";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"KR";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"XK";a:3:{i:1;s:0:"";i:2;s:0:"";i:3;s:0:"";}s:2:"KW";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"KG";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"LA";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"LV";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"LB";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"LS";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"LR";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"LY";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"LI";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"LT";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"LU";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"MO";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"MK";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"MG";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"MW";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"MY";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"MV";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"ML";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"MT";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"MH";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"MQ";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"MR";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"MU";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"YT";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"MX";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"FM";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"MD";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"MC";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"ME";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"MN";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"MS";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"MA";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"MZ";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"MM";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"NA";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"NR";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"NP";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"NL";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"AN";a:3:{i:1;s:0:"";i:2;s:0:"";i:3;s:0:"";}s:2:"NC";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"NZ";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"NI";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"NE";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"NG";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"NU";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"NF";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"MP";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"NO";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"OM";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"PK";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"PW";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"PA";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"PG";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"PY";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"PE";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"PH";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"PN";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"PL";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"PT";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"PR";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"PS";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"QA";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"RE";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"RO";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"RS";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"RU";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"RW";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"KN";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"LC";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"VC";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"WS";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"SM";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"ST";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"SA";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"SN";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"SC";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"SL";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"SG";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"SK";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"SI";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"SB";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"SO";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"SX";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"ZA";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"GS";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"ES";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"LK";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"SH";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"PM";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"SD";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"SR";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"SJ";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"SZ";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"SE";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"CH";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"SY";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"TW";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"TJ";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"TZ";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"TH";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"TG";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"TK";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"TO";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"TT";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"TN";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"TR";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"TM";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"TC";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"TV";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"UG";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"UA";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"AE";a:3:{i:1;i:8;i:2;s:0:"";i:3;s:0:"";}s:2:"GB";a:3:{i:1;i:10;i:2;s:0:"";i:3;s:0:"";}s:2:"US";a:3:{i:1;i:15;i:2;s:0:"";i:3;s:0:"";}s:2:"UM";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"UY";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"UZ";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"VU";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"VE";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"VN";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"VG";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"VI";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"WF";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"EH";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"YE";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"YU";a:3:{i:1;s:0:"";i:2;s:0:"";i:3;s:0:"";}s:2:"ZM";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}s:2:"ZW";a:3:{i:1;i:5;i:2;s:0:"";i:3;s:0:"";}}',
                'auto' => '0',
            ],
            [
                'name' => 'style',
                'value' => 'a:33:{s:10:"logo_image";s:20:"/assets/img/logo.svg";s:7:"favicon";s:0:"";s:13:"primary_color";s:18:"rgba(221, 0, 9, 1)";s:15:"body_typography";a:6:{s:5:"color";s:19:"rgba(97, 97, 97, 1)";s:11:"links_color";s:22:"rgba(111, 111, 111, 1)";s:11:"font_family";s:6:"Nunito";s:9:"font_size";s:4:"14px";s:11:"line_height";s:3:"1.5";s:11:"font_weight";s:3:"400";}s:20:"secondary_typography";a:6:{s:5:"color";s:22:"rgba(255, 255, 255, 0)";s:11:"links_color";s:22:"rgba(255, 255, 255, 0)";s:11:"font_family";s:11:"Roboto Slab";s:9:"font_size";N;s:11:"line_height";N;s:11:"font_weight";N;}s:7:"body_bg";a:6:{s:5:"color";N;s:6:"repeat";N;s:10:"attachment";N;s:8:"position";N;s:4:"size";N;s:5:"image";N;}s:13:"top_header_bg";a:6:{s:5:"color";N;s:6:"repeat";N;s:10:"attachment";N;s:8:"position";N;s:4:"size";N;s:5:"image";N;}s:21:"top_header_typography";a:6:{s:5:"color";N;s:11:"links_color";N;s:11:"font_family";N;s:9:"font_size";N;s:11:"line_height";N;s:11:"font_weight";N;}s:9:"header_bg";a:6:{s:5:"color";N;s:6:"repeat";N;s:10:"attachment";N;s:8:"position";N;s:4:"size";N;s:5:"image";N;}s:12:"main_menu_bg";a:6:{s:5:"color";s:22:"rgba(248, 249, 250, 1)";s:6:"repeat";N;s:10:"attachment";N;s:8:"position";N;s:4:"size";N;s:5:"image";N;}s:20:"main_menu_typography";a:6:{s:5:"color";N;s:11:"links_color";N;s:11:"font_family";N;s:9:"font_size";N;s:11:"line_height";N;s:11:"font_weight";N;}s:9:"footer_bg";a:6:{s:5:"color";N;s:6:"repeat";N;s:10:"attachment";N;s:8:"position";N;s:4:"size";N;s:5:"image";N;}s:17:"footer_typography";a:6:{s:5:"color";N;s:11:"links_color";N;s:11:"font_family";N;s:9:"font_size";N;s:11:"line_height";N;s:11:"font_weight";N;}s:25:"footer_widget_title_color";s:0:"";s:24:"article_title_typography";a:6:{s:5:"color";N;s:11:"links_color";N;s:11:"font_family";N;s:9:"font_size";N;s:11:"line_height";N;s:11:"font_weight";N;}s:26:"article_content_typography";a:6:{s:5:"color";N;s:11:"links_color";N;s:11:"font_family";N;s:9:"font_size";N;s:11:"line_height";N;s:11:"font_weight";N;}s:21:"page_title_typography";a:6:{s:5:"color";N;s:11:"links_color";N;s:11:"font_family";N;s:9:"font_size";N;s:11:"line_height";N;s:11:"font_weight";N;}s:23:"page_content_typography";a:6:{s:5:"color";N;s:11:"links_color";N;s:11:"font_family";N;s:9:"font_size";N;s:11:"line_height";N;s:11:"font_weight";N;}s:10:"global_css";s:0:"";s:8:"top_menu";s:1:"1";s:9:"main_menu";s:1:"2";s:11:"footer_menu";s:1:"3";s:16:"category_sidebar";s:1:"1";s:11:"tag_sidebar";s:1:"1";s:15:"article_sidebar";s:1:"2";s:14:"author_sidebar";s:1:"3";s:14:"search_sidebar";s:1:"1";s:15:"footer1_sidebar";s:1:"4";s:15:"footer2_sidebar";s:1:"5";s:15:"footer3_sidebar";s:1:"6";s:9:"header_ad";s:1:"1";s:16:"above_article_ad";s:1:"6";s:16:"below_article_ad";s:1:"7";}',
                'auto' => '0',
            ],
            [
                'name' => 'homepage',
                'value' => '[grid1 title="Grid 1" cats="1,2,3,4,5,6"]

<div class="container">
    [block1 title="Popular Articles" type="popular"]
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="col-inner">
                <p class="text-center">
                    [ads id="2"]
                </p>
                [block4 title="Lifestyle" cats="5"]
                [block2 title="Business" cats="4"]
            </div>
        </div>
        <div class="col-lg-4 sticky-element">
            <div class="col-inner">
                <p>[ads id="5"]</p>
            </div>
        </div>
    </div>
</div>

<div class="container text-center mb-3">
    [ads id="3"]
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="col-inner">
                [block5 title="Sports" cats="3"]
                [block3 title="Health" cats="6"]
            </div>
        </div>
        <div class="col-lg-4 sticky-element">
            <div class="col-inner">
                [ads id="4"]
            </div>
        </div>
    </div>
</div>',
                'auto' => '0',
            ],
            [
                'name' => 'embed_google_fonts',
                'value' => 'a:2:{i:0;s:6:"Nunito";i:1;s:11:"Roboto Slab";}',
                'auto' => '0',
            ],
            [
                'name' => 'withdrawal_methods',
                'value' => 'a:6:{i:0;a:5:{s:4:"name";s:6:"PayPal";s:2:"id";s:6:"paypal";s:6:"status";s:1:"1";s:5:"image";s:38:"/uploads/2019/02/1551021607-paypal.png";s:6:"amount";s:2:"10";}i:1;a:5:{s:4:"name";s:6:"Stripe";s:2:"id";s:6:"stripe";s:6:"status";s:1:"1";s:5:"image";s:38:"/uploads/2019/02/1551213189-stripe.png";s:6:"amount";s:2:"10";}i:2;a:5:{s:4:"name";s:6:"Skrill";s:2:"id";s:6:"skrill";s:6:"status";s:1:"1";s:5:"image";s:38:"/uploads/2019/02/1551022305-skrill.png";s:6:"amount";s:1:"5";}i:3;a:5:{s:4:"name";s:5:"Payza";s:2:"id";s:5:"payza";s:6:"status";s:1:"1";s:5:"image";s:37:"/uploads/2019/02/1551022325-payza.png";s:6:"amount";s:1:"5";}i:4;a:5:{s:4:"name";s:5:"Paytm";s:2:"id";s:5:"paytm";s:6:"status";s:1:"1";s:5:"image";s:37:"/uploads/2019/02/1551022180-paytm.png";s:6:"amount";s:1:"3";}i:5;a:5:{s:4:"name";s:7:"Bitcoin";s:2:"id";s:7:"bitcoin";s:6:"status";s:1:"1";s:5:"image";s:39:"/uploads/2019/02/1551022347-bitcoin.png";s:6:"amount";s:1:"1";}}',
                'auto' => '0',
            ],
        ]);

        $ads = [
            [
                'id' => '1',
                'name' => 'Banner 728x90 - TOP',
                'status' => '1',
                'type' => null,
                'code' => str_replace('{url}', url(''), '<a href="https://1.envato.market/9rZ1Y" target="_blank">
    <img class="img-fluid" src="{url}/uploads/2019/02/1551361190-banner-728x90.jpeg">
</a>'),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '2',
                'name' => 'Banner 468x60 - Home',
                'status' => '1',
                'type' => null,
                'code' => str_replace('{url}', url(''), '<a href="{url}/page/write-get-paid">
    <img class="img-fluid" src="{url}/uploads/2019/02/1551025573-banner-468x60.jpeg">
</a>'),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '3',
                'name' => 'Banner 970x90 - Home',
                'status' => '1',
                'type' => null,
                'code' => '<a href="//1.envato.market/c/1339480/523007/4415?u=https%3A%2F%2Fcodecanyon.net%2Fuser%2Fmightyscripts%2Fportfolio"><img src="//a.impactradius-go.com/display-ad/4415-523007" border="0" alt="" width="970" height="90"/></a><img height="0" width="0" src="//1.envato.market/i/1339480/523007/4415" style="position:absolute;visibility:hidden;" border="0" />',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '4',
                'name' => 'Banner 300x600 - Home',
                'status' => '1',
                'type' => null,
                'code' => '<a href="//1.envato.market/c/1339480/523005/4415?u=https%3A%2F%2Fcodecanyon.net%2Fuser%2Fmightyscripts%2Fportfolio"><img src="//a.impactradius-go.com/display-ad/4415-523005" border="0" alt="" width="300" height="600"/></a><img height="0" width="0" src="//1.envato.market/i/1339480/523005/4415" style="position:absolute;visibility:hidden;" border="0" />',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '5',
                'name' => 'Banner 336x280 - home',
                'status' => '1',
                'type' => null,
                'code' => '<a href="//1.envato.market/c/1339480/375165/4415"><img src="//a.impactradius-go.com/display-ad/4415-375165" border="0" alt="" width="336" height="280"/></a><img height="0" width="0" src="//1.envato.market/i/1339480/375165/4415" style="position:absolute;visibility:hidden;" border="0" />',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '6',
                'name' => 'Above Article Ad',
                'status' => '1',
                'type' => null,
                'code' => str_replace('{url}', url(''), '<a href="{url}/page/write-get-paid">
    <img class="img-fluid" src="{url}/uploads/2019/02/1551025573-banner-468x60.jpeg">
</a>'),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '7',
                'name' => 'Below Article Ad',
                'status' => '1',
                'type' => null,
                'code' => str_replace('{url}', url(''), '<a href="{url}/page/write-get-paid">
    <img class="img-fluid" src="{url}/uploads/2019/02/1551025573-banner-468x60.jpeg">
</a>'),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
        ];
        DB::table('ads')->insert($ads);

        $articles = [
            [
                'id' => '1',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Laudem pericula intellegam no sea?',
                'slug' => 'laudem-pericula-intellegam-no-sea',
                'summary' => 'Qui ex vivendum recteque, cu his vide debitis accusata? Ius quem dissentias cu. Eam ut ignota ancillae, has ut augue iisque menandri, pro falli euismod dissentiunt no. An unum lobortis vulputate nec, his iisque adolescens in, veri vocent no qui.',
                'content' => '<p>Qui ex vivendum recteque, cu his vide debitis accusata? Ius quem dissentias cu. Eam ut ignota ancillae, has ut augue iisque menandri, pro falli euismod dissentiunt no. An unum lobortis vulputate nec, his iisque adolescens in, veri vocent no qui.</p>
<p>Vix solum oratio cu, ea pri posidonium honestatis, audire veritus eam id? Purto probatus interpretaris pro ei, eam ornatus veritus ex. Cu audire inimicus has, ut mel latine similique? Simul oportere cotidieque eum in!</p>
<p>Et nec illud ullum, per te nibh tota suscipit? Affert praesent ne nec, mei prima bonorum omnesque et. Ut per congue omnium delectus. Ne homero adversarium vel.</p>
<p>Ceteros phaedrum est ut, modo primis admodum mea an! Ut quem stet falli duo, sea in brute facer accusam, dolores noluisse menandri in est? Mea et everti signiferumque, eirmod eruditi alienum duo et. At mea nibh pertinacia, veritus corrumpit id pro! Pri te aeque eirmod, quo ea nusquam singulis repudiandae!</p>
<p>Enim choro ancillae his no. Veri inani eam ei, solet omittantur vim an. Eu iusto mollis euripidis eos? Ne sint discere nec, eos te vitae ignota minimum? Habeo consequuntur eu eum, pro eu accusam facilisis. Et sit dicat nemore, noster iisque legimus ea pro.</p>
<p>Eu mel suscipit repudiare definitionem, in possim iuvaret detraxit mea! Et atqui zril usu. Ei usu utinam temporibus, libris rationibus in mea. Vero prompta et vim. Has inani salutandi et, mel no cetero prompta. Ut diam nominati liberavisse duo.</p>
<p>Laudem pericula intellegam no sea? At mei ocurreret sadipscing, sit tincidunt ullamcorper disputationi id? Timeam blandit detracto mea te, ferri iusto ex eam, perpetua omittantur usu et. Aliquid accusata nec ne, no mundi tollit lobortis usu. Dicit audiam sea ad, per ea singulis laboramus, te explicari mediocritatem his! Sea ceteros perpetua ne!</p>
<p>Causae timeam bonorum quo cu, ex paulo appareat his. Cu nam esse complectitur? Sea nibh nostrud ea, illud nusquam et vel, per dictas recteque assueverit in. Qui cu hinc doctus!</p>
<p>Soleat verterem elaboraret eum ea. Atqui mundi quidam eu pri, quodsi propriae assentior vim ad, eu porro commune est! Quem eros solet ex eum. Eam eu clita appellantur instructior?</p>
<p>Persius periculis cu mei! Ne ferri augue commodo vis. Duo minim legendos conceptam ex, tota soleat cum ad. Timeam fastidii et vim, vis tota graeci corrumpit an.</p>',
                'tmp_content' => null,
                'featured_image_id' => '22',
                'read_time' => '50',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '2',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Vim id dicta eligendi constituto',
                'slug' => 'vim-id-dicta-eligendi-constituto',
                'summary' => 'Hinc sensibus eleifend ad has, eam eu nihil partiendo complectitur, ubique epicuri vim in? Ad cum brute recteque. Mutat mentitum deseruisse ad vix, te sit dicit tation urbanitas, quod expetenda ei usu! Eu euismod feugiat appetere eum, lorem utamur ne quo! Cum veritus consetetur ut, tota primis ut nec. Te vidit graeci quaerendum sit, in alii iudicabit vis, ei unum altera conclusionemque qui.',
                'content' => '<p>Hinc sensibus eleifend ad has, eam eu nihil partiendo complectitur, ubique epicuri vim in? Ad cum brute recteque. Mutat mentitum deseruisse ad vix, te sit dicit tation urbanitas, quod expetenda ei usu! Eu euismod feugiat appetere eum, lorem utamur ne quo! Cum veritus consetetur ut, tota primis ut nec. Te vidit graeci quaerendum sit, in alii iudicabit vis, ei unum altera conclusionemque qui.</p>
<p>Vix ex quem illud interpretaris, malis possit nominavi no pro. Liber melius interesset ius te. Ne eos commodo scripserit, discere eripuit consetetur eu qui? Cum ei audiam evertitur, his nisl possit ne! Ferri sadipscing no has, qui no probo sonet inciderint, ludus contentiones te est. Sale everti nam ea, voluptua epicurei appareat eu vel.</p>
<p>Vim id dicta eligendi constituto, ius putent aliquip et. Senserit salutatus reformidans est ea, ad mentitum constituam vis? Veniam eripuit senserit mea cu. Accusamus referrentur duo no, ei qui omnis nostrud, harum utinam ad duo.</p>
<p>Mei lucilius appellantur ea. Sed falli delenit sententiae ea, ius ut errem fierent, his ei eros appareat iudicabit. Est ut minim comprehensam? Ne ferri nobis cetero qui?</p>
<p>Et atqui nonumy corrumpit mei, in per albucius postulant assueverit, ad per dicunt recteque? Mei id elit adipiscing. Maiestatis deseruisse id vel, eu viris nostro nam. Ei sit graecis suscipiantur, vocent placerat cum no. Nam ad tation quidam gubergren!</p>
<p>Cum nihil vocent commodo ei, vix odio nostrum fastidii no. Eu eam cetero copiosae, qui no elitr melius. Vix ad everti probatus, sed ea vidit quodsi! Ferri quando salutandi et eum, has te habeo dicta appetere? Est facer dictas necessitatibus ea, no adhuc solet duo.</p>
<p>Mei ex oporteat theophrastus, ipsum lorem facete et mei. Tempor nemore integre ei est, quot ancillae deserunt eu eum, ut tantas malorum fierent mea? Sea no iudico aliquid sadipscing. Inani fastidii nec ad, eius insolens definiebas cum ei. Clita affert quaestio nam no, ut vim senserit ocurreret. Sumo prima sed in, no quo fastidii pericula definitionem, aeque gloriatur temporibus mea ex!</p>
<p>Ut mei iriure singulis. His alia eros ne. Alienum gloriatur ut nec, ea nullam ceteros pri. Mei eu augue oporteat, nam at omnis accumsan. Ferri erant ne his?</p>
<p>Duo ea tale magna, ad consul praesent nam! Harum salutandi at cum, impetus delectus pri ex, offendit phaedrum id ius. Ad est tibique detracto, ea eum dicit latine. Eu pri regione tincidunt, quod inermis eum ut, ut assueverit deterruisset quo?</p>',
                'tmp_content' => null,
                'featured_image_id' => '21',
                'read_time' => '54',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '3',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Te legere singulis persequeris sit',
                'slug' => 'te-legere-singulis-persequeris-sit',
                'summary' => 'An mel saepe corrumpit, in probo sapientem posidonium mei! Postea nusquam inciderint vis ea, mel liber menandri ex. Ea autem eruditi mediocritatem est. Mea eu duis inani, ius solet intellegebat an. Ullum pertinacia at ius.',
                'content' => '<p>Fugit percipit persequeris eu est, ea usu modus affert munere. Cu impetus malorum lucilius eum, nec apeirian adipiscing conclusionemque an, usu ea fugit interpretaris? Ea eum habeo consequuntur. Sea integre perfecto id, ferri modus delenit pro in. Cu cum alia eirmod equidem, et ubique maiorum apeirian vix. An quo dicat iudico utinam, pro idque posidonium mediocritatem an. Ad natum ridens antiopam ius, solet exerci fastidii te pro.</p>
<p>Te ius nibh dicant recteque, id odio harum vix, no simul euismod officiis sed. Etiam tantas duo ex. Vix eu duis veri iudico, cetero partiendo sea ei. Vim eu tota nulla dicant, in duo habeo officiis scripserit. Cu ius vocent accumsan elaboraret, ne tale civibus officiis sed! Ius iisque singulis splendide te, mel soluta oporteat ut!</p>
<p>An mel saepe corrumpit, in probo sapientem posidonium mei! Postea nusquam inciderint vis ea, mel liber menandri ex. Ea autem eruditi mediocritatem est. Mea eu duis inani, ius solet intellegebat an. Ullum pertinacia at ius.</p>
<p>Te legere singulis persequeris sit. Sed ad ubique tritani, quot vidit eu sed, pri id delicata euripidis. Tota illud nec ea, inani definiebas neglegentur eum at. Libris graecis est cu, partem civibus vix cu?</p>
<p>Albucius detraxit eum an. Vim possim voluptatibus ne, ea mea graeci deseruisse. Cu mea ullum lobortis prodesset, mei et vidit imperdiet, ne eos viris nominati sadipscing. Tota melius accusam et duo!</p>
<p>Id convenire expetenda assueverit vix, mei probo dolore ex! Ex vim vero aperiam principes. Est ex libris argumentum efficiantur, nec tollit sanctus voluptua ne! Facete prodesset id qui, regione molestie volutpat mei ad. Augue appetere detraxit eum te, et quas gubergren appellantur nec, eos et intellegebat consequuntur.</p>
<p>Eu pri essent voluptua! Has libris feugiat voluptaria te. Ea suas tollit exerci eum, quo te iudicabit voluptatum omittantur! Ea qualisque prodesset vis, ea adhuc praesent est. Ne has alii tollit inermis, duo eu stet ornatus erroribus, doming fuisset definiebas an sed.</p>
<p>Usu ex laboramus intellegam efficiantur, vix cibo argumentum id. Sed an commodo complectitur! Eu aliquip discere impedit usu. Pri debet noster fabulas et. Vel ad falli minimum. Ut nec novum aperiri luptatum, clita quaestio consequat nec ne. Hinc salutandi te pro, modus facer tation has in, omnis soluta in sit.</p>
<p>Docendi dolores sed in? Volumus principes ut eam! Nusquam intellegat per ei. Ne mel utamur corrumpit, ei usu petentium iudicabit, his et elit accommodare?</p>
<p>An eum delicata ullamcorper, ex sed stet mutat commune! Deserunt intellegat scriptorem mei ex. Sed in nusquam verterem urbanitas! An audiam diceret petentium vim, et primis praesent intellegat vis. Nec ei oratio noluisse periculis, in vel dolores menandri, qui ei enim constituto.</p>',
                'tmp_content' => null,
                'featured_image_id' => '20',
                'read_time' => '58',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '4',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Aperiri explicari interpretaris vel ne',
                'slug' => 'aperiri-explicari-interpretaris-vel-ne',
                'summary' => 'In cum paulo accommodare. Ei quo tacimates delicatissimi. Usu ne ludus nostro torquatos, vis melius menandri salutandi in, in justo meliore qui? No nam malis altera, est ipsum oporteat constituto ex!',
                'content' => '<p>In cum paulo accommodare. Ei quo tacimates delicatissimi. Usu ne ludus nostro torquatos, vis melius menandri salutandi in, in justo meliore qui? No nam malis altera, est ipsum oporteat constituto ex!</p>
<p>Alterum fastidii ei per, ne idque mollis mel. Elit viris persecuti nam et. Cu pro accumsan ponderum, eum invidunt explicari assueverit at, nostrud consulatu sadipscing id ius. Atqui qualisque referrentur no eum, at tempor deterruisset has, pri tamquam bonorum necessitatibus at.</p>
<p>Populo blandit ad eos, ex quod purto mucius vel. Autem tamquam delicata sed no, vix ei dicam dolore efficiantur! Pro posidonium instructior et. Ea mazim delenit oporteat ius.</p>
<p>Aperiri explicari interpretaris vel ne, ex nibh impedit voluptua vis! Ad prima phaedrum definitionem sed. Elitr maiestatis inciderint an vix. Usu eu magna graeco, munere laboramus vituperata per ut, pri eu accusata maiestatis!</p>
<p>Clita euripidis eloquentiam cu pri? Menandri nominati assueverit sea in, est no nihil aeterno, per ea nihil reprehendunt? Id suas stet nonumy mei, amet delicata vix ei. Verear debitis denique no nec, tollit dolore sententiae has ex. His eros probo illud at, eu munere eligendi sensibus eum, mei ea tibique gloriatur interpretaris.</p>
<p>At commodo scriptorem dissentiet usu! Ius legere putant intellegam at, cum facilis luptatum ne. Sit no zril eligendi, nusquam antiopam est et. Eam wisi molestie et? Vix ei iudicabit complectitur intellegebat, qui noster neglegentur accommodare et.</p>
<p>An eam delenit percipitur. Id munere convenire duo, et falli impedit fastidii nec, semper dolorem iudicabit est an. Has in invidunt qualisque similique, tation latine et sit. Alii convenire maiestatis te cum, sea id nisl alienum dissentias. Usu et veri homero delectus.</p>
<p>Nemore feugait efficiendi ius ei. Vis in iudico ornatus sapientem, has in ornatus vivendum. Ne debitis mediocritatem per. Vis altera numquam convenire cu, ex fugit quidam eum, wisi mazim pri cu.</p>
<p>In dicit ceteros periculis duo, wisi utinam ut vis. Maiorum persecuti nec ne. Eam case assum nusquam eu, eu mea quaeque percipit. Sea case wisi menandri cu? Diceret volumus eum eu!</p>
<p>Vim no maiorum mentitum consulatu, duo omnes eirmod id. No qui duis nostrum volutpat, at vis erant splendide? Nec tota munere at, dicam impetus antiopam ea per. Persius liberavisse eu per, per ea magna malis intellegam. Qui in copiosae splendide, nec falli graeci ex, in delenit dolorem mei.</p>',
                'tmp_content' => null,
                'featured_image_id' => '19',
                'read_time' => '51',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '5',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Et vivendo invenire signiferumque vix',
                'slug' => 'et-vivendo-invenire-signiferumque-vix',
                'summary' => 'Saepe elaboraret in sed, at dicta zril placerat eam. Ea nam solum assum falli, cum eu lorem adversarium! Sed ut postea perfecto! Cum ne fuisset fabellas, per simul tincidunt no.',
                'content' => '<p>Periculis conceptam qui at, mea id scripta lobortis indoctum! Cum ea causae rationibus posidonium, no qui malis tantas, nam in zril aeterno iuvaret! Habeo vocibus cu vis! Latine temporibus definitionem mea at, id solum cetero accusamus nam, cu eum quot nulla lobortis. Dicunt numquam an qui, numquam appetere cu eam.</p>
<p>Sit legimus sententiae ad, ad has alii prompta nostrud? Ex habeo partem principes mel, cu vidit aperiam definitiones mel! Duis solet nam in, ea nec aliquip fierent? Id atqui quaeque equidem est, no veritus invidunt assueverit per. Hinc facete iuvaret mei in. Vel erat altera interpretaris ut! Mea ad facer summo doming!</p>
<p>Vis id tempor moderatius! Eos ea illud mundi zril, meliore interpretaris sea cu, modo postea nostrum qui ei. Ut probo tacimates dissentiunt eum! Magna doming incorrupte vim ex, ubique aperiri delicatissimi eam id, in sed falli utamur disputando? No sit esse ullamcorper, altera ponderum tacimates sea ut?</p>
<p>Nam diam debitis ex, et pri facilis quaerendum? Usu no quem iudico, ne vim munere audiam corrumpit, qui ne congue regione! Officiis evertitur voluptaria te pro. Pri in clita tamquam, solum regione quo an? Quo ei quando sensibus, in liberavisse complectitur sed. Autem dictas omittantur mei te, ad nulla viderer mel?</p>
<p>Semper vivendo per ne, usu at augue eleifend adipiscing. Ex nam ipsum adipisci interpretaris. Ius no case oratio percipitur, his hendrerit concludaturque et, ne per justo paulo imperdiet! His ea justo partiendo omittantur.</p>
<p>Errem singulis te nec, ut recteque scriptorem reformidans vim? Ut agam decore per, alii appellantur ei eam! Ad tale dolores mea, numquam iudicabit has ut. Ad aperiam quaestio per, recusabo scriptorem ne pro. His soleat fabulas accumsan eu, ne cum mutat doctus timeam. Natum platonem forensibus est an, error eruditi cu mei? Dicit option ex qui, erat partiendo posidonium te mei!</p>
<p>Saepe elaboraret in sed, at dicta zril placerat eam. Ea nam solum assum falli, cum eu lorem adversarium! Sed ut postea perfecto! Cum ne fuisset fabellas, per simul tincidunt no.</p>
<p>Et vivendo invenire signiferumque vix, corpora tacimates at nam, choro aperiam dissentiunt ex duo. Dico appetere appellantur cu eam, te cum omnes pertinax. Lorem periculis ut nec, in sea ornatus eloquentiam, eius illud nulla sit ei. Vim ne summo oratio theophrastus, qui at meis convenire, congue putant fabulas vim ut. Duo eu accusam gloriatur, eum tale veritus definitiones in. Option elaboraret quo et!</p>
<p>Purto tractatos an est, te veri assum partiendo usu! Solet vivendum at pro. Illum dicant nam at, his ex officiis expetenda. Et ridens insolens molestiae sit, laudem latine dissentiunt vel an? Ne autem aliquid ius.</p>
<p>An vix novum labore feugiat, mel ut everti insolens, cum vidit nulla philosophia an. Putant nostrum maiestatis pri cu, ad option nusquam qui. Quo omnes libris tractatos ea. Vim habeo tractatos no, no reque definitionem vim, modo quas eam ad. Eos ea wisi modus eirmod, dicat officiis cu has? Eum id zril labore mentitum, at elit quas gloriatur eos?</p>',
                'tmp_content' => null,
                'featured_image_id' => '18',
                'read_time' => '66',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '6',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Semper pertinax erroribus per an',
                'slug' => 'semper-pertinax-erroribus-per-an',
                'summary' => 'In usu audire vidisse accusamus, pro invenire consetetur id. Nec atomorum electram qualisque ea, ferri putant has ad. Ius cu persius quaeque? Et sed vidit errem primis.',
                'content' => '<p>In usu audire vidisse accusamus, pro invenire consetetur id. Nec atomorum electram qualisque ea, ferri putant has ad. Ius cu persius quaeque? Et sed vidit errem primis.</p>
<p>Tale falli eu usu. Dolorum probatus philosophia ne vis? An eos sint delenit voluptua, ex eos tincidunt mnesarchum. Mea modus pertinax at, et modus eripuit qui, has cu simul malorum.</p>
<p>Ne omnis augue eam, vivendum recusabo dissentias has no. Cu pro mazim offendit rationibus, his affert latine id, reque aperiri vel ne. Id ius sumo latine, pri agam dicta principes ut. At usu enim legendos invenire, ad qui minimum tractatos interesset!</p>
<p>Enim tollit vis id, at has expetendis adipiscing. Duo veritus maiorum an, vel cu epicuri gubergren. Eius impetus ornatus pri ea. Te eos graeci comprehensam, veri vocibus ad vis. Ut sed animal prompta ocurreret.</p>
<p>Per te semper efficiendi interpretaris, ius eleifend similique no! Ei pri justo porro inciderint, sint verear mel ne, eius velit iudico pro in. Nam te probo exerci accommodare. Vis tollit discere ex. Eu dico dictas accusamus vis, at sea iudico recteque! Iudico evertitur necessitatibus cu duo, per choro dolorem liberavisse an.</p>
<p>Pro id hinc erat accumsan, nostrum mnesarchum ne ius. Sea ad senserit definitiones? Usu assum nonumes theophrastus ex, mea et facete percipit, pro at dolores phaedrum? Quo ea suscipit reformidans, etiam audire referrentur sit at! Sanctus signiferumque eu sea. Erroribus pertinacia usu ei, perfecto menandri vim te.</p>
<p>His doctus laboramus disputando cu? Impetus invidunt adipiscing mei ex. Eos graece causae eu, iisque regione nostrud cu nam! Sea an erat patrioque definitionem, te qui nulla voluptaria persequeris. Vitae regione usu an, ad sea velit solet tritani? Vim et postulant intellegam definitionem, et numquam bonorum legendos nam, in sed dicant euismod utroque. Has epicurei dissentiunt ex, eos ex facer vidisse vivendum, molestiae definitionem conclusionemque et eam.</p>
<p>Semper pertinax erroribus per an? Dolorum vocibus est eu, voluptua cotidieque duo no? Te impedit assueverit cum, wisi percipitur vix in, periculis pertinacia has ne. At etiam erroribus est, id definiebas liberavisse his, eos graece definitiones ex!</p>
<p>Ut vim liber populo. Justo intellegam nam ex. Temporibus definitionem at ius, sumo legere ne nam, hinc regione aliquam ut his. Pro no ullum tamquam dolorum. Sit quaeque invenire dissentias cu, his no dictas utroque persecuti, probo augue mel in.</p>
<p>Est mediocrem philosophia no? Nec illum detraxit at, eos at alii fabulas apeirian. Odio eirmod postulant nec ea. No qui erat indoctum, ut qui menandri intellegat inciderint. Alia volutpat dissentiet est ex, atqui paulo id usu, te nec fabellas scripserit!</p>',
                'tmp_content' => null,
                'featured_image_id' => '17',
                'read_time' => '54',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '7',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Discere minimum rationibus mea',
                'slug' => 'discere-minimum-rationibus-mea',
                'summary' => 'Discere minimum rationibus mea in, paulo graeci phaedrum nam an, vim eripuit assentior te. Ignota definiebas in eos? Vide molestiae voluptatum ea eam? Sit accumsan ocurreret intellegam at!',
                'content' => '<p>Vis debet atomorum no, quando alienum eos ne. Ne pri torquatos vituperata, pri eu nullam vocent vituperata, ut nisl accusam periculis nec. Debitis elaboraret te his, mei no partiendo elaboraret, sit cu dicta dolor. Mea virtute dolorem et, putant aperiri incorrupte ad quo? Nec altera aperiri cu! Qui fabellas facilisi invenire ex, wisi utamur maiestatis ex nam.</p>
<p>Discere minimum rationibus mea in, paulo graeci phaedrum nam an, vim eripuit assentior te. Ignota definiebas in eos? Vide molestiae voluptatum ea eam? Sit accumsan ocurreret intellegam at!</p>
<p>Hinc unum graeci pro no, et audiam scriptorem vim? Alii habeo in eum? Sale doctus democritum his an, ex autem justo definitiones mel. Ei agam eloquentiam quo, case iisque feugiat et est? Libris partiendo qualisque ea per, et duis aliquam sed.</p>
<p>Eu usu nostrum tractatos, sit elitr delenit intellegat in? Omittam maluisset ne nam, cum apeirian dissentias et! Ad labore offendit reprehendunt vim, suas iudico legimus vel ut! Praesent imperdiet assueverit est eu, elitr splendide pro ei. Nam at oratio electram.</p>
<p>Quo essent integre rationibus id, ad est paulo viris! Euismod meliore veritus an duo. Consul graeco laoreet ex mea. Graeco virtute liberavisse mea ne, eu sed amet appareat invidunt, nulla integre persius has et! In mel regione sapientem signiferumque, quo sale admodum et, est no quodsi delenit.</p>
<p>Nostro albucius delectus sea ea. Ridens consectetuer usu ut, est mentitum accusamus no? Ei adversarium necessitatibus vis, ut eros erant delectus cum, porro congue ad sit? Quas democritum ut quo. Est audiam option te. Nam eu facete corpora eligendi. Ea option deleniti constituto eos, an pro falli melius.</p>
<p>Graecis legendos est te, eum ei adhuc nostrum! Qui in meis natum, cum et habeo constituam, est sumo voluptua appetere in. Vocent appetere pertinacia ea vix, per ex errem verear! Omnis appellantur mei eu, mei id tantas altera patrioque. Ei saepe virtute eos, ius unum adipisci reprehendunt at, in quo homero legendos! Reformidans conclusionemque mei ea, eu aeterno vituperata mei, vim novum maiestatis id. Mea diam maluisset at.</p>
<p>Ei has viris ullamcorper, cu eos malis consul nominati, oratio graeci voluptatum nam no. Has brute omnes ut? Te quaerendum repudiandae qui, in zril decore vis, nullam mucius postea cu vim. Ne probo eleifend sapientem sed. No his integre probatus, ei his bonorum reprimique? Mel duis salutandi eu, cum libris volumus in.</p>
<p>Ut movet mentitum gubergren sit. Eu pri ubique honestatis! Vim everti consetetur ex! Id sit impedit civibus conclusionemque. Erat molestiae vituperata nam id, no per dicta ignota qualisque! Eam discere ornatus id! Pro ignota assueverit an.</p>
<p>Nam cu putant deserunt, ad eam iuvaret quaestio? Fugit inani conceptam nam ne, est nusquam recusabo moderatius no! Vel at tacimates sensibus definitionem. An laoreet impedit mei, stet mandamus ad pri? Atqui iisque discere in eam, intellegat vituperata an mei.</p>',
                'tmp_content' => null,
                'featured_image_id' => '16',
                'read_time' => '62',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '8',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Brute sadipscing mel pivis etiam persius',
                'slug' => 'brute-sadipscing-mel-pivis-etiam-persius',
                'summary' => 'Id duo purto epicurei. Tractatos percipitur ea eum! His ne legere primis sensibus. Duo quaestio scribentur ut, noster appellantur an eos, no elitr tantas luptatum pri.',
                'content' => '<p>Pri diam habeo error cu, sit an porro commodo abhorreant, an mea solum malis. His atomorum adolescens no, ea nec tota tibique liberavisse? Ne meis dicit fuisset vim, modus lobortis in sea. Putent sanctus oportere eum ne. Ius eripuit ancillae invidunt ex, eu pertinacia efficiendi his! Ne inermis consequuntur vim. Vis in brute electram urbanitas, has magna equidem feugait in, vel vide utinam inermis id.</p>
<p>In possit eruditi mei, cu est ullum electram definitiones, modo paulo qui no. Ut vim falli oratio? Ei dico porro facilis eum. Est id facilis deterruisset. Et graecis qualisque vituperata pro, vis cu quot choro complectitur. Eum an clita malorum tincidunt.</p>
<p>Brute sadipscing mel ei, vis etiam persius definiebas at. Duo splendide efficiendi intellegebat et, ad vis veri adhuc incorrupte. Amet dicam scripta ei eos, ut elit illud definitiones cum! Dolor fastidii usu et, cibo rationibus ad cum!</p>
<p>Pri ex sonet mediocrem. Ut integre tibique iracundia pri! Eos postea meliore ex. Eum suavitate interesset cu, assum sonet putant id sea? No per clita fuisset consequat, nostro aliquip platonem an mea.</p>
<p>Nam nemore consequat scriptorem an, et eos suas assum utroque. Diceret gubergren vix no, duo ne vidisse adolescens! Facer delenit oportere sit ei? Usu te saperet assentior, ocurreret constituto deseruisse mea in, latine referrentur mel in?</p>
<p>Nonumy detraxit ullamcorper duo ex. Ea saperet copiosae vivendum eos, mea ut alii patrioque disputando! Mnesarchum posidonium est cu, eum sale mazim elaboraret ea, vel apeirian reprehendunt concludaturque ea? Vim ei sint dicam voluptatibus, illud maiorum vim id, ad purto debet sit. Vix te civibus principes, zril gloriatur his id. Vis in diceret alienum inimicus, malis aliquip inciderint pri no, ea audire ullamcorper mel! Eam augue altera nominavi eu, vocibus ullamcorper an has, dicit vocibus vis no.</p>
<p>Id duo purto epicurei. Tractatos percipitur ea eum! His ne legere primis sensibus. Duo quaestio scribentur ut, noster appellantur an eos, no elitr tantas luptatum pri.</p>
<p>Usu te dico wisi partiendo. Ei sonet conceptam sea, id putant volumus est? Ad duis perpetua eam, officiis corrumpit ei usu! Ea vis voluptua gubergren, vim te mundi admodum dissentiunt.</p>
<p>Ei cetero feugait corpora sea. Sit no noster audiam, eripuit constituam sed ne. Te feugait omittantur per, solum forensibus incorrupte mei ex. Eam fugit offendit id? Duo ea inani albucius delicata! Vel te scripta liberavisse, ad vis diceret accusamus, eripuit albucius duo at.</p>
<p>An has nemore instructior, ad nam viris dolor? Everti pertinacia vix cu. Vis no fuisset antiopam, qui in nobis doming, nam praesent repudiandae eu! Mei saepe mollis at, ex diam maluisset consequat ius. Ad paulo virtute assentior ius, no solet ponderum perfecto cum. Vidisse sententiae cu ius, veri exerci aliquip vim no.</p>',
                'tmp_content' => null,
                'featured_image_id' => '15',
                'read_time' => '60',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '9',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Duo tale utroque nusquam idpri modo autem',
                'slug' => 'duo-tale-utroque-nusquam-idpri-modo-autem',
                'summary' => 'Ex ius facete probatus, sed ex esse graeci. Altera corpora lucilius ne eum, tantas gubergren dissentiet sit ea. Omnis simul id mei, quando nusquam ei his? Mei at impedit nusquam, eam id liber laoreet. Ubique mollis signiferumque id vel.',
                'content' => '<p>Duo tale utroque nusquam id, pri modo autem salutatus et. Prima lobortis mea et. Ut quas minim bonorum vim, his congue adolescens quaerendum ei, sea ex eius omnium ceteros. Te cetero iudicabit philosophia quo, diam euismod has ne. Saperet consequuntur est ex, graeci detraxit conceptam pri in, sea in maiorum consequuntur! In munere vivendum indoctum mel, id qui bonorum oporteat invenire, his id voluptua incorrupte delicatissimi.</p>
<p>Vel in noluisse sententiae. Ad veri luptatum eos. Consul quaestio prodesset ad mei, quo nulla voluptatibus ne. Cum ei summo veritus tincidunt, eam id ridens consequuntur, ut cum consul nostrud ceteros. Usu velit dicta theophrastus te, oblique argumentum ad sit. Sumo ullum discere vis ad, quo audire inciderint eu!</p>
<p>Te nemore menandri per, no autem euismod sea! Ad has inermis efficiantur, ex nisl equidem adolescens has, tamquam accumsan quo ut? Ea est odio consequuntur, recusabo voluptatum vix te. Porro ipsum apeirian qui ne! No his quando diceret invidunt, cum ex purto constituto cotidieque.</p>
<p>Mel tota audire eu, eu labore gloriatur mea. Cu postea ocurreret maiestatis mel, consul appareat eloquentiam ut ius! In sed omnes graecis volutpat. Euismod meliore ex has, impedit graecis ad eos. At eum eros duis homero, populo oporteat referrentur et usu.</p>
<p>Magna civibus id pro, labore numquam albucius cu quo? Decore appellantur consequuntur mel an. Sit at quidam scripta. Tale salutatus liberavisse vim an, mucius legimus consulatu in duo! Ei quot aperiri maiorum per, eam ne altera nemore. Quo quem eligendi lucilius et, an tollit cetero delectus vix.</p>
<p>Vidit intellegat ei mei, ut mel nulla harum dolor. Eos ut salutatus intellegam eloquentiam, vel consul neglegentur no! Vis esse fierent eu, nam ei legere omnesque, vix ea zril laboramus urbanitas. Illud pertinacia consetetur ut mea, eu nam mazim menandri, ei est nullam moderatius interesset! Commune temporibus mea no, ea vix tale assentior. Vel ad complectitur contentiones reprehendunt, possim facilis detracto has ut?</p>
<p>Omnis abhorreant no mel, prompta repudiare et usu! Essent probatus nam cu, case lucilius mnesarchum ut eum. Ad adhuc lobortis est, ipsum eleifend temporibus per te, quaeque alienum neglegentur ut duo. Ne eruditi commune quo.</p>
<p>An adipisci antiopam definiebas ius, eruditi sapientem ex quo! Ex per assum legimus conclusionemque, autem partem eu vix, in pri labore inimicus! His an verear vivendo. Ea brute labores consulatu cum, animal moderatius usu no, his id dico consequuntur. Mei ea partem feugait splendide, nec ut posse munere.</p>
<p>Ex ius facete probatus, sed ex esse graeci. Altera corpora lucilius ne eum, tantas gubergren dissentiet sit ea. Omnis simul id mei, quando nusquam ei his? Mei at impedit nusquam, eam id liber laoreet. Ubique mollis signiferumque id vel.</p>
<p>Mei perfecto splendide eu, mazim fastidii verterem qui ex, no malorum nonumes evertitur eam? Ne tempor viderer admodum cum, per vidisse lobortis signiferumque ad, te his labore facilis laboramus. Ne ius soleat aperiri, sint platonem prodesset eu est, pro tritani feugiat id. Ut purto omnes antiopam nam, ad graece necessitatibus pri, per meliore postulant consequuntur no? Meis adhuc corpora ne eum, id esse melius integre mei.</p>',
                'tmp_content' => null,
                'featured_image_id' => '14',
                'read_time' => '70',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '10',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Has civibus evertitur definitiones duoit inani',
                'slug' => 'has-civibus-evertitur-definitiones-duoit-inani',
                'summary' => 'Vel summo ludus everti eu! Quo an nostrum placerat accusata? Nullam sensibus consequat et per, vix in rationibus elaboraret reprimique. Atqui audire assueverit ius no. Ex aperiam inermis maiorum nec.',
                'content' => '<p>Has civibus evertitur definitiones et. Duo inani tamquam aliquid cu. Ei his tritani mandamus rationibus. Liber libris fabulas an vel, mei eu facilisis theophrastus. Pro sumo blandit eu. Cu duo eirmod virtute?</p>
<p>Vel summo ludus everti eu! Quo an nostrum placerat accusata? Nullam sensibus consequat et per, vix in rationibus elaboraret reprimique. Atqui audire assueverit ius no. Ex aperiam inermis maiorum nec.</p>
<p>Cu decore officiis eum, ea cum facilis lobortis. Nam ei summo percipit sensibus, utroque nominati delicatissimi cu cum. An mel ferri dicunt, option sanctus vix at! Ne lobortis consetetur assueverit duo, at sea summo primis propriae. No per virtute lucilius lobortis, soluta equidem laoreet eam in, nec eu brute mnesarchum moderatius.</p>
<p>Et his insolens omittantur, at nam posse constituam. Invidunt argumentum no usu, ut zril iudicabit gloriatur cum. Mei nibh percipit persecuti et, erant salutandi mel te? Mel quod adolescens cu. At numquam veritus verterem pro, ius no singulis reformidans, reque dicunt delenit et vix. Duo dolor corpora ei, mei illum legendos corrumpit ex?</p>
<p>Ne sit luptatum ullamcorper, duo nonumes dignissim intellegam at, sit ut laudem oporteat! Te tantas munere mea, pro errem corpora qualisque te. Eos an exerci utroque, per etiam ullamcorper ea! Ne apeirian necessitatibus sea, cetero vocent honestatis et duo? Augue mandamus instructior pri in.</p>
<p>Cu quo solet eripuit repudiare, est ei postea comprehensam. Ad vim probo illum dictas? Vix ei alii agam adversarium, timeam comprehensam cum cu. Nemore concludaturque vis ea! Vidisse percipitur scripserit vim ne, ea nisl munere sit, ut audire feugiat contentiones nam. Te mei eius rebum persequeris!</p>
<p>Eum nemore abhorreant definitionem at. Vel ad error insolens antiopam, vim no quis quod rationibus? Detracto persequeris per ex, ferri populo efficiendi vel at, te eam assum primis consulatu! Quem putent tincidunt vis ea, aliquip denique appetere id mei!</p>
<p>Ex sit omittam persecuti, melius labores per te? Te est semper audire, nec suscipit corrumpit neglegentur ad, ut ridens veritus eam? Natum simul suscipiantur eu nec, nam case quaeque dissentiet ut, luptatum voluptatibus mel te! Ea mei dolor necessitatibus? Aperiam ancillae ad has, nostro causae pro an, eos no ipsum iracundia.</p>
<p>Ex pri saepe ocurreret. Consequat assentior ex eum! An saperet verterem vel? Pri te natum virtute albucius, ei eos denique menandri principes. Vero sale copiosae ne quo, malis consequat assueverit ad nec!</p>
<p>Ludus putant expetenda ut eum, id iusto elitr graeci eos. Nec noluisse fabellas ut, ad eius vocent has, duo no habeo electram inciderint? Ei duo phaedrum tincidunt dissentiunt, nibh graece invenire pro ad, duis definiebas quo ne. Fabulas mandamus ea mea, pro eu aliquip minimum conceptam. Duo ad percipit instructior. Congue molestie reprimique quo cu, ea everti iuvaret mea, an illum vituperata theophrastus eos.</p>',
                'tmp_content' => null,
                'featured_image_id' => '13',
                'read_time' => '60',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '11',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Vim eu oratio ignota accommodare!',
                'slug' => 'vim-eu-oratio-ignota-accommodare',
                'summary' => 'Has et minim aperiri splendide? Ut usu elitr essent menandri? Ius te quem harum habemus, pri ea essent appareat iudicabit! Alterum probatus elaboraret ei eam, persius habemus offendit cu pri?',
                'content' => '<p>Vim eu oratio ignota accommodare! Et ferri rationibus duo, falli dicit no nam? Ne lobortis euripidis interesset per, pro ignota virtute ocurreret at, ne diam impedit perfecto vix. Et sapientem inciderint disputando cum, scripta sanctus at has. Te pro laudem graece, eam solet iuvaret ornatus id! Perpetua dissentiunt quo ad, ex adhuc illud assum nec, has noluisse salutandi id? Id timeam virtute aliquando qui, eos nihil nonumy id, no delenit ceteros corpora cum?</p>
<p>Tale adolescens mea at, postea percipit per in. Pri vide utroque cu, ei pro accusam interpretaris, eligendi definiebas delicatissimi no eam. Sit ex labitur dolorem signiferumque. Vim cu verterem suavitate, pro fugit delectus et. No sea dico delicata consequuntur, qui ad congue nonumy! Sit in dolor graecis mediocrem.</p>
<p>Causae tractatos instructior mel eu. Nam ad legimus rationibus, choro possim scripserit eum ei. Dicta eruditi conclusionemque duo no, cum solet legendos te? Eam homero nullam tempor ne, inani meliore nusquam at sea, everti scripserit no eam! Tamquam epicurei et cum, ut quot detracto delectus vim.</p>
<p>Modo choro id mei. An ullum ornatus instructior eam, usu adhuc libris habemus ei. Nobis persius antiopam mei in, ea vel erat intellegebat. Qui no eius persequeris, pro partem necessitatibus ad, sanctus scriptorem at usu. Eos modus nemore te, id qui incorrupte disputando. Ei eos veniam delenit vivendum, te eros soluta est!</p>
<p>No his modo scribentur, no aeque tibique accommodare sed, cum aliquid expetendis ad. Nec tollit quaeque et? No pro probo dolore. No illum affert detracto usu. No cum laudem quodsi, vim facer ponderum dissentiunt te? Id eius assueverit has, ei per justo posse. Ad omnesque senserit nam, mea fugit nobis appareat ad, reque possit viderer eam cu.</p>
<p>Rebum everti sanctus mea ad, ex vis nisl nusquam, liber tamquam has ea. Id minim solet postulant mei, mea no atqui liber dolorem. Brute quando audiam nam ut! Prompta euripidis honestatis sea ea, sit laudem populo constituam ad! Case volumus suscipit et qui, audiam graecis noluisse sea te.</p>
<p>Ei cum verear efficiendi, qui ne copiosae probatus corrumpit? Te qui denique adversarium, ludus aperiam accumsan quo ea. Quot falli delenit te eos, pro ea putant adversarium, nam probo graeci consequat ei. Ius minim luptatum perfecto eu, laudem definiebas an pro, in aeque dicit appellantur nam. Sea eu amet nullam placerat, id vim veri patrioque. Nec cu vide fuisset!</p>
<p>Duo clita tritani vivendum ne, cu mei equidem postulant elaboraret. Ut mei malorum aliquando, inermis ancillae sit ad. Tation quaeque maluisset mel te, vim an feugiat vivendo periculis. At eos omnis eirmod, te nec nostro invidunt senserit.</p>
<p>Labitur partiendo pro ut, an erat facilis quo, nec ut vitae primis invenire! Iudicabit percipitur qui id, graece rationibus suscipiantur ius ex, quem adolescens in has. Mei legimus senserit petentium te, dicunt aperiam tamquam cu pri, cum id aeque quidam eirmod. Eum erroribus intellegam ne, nam accusata recteque ut, error fastidii suavitate ei ius. Detracto legendos voluptatibus vis ut, ut tollit imperdiet torquatos eam, indoctum principes aliquando duo ea.</p>
<p>Has et minim aperiri splendide? Ut usu elitr essent menandri? Ius te quem harum habemus, pri ea essent appareat iudicabit! Alterum probatus elaboraret ei eam, persius habemus offendit cu pri?</p>',
                'tmp_content' => null,
                'featured_image_id' => '12',
                'read_time' => '70',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '12',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Labore facilis vixut noquo soluta invenire',
                'slug' => 'labore-facilis-vixut-noquo-soluta-invenire',
                'summary' => 'Vix ex modo tation! Pro clita menandri eu, ei mea esse dicat. Eam ei alia lobortis salutandi, te qui essent ornatus. In sit recteque euripidis, sale qualisque no duo.',
                'content' => '<p>Labore facilis vix ut, no quo soluta invenire. Ius an nominavi quaestio intellegat, congue vulputate temporibus cu per. Offendit urbanitas dissentiet pri ea, mel salutandi mediocritatem eu? Quo ea quem homero temporibus, mel in sint ridens. Nam cu eirmod eloquentiam intellegebat. Sed at invenire molestiae concludaturque, ne sea elit molestie, repudiandae conclusionemque cum ne. Summo iudicabit et est, ex epicurei maluisset qui.</p>
<p>Veniam principes mnesarchum et nec, facete molestie convenire vel ei! Eam ea primis nominati mandamus, odio habemus molestiae te eum, ea qui veri maluisset! Ei mea lorem omnium ullamcorper, rebum pertinax interpretaris in mea. Nam et tantas placerat aliquando, mea te debitis constituam.</p>
<p>Vix ex modo tation! Pro clita menandri eu, ei mea esse dicat. Eam ei alia lobortis salutandi, te qui essent ornatus. In sit recteque euripidis, sale qualisque no duo.</p>
<p>Per eros graece facilis ad, docendi postulant euripidis ut sea, in facer voluptatum quo. Summo munere possim has ei, his quem inermis fuisset in! Ludus nemore inciderint pro at, nam quas recteque no! Has no magna delectus, stet liber ei mea! Sed idque laudem ex, no fugit fuisset pri. Ancillae eligendi facilisis ea mel, ad debet ignota altera qui.</p>
<p>Fierent ancillae id vis. Eu noster accusata imperdiet mei. Eum ad eloquentiam efficiantur. Sit ea graeci integre consequat, enim latine eruditi vim an. Sea ei habeo graeci, per et debitis voluptua. Purto postulant ei mea, officiis praesent salutandi pri cu. No nostrud postulant sed, no tollit similique vix, consul saperet his ei!</p>
<p>Et vel dicat graecis, ne nisl inciderint nec. Possim ocurreret eu eos, mea et ferri utinam, quo odio invenire recteque ei. Tempor phaedrum at duo, usu clita impetus ei, ea reque patrioque abhorreant est? Dicit bonorum adipisci qui id, modo veniam doming te has, ne nam sonet aliquam moderatius. Eius quando mandamus an sea, suas conceptam contentiones no pro. Sed te animal corpora, nec no dicunt adversarium, eum ad esse case omnesque?</p>
<p>Autem altera scripta id quo. Partem mediocritatem ei usu. At quo choro clita, eam melius accumsan sententiae ei, nec labitur nusquam ea? Nam ut impetus perfecto evertitur. Ei pro vidit mutat, augue qualisque an nec.</p>
<p>Enim docendi duo at. Pri dolorum senserit elaboraret ea. Tritani appetere platonem id per, eu eum habeo persius vituperatoribus! Mei congue ancillae at, eum ex possit eruditi, cu quis salutandi sit. Vivendo salutatus comprehensam mea cu.</p>
<p>Has ut illud justo noluisse. Inimicus maluisset te vel, ut vim aeterno eruditi vivendum! Ea ius vivendo iudicabit? Laoreet appareat sententiae eu vis. Mea te eleifend adolescens, ex aeterno consulatu vituperata mei?</p>
<p>Mea ex enim mazim assentior, assum facete molestiae ad eos. Ad vim lorem dictas viderer, est ad audire mandamus. Menandri periculis quo an, vix mucius nominati ad. No sit habeo bonorum vivendum, duo audire molestiae ne, cu quo incorrupte deterruisset? Nec ferri doctus nostrud in, duis congue dolorem ad usu!</p>',
                'tmp_content' => null,
                'featured_image_id' => '11',
                'read_time' => '63',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '13',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Dicta commodo ponderum te usu',
                'slug' => 'dicta-commodo-ponderum-te-usu',
                'summary' => 'Dicta commodo ponderum te usu. Nibh ferri et est. Dolore noster offendit eum ea, cum et odio meliore reprehendunt. Soluta fabellas vim in, cu sit graeco quaestio scriptorem, has in esse brute.',
                'content' => '<p>Ne tation deleniti quaestio eos. Pro aeterno moderatius vituperatoribus ei, cum id dicat delenit accusamus, dicunt quodsi eu cum? Ignota quodsi cum ea, cum omnis veniam mediocrem at. An sed consul omnium reformidans, ut cum feugiat fabellas! Nam choro adversarium ne.</p>
<p>No eum quodsi percipitur, dicit menandri vix cu? Eos id stet signiferumque? Errem sanctus menandri nam no, cu dolorum incorrupte mei. Unum sale timeam ea eam, laudem impetus sea id. Pro ne ferri omnes facilisi?</p>
<p>Et repudiare cotidieque sit? Dicat assueverit qui ei, an illum altera vulputate eam? Eos cu eripuit similique maiestatis, mazim iudico dolores cu sea, oporteat erroribus pro in. Duo eu commodo scaevola interesset.</p>
<p>Mediocrem similique ne ius. Est hinc veri ceteros ei! Eu vel decore doming eruditi, ea per bonorum constituam, case nobis consectetuer ex vis! Vis cu natum equidem, cum mazim periculis adolescens ea. Usu ne ferri nonumes petentium, vix causae phaedrum ne?</p>
<p>Ad est nihil vivendo sensibus. At eam noster reformidans, ei nec elit elitr saepe. Ius et prima torquatos, elitr quando pericula ea est! Mei ea dolor civibus hendrerit, ut est sensibus voluptaria. Erant viderer id vix, per no tantas bonorum vituperata, vis cu vivendum rationibus consectetuer.</p>
<p>Dicta commodo ponderum te usu. Nibh ferri et est. Dolore noster offendit eum ea, cum et odio meliore reprehendunt. Soluta fabellas vim in, cu sit graeco quaestio scriptorem, has in esse brute.</p>
<p>Vix debet atomorum scripserit ne, eos feugiat scribentur delicatissimi ne. Pri ei movet iudico scripta, sit latine oportere consequuntur ea. Eum dicat volumus cu, agam singulis conclusionemque te duo, erroribus mnesarchum dissentiet an eam. Graeco assentior ius eu, debet electram ius id. Quo sint fabellas ne, malorum definitionem per ea, ea duo scripta minimum deserunt. No eros petentium intellegam eos, minim congue feugait id duo, nec no purto legendos.</p>
<p>Blandit delicata molestiae te eos, graeco scaevola molestiae ne has. Porro nonumes id est. Aliquip integre cu quo, ad altera corrumpit per. Falli tibique ea nam, te mei erat nihil. Laudem euripidis mei ne.</p>
<p>Sed aeque mucius constituam ea! Id omnes deserunt urbanitas qui, ex sea suscipit necessitatibus. Te has dolorem fierent splendide, te justo erroribus repudiare sed, est et dicat neglegentur. Ignota volumus et eos, no salutandi conceptam reprimique nec. No usu mucius graeco oblique.</p>
<p>Eum primis eripuit probatus ea, et eum libris tibique. Eos audiam option consulatu ei, usu dicant utamur et? No eruditi propriae pri, per munere impetus argumentum ad? Sea porro vocent ne. Ius ei tota habeo. Verear nostrud democritum an mea.</p>',
                'tmp_content' => null,
                'featured_image_id' => '40',
                'read_time' => '56',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '14',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Aeque legendos voluptatibus adhis',
                'slug' => 'aeque-legendos-voluptatibus-adhis',
                'summary' => 'Te cum noluisse omittantur, semper corrumpit nec id! At ius alii primis consequat, pri exerci altera te, ea postea labore persius vel. Nec ea luptatum posidonium instructior. Ut facete doctus antiopam mel.',
                'content' => '<p>Aeque legendos voluptatibus ad his. Has te postea perpetua, vel et dictas convenire omittantur, tamquam accumsan appareat ius eu. Sit ea nostro eirmod concludaturque, an quo meliore scaevola gubergren! Eu sit vidisse inimicus, vis quas iriure evertitur in. Ex enim dicam sea? At minim equidem mea, his ut ignota delicatissimi.</p>
<p>Te cum noluisse omittantur, semper corrumpit nec id! At ius alii primis consequat, pri exerci altera te, ea postea labore persius vel. Nec ea luptatum posidonium instructior. Ut facete doctus antiopam mel.</p>
<p>Quis tamquam numquam eu ius. Sanctus labores percipitur mel te. Et usu dicit definitiones, et utroque apeirian moderatius vim. Oporteat conclusionemque duo cu, eum ea nibh vide ridens, ius tantas vituperatoribus ea! Ut congue scripta bonorum nec. Ad quodsi aliquid platonem est.</p>
<p>At possim appareat ius! Et ornatus signiferumque cum, cum fierent fabellas id, simul tollit nec ei. Mel feugiat salutatus in, prodesset signiferumque id mea. Ex laudem audire qualisque eos, albucius dissentias te usu?</p>
<p>Ex pri summo prodesset, at omittam repudiare ius, meliore dissentias at vix. Per vocent audiam constituam in! Ex sea blandit deseruisse interesset, vel no tantas aperiam docendi. Sit aliquip scribentur eu, eirmod reformidans liberavisse at pro.</p>
<p>Ipsum vitae sensibus vim at, nihil moderatius has in, feugait evertitur te sit? Ex usu probatus imperdiet. At vis solum libris, esse ferri pericula sit cu? Te mel quis habemus, cu cum docendi nominati.</p>
<p>No scripta inermis complectitur eum. Sit atomorum laboramus in? Odio sumo nam no. Blandit lobortis per no, iudico cotidieque necessitatibus vix ea, pri ex audiam petentium honestatis. Alii utroque complectitur an has, no mei mazim quando. No aperiam insolens nec, et vis homero graeci definitiones. No duo paulo reformidans, vitae munere dolores id mel.</p>
<p>Iriure gubergren suscipiantur no nec, no commodo delectus mei, ea quo doctus commune! Laoreet adipisci reprehendunt cum ex, an eos graeco eleifend platonem, mel ad deserunt pericula. Te nonumes recusabo dissentias sit? Meliore copiosae pertinax et mel. Saperet indoctum appellantur an vix, an autem detraxit efficiantur sit? Ut vitae sanctus quo, ea pri dolorum vocibus!</p>
<p>Nonumy timeam patrioque te mea, est quidam civibus sententiae ut. Sea id esse aperiam referrentur. Ad mei utroque delicata, qui et lorem ponderum necessitatibus, duis vitae tation id usu! Id hinc explicari appellantur est, est in debet harum saperet, at ius illum tollit. Fabulas appareat duo ad! Commodo accommodare concludaturque eam ut, putant vivendo perpetua et mei!</p>
<p>His oporteat tractatos ne? Aliquip persecuti contentiones te duo, nonumy nullam prodesset sit id? Sed an congue pertinacia. Ad solum elaboraret eos, his ne sententiae sadipscing scribentur, no qui aliquid corrumpit! Consul bonorum in ius, exerci fuisset sapientem mei et. Ad qui nemore eligendi democritum, cu his deseruisse interesset?</p>',
                'tmp_content' => null,
                'featured_image_id' => '39',
                'read_time' => '60',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '15',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Vim at modo convenire partiendo',
                'slug' => 'vim-at-modo-convenire-partiendo',
                'summary' => 'Te paulo omnesque sed, pro id discere fastidii, pro sint utroque invenire at. Et nusquam reformidans sit, ea aperiri eripuit vel? Ea has dicam sanctus, quo te amet animal, alia invenire vulputate pro ex? An sint detraxit consulatu mea, appetere tacimates no usu.',
                'content' => '<p>Vim at modo convenire partiendo, nec te posse exerci, cum quando expetendis te? Omnesque volutpat his an, eos dicam accusam elaboraret cu. At eam meis bonorum, ferri voluptua per no. Ex inani posidonium ius. Vel verear adipisci in.</p>
<p>Semper iuvaret pericula sit ad, vel dico ferri iudico no. Ei dico euismod has? Et pri sale solet, ei usu salutandi assueverit. Eius accusam deseruisse an per! Vide adhuc ullamcorper ei usu. Ne solum minimum referrentur nec, et erat epicurei scribentur vim. Et ius amet stet aliquip, sea alienum fastidii constituto ei, ius dicit laudem an.</p>
<p>Te paulo omnesque sed, pro id discere fastidii, pro sint utroque invenire at. Et nusquam reformidans sit, ea aperiri eripuit vel? Ea has dicam sanctus, quo te amet animal, alia invenire vulputate pro ex? An sint detraxit consulatu mea, appetere tacimates no usu.</p>
<p>At legere persecuti assueverit vis, no per posse facilisis efficiantur. Ut eum enim vidit brute. Nam nihil nostro atomorum ad, falli ubique accumsan pri ut. Nibh legendos pertinacia vix ut? Eirmod voluptua eos an, his amet regione discere te. Qui te nullam docendi? Ne his legere omnesque, electram argumentum reprimique ea eum?</p>
<p>Nonumy vidisse eos eu? Ex eos appareat efficiendi contentiones, vis ei deserunt tacimates euripidis, quot eligendi percipitur ius cu? Pro eu tritani denique scribentur, wisi ornatus evertitur vix te. Iuvaret dignissim mea ne, an melius tacimates euripidis pri. Te pri utamur nonumes postulant.</p>
<p>Ea doctus denique appellantur sed, semper temporibus referrentur duo ex. Sed cu dicit debitis, per lorem eleifend voluptatibus ut? Cu nam soleat comprehensam, id vim illum possit maluisset! Ut molestie petentium dignissim eum, augue partiendo qualisque vix ad.</p>
<p>Ea feugiat neglegentur theophrastus per. Sonet accusam in mei. Alia gloriatur cu pri, sit congue detraxit philosophia et, unum prompta usu ei. Eam in everti maiorum, et ius graece constituto?</p>
<p>Vix in utroque eleifend. In nam homero aliquip voluptaria. Mucius platonem ne mei, id sed mollis reprimique, quo ex nonumes fuisset! Sit labore persius no, no mea bonorum detraxit, eum et nonumes forensibus. His dicant diceret delectus at, at pri detracto molestiae voluptatibus?</p>
<p>In quo partiendo sadipscing, ei eirmod elaboraret est. Vim ex suscipit consetetur, pro et recteque aliquando similique. Vim audiam meliore at! Consul verterem sadipscing eum ex, ne usu primis torquatos. Amet nominavi sit ut.</p>
<p>Aliquid concludaturque eum ea, eam ad malorum laboramus definitionem, nam no oblique instructior! Pri utroque blandit at, cu hinc movet docendi per, te fierent reprimique pri. Cum no persius impedit accommodare, no decore corrumpit qui, eu omnis aliquam sanctus per. Dolores antiopam maluisset at eos?</p>',
                'tmp_content' => null,
                'featured_image_id' => '38',
                'read_time' => '57',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '16',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Magna aeque aneum visreque omnesque',
                'slug' => 'magna-aeque-aneum-visreque-omnesque',
                'summary' => 'Ne pri scripta atomorum, eros primis assentior mea at. Cu impetus temporibus est! Sale dicit cum ut. Movet denique officiis at usu!',
                'content' => '<p>Magna aeque an eum, vis reque omnesque scriptorem ad, id eam sint quot corrumpit? Id dicunt virtute qui, ut has diam case evertitur, purto numquam intellegam eu his? Ad vel dolores postulant, porro consequat an cum? Agam scripta concludaturque ius eu, ad tritani volutpat sapientem sit! Ex legere soluta scripta vim, agam luptatum assentior cu sea, zril voluptua his no. An mea alterum placerat.</p>
<p>Putant dolorem fuisset pro id, sea porro everti nostrum ut, dicunt utroque ea duo! Nec ne illud error liberavisse, at duo graece efficiantur. Sed id eripuit fabulas scripserit, alii volutpat vim ea? Ei erat ignota ancillae pri.</p>
<p>Veri dicant indoctum eum ea? Nibh consequat definitionem ei his? Philosophia theophrastus usu id, pri aliquip maiestatis ea, at duo mucius detracto placerat! Quot postulant id sed! Mei appareat vituperata in, eius tractatos reprimique nec no.</p>
<p>His ad timeam iudicabit rationibus, vix ea ancillae tincidunt voluptaria! An pertinax evertitur concludaturque eum, ad vim tritani iudicabit. Ea erat vulputate consectetuer mei? Eu nec everti aperiri rationibus, ex pri debet constituam! Sea ne clita corpora tincidunt, nam possit habemus phaedrum et. Ad dico illum ius.</p>
<p>An qui oblique probatus voluptatum, usu ea pericula expetenda assueverit, cu autem legimus antiopam pro! Usu te vulputate sententiae. Nec eu mutat mentitum omittantur? Mea purto dicunt ad.</p>
<p>Ne fabellas invenire suscipiantur vis. Vel cu tota ceteros urbanitas, ea mel tempor honestatis. Etiam nullam praesent ei mel, utroque lobortis cum eu. Sea ignota discere cu, homero vidisse apeirian at vim.</p>
<p>Ne pri scripta atomorum, eros primis assentior mea at. Cu impetus temporibus est! Sale dicit cum ut. Movet denique officiis at usu!</p>
<p>Cibo efficiantur his ne? Et eos movet menandri, id debet antiopam vix. Ne est ludus detracto. Inermis conclusionemque mea ea. Nam quis contentiones id, ex eam wisi omittam!</p>
<p>Usu id aeque epicuri omnesque, stet cibo legimus no nam. Id pri clita denique vituperata, ius enim illud doctus eu, pri latine urbanitas ut! Quo autem explicari id. Tempor voluptatum scribentur te mel, cu mei perfecto sapientem. Soleat vocent impedit at nec, atqui sensibus accommodare mei et! Mei at mazim nostro appareat, pri in detracto elaboraret ullamcorper?</p>
<p>Dicat tibique constituto eum ea, omnes homero partiendo at ius! Tamquam expetendis interpretaris sed ut, eum summo doctus electram ut, eam paulo oporteat ne? Qui aeterno similique ne, vim assum dicant ad, ex est modo graeco tincidunt. Autem altera eligendi cum an, sit periculis persecuti no. Eos cibo omnes vitae in, has error quaeque ponderum ea.</p>',
                'tmp_content' => null,
                'featured_image_id' => '37',
                'read_time' => '55',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '17',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Quo illud dolor legimus cused',
                'slug' => 'quo-illud-dolor-legimus-cused',
                'summary' => 'Vidit alienum cu vix? Te nulla postulant his, suavitate intellegebat te his? Aliquip veritus eum ad. Sit luptatum posidonium ea!',
                'content' => '<p>Quo illud dolor legimus cu, sed nibh vituperatoribus cu, veri consetetur reprehendunt est cu. At ignota adversarium mei, an mea duis mazim impetus, mei et enim dissentiunt? Ne eum quem hinc iusto, et harum tempor cum, mea an scaevola molestiae! Putant neglegentur deterruisset his at, ubique laoreet consetetur has in, nec quis petentium ad! Ne recusabo nominati nam, ne fabellas facilisi forensibus mel!</p>
<p>An tempor salutatus nec. Cu facilis invenire vix, modo case labitur te duo. No dico equidem delenit mei, vix in nonumy noster platonem. Suas integre dissentiet usu id, his ei falli incorrupte.</p>
<p>Ea iudico vidisse minimum pri? Te malorum reprimique qui, vel sint error torquatos no? Eam ei falli quodsi detraxit, duo brute possim adversarium id! Essent graecis eligendi pri te, ut ius primis aliquid assueverit. Te quo illud minimum signiferumque, has postea commune ne. Qui velit adipiscing ut. Eu tale inani exerci nec, te pri nominavi voluptua, soluta suavitate ad nam.</p>
<p>Porro malis primis ex est. Id qui laudem iriure theophrastus! Eam at dictas ponderum persequeris, mei minimum ocurreret id. Ad mea labores impedit. Vitae repudiare nam ne, ei maluisset salutatus sit, ne eam consulatu mnesarchum.</p>
<p>Ius te erat porro nostrud, in rebum soleat habemus vim! Harum delenit invidunt no mea. Laoreet facilisis voluptaria no duo, ea quem natum has, suscipit salutandi neglegentur vim no? In habemus maiestatis mea, oratio philosophia ei sit! Ne solum iusto tincidunt quo.</p>
<p>Vidit alienum cu vix? Te nulla postulant his, suavitate intellegebat te his? Aliquip veritus eum ad. Sit luptatum posidonium ea!</p>
<p>Id exerci sensibus disputationi per, has id labore option! Has sale delenit consequuntur te, ei iusto facete nec? Ei nec facete percipitur ullamcorper, ea per illud tincidunt. Vel ut iusto facete probatus? Adipisci lobortis no eos, vel id vivendo molestiae definitionem, prima expetendis ex mei.</p>
<p>Ei movet ridens scripta eos. Ignota vulputate ad quo, ex qui adhuc hendrerit, ad vis facete regione. Ut habemus commune intellegam vel, choro insolens eu per? Qui virtute salutandi persequeris no, putent assueverit mei ei.</p>
<p>Liber vulputate deterruisset sit ei, te graeci facete consequuntur mel! An alterum honestatis has, at postulant disputando sed? No exerci iriure mea, quo atqui error voluptua ei! Ei duo nonumy rationibus posidonium, habeo aperiam aperiri vix an, corrumpit persequeris efficiantur no usu. Ex probo quidam lucilius has, ne porro veritus omittantur nam.</p>
<p>Insolens molestiae suscipiantur te his. Mucius copiosae id quo, malis omittam cu nam, ullum iracundia est in. No simul eligendi delicata per, ea mel utinam facilis, sale mollis referrentur ei mea. Has populo mollis te, placerat inimicus te qui. Te quaestio mandamus torquatos cum!</p>',
                'tmp_content' => null,
                'featured_image_id' => '36',
                'read_time' => '61',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '18',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'At vis aliquid iudicabit consequat',
                'slug' => 'at-vis-aliquid-iudicabit-consequat',
                'summary' => 'Usu cu offendit tractatos, eligendi adipiscing ei nec? Mea duis feugiat definiebas et. Ne per nostro lucilius! Et cum aliquid dolorum, vidit consetetur eum ex?',
                'content' => '<p>At vis aliquid iudicabit consequat, eu pri altera aperiam deserunt. Ei molestiae gloriatur pri, ad cum ocurreret torquatos. Mucius complectitur ex ius, munere persecuti vel no. Per tota solet signiferumque cu, ad agam senserit mel! Ut pro primis appetere, et purto meis impetus has. Per modus tincidunt cu, ex nam facer ancillae?</p>
<p>Et usu zril possit possim, vim tacimates delicatissimi ex? Sit an verear placerat reprimique, et est congue vocibus? Erant exerci adversarium has te, et munere mnesarchum mei! Cu vel meis fierent, nec alia iracundia ea, at iudico qualisque duo? Eos virtute iudicabit efficiantur ei, fuisset fierent mnesarchum no nec! At vide iudico petentium sed, cum tollit aperiam oblique ne, dolor saepe imperdiet ad eos?</p>
<p>Vide harum voluptua vis an, ut his mazim dolore scripserit. Quo ea quem modo viris, mel quem dolorem gloriatur te, aperiam discere contentiones vel in! Probo populo option an vix, nec nulla insolens moderatius ei? Ex labore sapientem his? Aeque nostrum at sed. Dolor constituam ut vix, in alterum deleniti fabellas vel, pro ad mazim tollit?</p>
<p>His oratio mucius nonumes et, vim ad alii iudicabit. Nulla maiestatis temporibus mei eu, eos in ludus atomorum, eu est iuvaret persecuti signiferumque? Alienum contentiones pro ex, usu cu soleat accusam accusata. Mei te admodum disputando.</p>
<p>Usu cu offendit tractatos, eligendi adipiscing ei nec? Mea duis feugiat definiebas et. Ne per nostro lucilius! Et cum aliquid dolorum, vidit consetetur eum ex?</p>
<p>Ei has legere bonorum mediocritatem. Cu has recusabo posidonium, mel laudem nostro fabellas ut, feugiat constituam reprehendunt te nec! Ex vel summo minimum appetere! Et vim bonorum vocibus. Aeterno maiorum splendide mea ne, vide audire pri ne, cum no nullam labore facilisi.</p>
<p>Ex abhorreant vituperata pri, ut option laoreet cum, exerci tempor vulputate ex mei. Discere facilisi intellegebat te vis, wisi malis minim cum ad. Ea mutat albucius evertitur est, ei molestiae assentior per? Eius apeirian philosophia pro ei, possit appareat neglegentur mea an. Duo ut munere facilis mediocrem, id sit unum aliquip philosophia, et per sonet consequat.</p>
<p>Ornatus constituam referrentur te mei, pri no autem nusquam deserunt. Suas atqui abhorreant sed ea? Ex qui case viderer evertitur, dolorum quaestio sensibus quo et! Enim summo est ei! Regione disputationi ad his, per ex eruditi accumsan principes? Hinc nulla iudicabit nec at, eos graecis mandamus id.</p>
<p>In duo habeo rebum menandri, primis salutandi an sit! Eu minimum euripidis vis, rebum eligendi intellegam te his, ignota equidem ut vis. Nec no commodo tamquam! Mei vero iudico et. In omnium dolorum eos, eum cu nobis quaerendum conclusionemque, ea referrentur signiferumque sit! Dicta dicunt dolorum in vix, eam ut nulla exerci?</p>
<p>Mei antiopam senserit et, nobis oportere prodesset pri ut, sit probo deseruisse id. Mea at erat tollit nemore, mei latine pertinax explicari at. Has ut malis tollit altera, ne est labore prompta dissentias. An deleniti abhorreant disputando vis, per facilisi senserit ei, ex his ullum sonet! Pro no mentitum copiosae expetendis?</p>',
                'tmp_content' => null,
                'featured_image_id' => '35',
                'read_time' => '65',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '19',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'In eum molestie definiebas delicatissimi',
                'slug' => 'in-eum-molestie-definiebas-delicatissimi',
                'summary' => 'Te has convenire consetetur. Nam ut admodum referrentur? Aliquid equidem sit ne, ne eam everti accommodare! Sit delenit iracundia consetetur ex, quod choro possim eu usu?',
                'content' => '<p>Quod tollit eam ex, ut convenire contentiones quo. Sumo commune adipiscing pro ut, prima everti explicari nam an, zril primis oporteat te eos. Qui id dicunt utroque, veniam nostro gloriatur te mei. Ea alii vitae ornatus sed, no euismod omnesque ius? Movet voluptaria honestatis his ad. Dicat tollit impedit usu an, ignota neglegentur te mel!</p>
<p>Ut regione detraxit vix, an mel mentitum offendit, no per omnis primis invenire? No has agam albucius partiendo, ei vix corpora perfecto, ullum facilisi te per? Natum eloquentiam an mea, admodum suscipit singulis at vis? Id sumo numquam qui, duo an porro etiam munere. Assum democritum eos ne. Sit cu nibh populo quodsi, vim an debet malorum.</p>
<p>In eum molestie definiebas delicatissimi, officiis torquatos cu usu. Has ad laudem semper percipit, ex eos erant fabellas consulatu. His sint modus salutatus in! Hinc posse noluisse vim ne, nibh veri viris eu nam. Ex nihil dolore est, choro eirmod sea ea? Nominati appellantur at sed, quem quot quando an vel.</p>
<p>Eam in alterum alienum recteque, te illum instructior mea, has probatus democritum eu? Duo dignissim elaboraret ea. Id illud admodum phaedrum ius? No vocibus philosophia his. Feugiat efficiendi comprehensam cum at? Ut inani essent nec!</p>
<p>Dicam pericula scribentur eu pri, ius id debet blandit necessitatibus! Et prima omnium sea, quo ad mandamus iudicabit consequat? In has diam zril philosophia. Aperiam admodum dissentiunt has no, vis te tantas feugait assentior!</p>
<p>Primis tritani eam ad. Et per dolorum placerat probatus. Viris senserit ei eos, cu mel tritani voluptatum persequeris! Falli electram ad sea, vis no singulis eleifend. An novum albucius deleniti per, et vel vero doming? Cu nonumy scribentur mei, equidem blandit at duo, ad mel natum eleifend dignissim! Sed eu odio unum atqui, te sit autem disputationi, in iriure vivendum vis!</p>
<p>Has ei dolores oporteat, nibh quas quaestio in sit, ridens senserit eos et. Sea modo natum discere ne, id sint dicam libris has. Nam rebum detracto ad, ornatus platonem nam id. Ut audire adolescens has, purto quaeque duo ei. Autem viris graece at sea, mollis interesset vis ut. Sea quaestio concludaturque ex?</p>
<p>Ius ad sanctus recteque liberavisse, dictas audire recteque usu no? Suas putant mei an, ignota impetus aliquam his ad! Vim no semper causae laoreet! Veniam blandit scriptorem vim ea?</p>
<p>Ei oblique splendide eum, vim erant option no? Ut aeque fierent constituto sed, ei consul adipiscing vel? Pro tantas commune apeirian te. Id sea erat facilisi. Usu detracto legendos intellegat et, libris semper aperiri eum no, id duo elitr salutandi.</p>
<p>Te has convenire consetetur. Nam ut admodum referrentur? Aliquid equidem sit ne, ne eam everti accommodare! Sit delenit iracundia consetetur ex, quod choro possim eu usu?</p>',
                'tmp_content' => null,
                'featured_image_id' => '10',
                'read_time' => '61',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '20',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Pericula adipiscing quaerendum necut?',
                'slug' => 'pericula-adipiscing-quaerendum-necut',
                'summary' => 'Ei tamquam tacimates his. Eos hinc evertitur conclusionemque ea! Nam ei suas habemus, an semper ceteros appetere sit! Vis cu exerci aliquid definiebas, sit omittam fabellas urbanitas ei, tale novum vis an.',
                'content' => '<p>Pericula adipiscing quaerendum nec ut? Ne qui prodesset temporibus, eum te nulla meliore civibus, wisi dicit senserit at pro? Vix an choro partem ridens, ea nostro ullamcorper concludaturque cum! Elitr hendrerit ei vel, ei usu augue possim alterum. Usu in case reprehendunt, falli placerat et eum! Debet hendrerit has ut, id quo populo pericula. Cu nullam tincidunt has.</p>
<p>Munere animal ornatus eu vis. Usu ne laudem fabellas legendos, eu clita eirmod nusquam quo, cu vis voluptaria scriptorem delicatissimi. Et choro eleifend imperdiet pri, alia vidisse dolores ei eos, exerci latine vel eu. Vis ei omnes prompta tractatos. Alia eripuit eligendi id per!</p>
<p>Sed te suas oportere omittantur, mollis atomorum laboramus mea id. Oratio legimus constituto te vis, qui ex numquam voluptatum. Cum euismod impedit ei, corrumpit sadipscing in pri! Ad unum accumsan qui! Id mazim nullam vix, ius in propriae repudiare, eos habeo virtute dissentiunt at.</p>
<p>Cu est omittantur delicatissimi, id mei honestatis voluptatibus, mediocrem maluisset duo id! Verear salutatus mea at, pro zril aperiam splendide ut. Et mollis recusabo disputationi mei. Esse praesent ut pro, per epicuri maluisset ut?</p>
<p>Alii deterruisset mea ei. Ei iusto patrioque cotidieque eum, et his labitur reprimique, ea iisque epicurei dissentiet vel! Ea bonorum vivendo corrumpit duo, idque utroque abhorreant cu eum! Qui inermis epicurei platonem id, adipisci corrumpit nam in, mutat laudem in mei.</p>
<p>Utamur volutpat qualisque in sed, has cu utroque copiosae? Quaeque fuisset pericula sit an. Vim clita eligendi intellegam cu, mei ad mutat saperet salutatus. In dolore conceptam sea. At has mundi quodsi pericula, id his falli eleifend. Ne eam melius alterum, iudico fabulas electram vim in.</p>
<p>Sed legimus docendi albucius eu! Eam verear iudicabit percipitur ei, per cu harum scripta noluisse. Ex putant dolorem tacimates eos, nihil zril est at, pro eu quodsi discere vivendo! His vidit idque dicta in, pro ne graece everti constituam?</p>
<p>Sit elit efficiantur ei. Eos errem tempor consequat ne, audire noluisse efficiantur ut vel, eam erat ceteros incorrupte ex! Vix an omittantur dissentiet, ne alii vocent comprehensam qui. Te rebum sententiae usu. No sea adipiscing posidonium!</p>
<p>Ei tamquam tacimates his. Eos hinc evertitur conclusionemque ea! Nam ei suas habemus, an semper ceteros appetere sit! Vis cu exerci aliquid definiebas, sit omittam fabellas urbanitas ei, tale novum vis an.</p>
<p>An wisi alterum prodesset cum, an aeterno persius pri. Id iisque virtute mei, dolor ancillae ut per. Vix an nisl disputando. Suavitate dissentiet est an, ei pri harum facilisi argumentum, ut cum cibo reprehendunt.</p>',
                'tmp_content' => null,
                'featured_image_id' => '9',
                'read_time' => '57',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '21',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Augue paulo bonorum proan nostrum',
                'slug' => 'augue-paulo-bonorum-proan-nostrum',
                'summary' => 'Augue paulo bonorum pro an, et ius putant nostrum intellegat! Vis habeo facete quaeque cu, ea tota dolorum quo. Audire molestiae tincidunt et sit. At ubique ornatus moderatius duo.',
                'content' => '<p>Augue paulo bonorum pro an, et ius putant nostrum intellegat! Vis habeo facete quaeque cu, ea tota dolorum quo. Audire molestiae tincidunt et sit. At ubique ornatus moderatius duo.</p>
<p>Ut nec soluta efficiantur, ut nihil voluptaria pro, delenit habemus ut eam! Ei unum commune gubergren nam, sea menandri pericula ea, mel id probatus intellegam quaerendum? Mei illum facilisi indoctum ut. Tamquam menandri adolescens eu nam. At enim vivendo nam? Oratio splendide gloriatur sed et, sumo corrumpit percipitur eos ex, ei solum exerci eos. Dico assueverit an est.</p>
<p>Mel ad fugit vituperata. Te nullam abhorreant neglegentur vel. Fastidii maluisset constituam vis cu, at elit timeam duo, unum impedit facilisis mea ut. Duo clita diceret inimicus ut, aperiam scriptorem ex eum!</p>
<p>Vel nobis partiendo te. Eum at quaeque fierent, qui velit nusquam iudicabit at, ea nam falli nominavi expetendis! Euismod ornatus quo cu, mel et scripta accusam, ut pri brute regione denique. Sea ei solum vivendo, has cu simul clita conclusionemque?</p>
<p>No sea choro postea, vis debet veritus vivendum ex? Per quot eros et. At quo ignota volutpat definitiones, et per putent tamquam scripserit. Quo nulla minim delectus et? Probo nonumes epicuri id eos, iriure facilis pro ex? Sea mucius timeam vivendo te, ex odio graeco sed, in fugit graecis quo!</p>
<p>Assum voluptua vituperata ea eos. In vel agam primis adolescens, est in dicam copiosae atomorum. In albucius deleniti usu, liber expetendis eam an, id sit nostrud corpora elaboraret. Ius ad iusto maluisset interesset! Ad autem intellegebat vis. Nominavi senserit sit ut! Cum officiis dissentiunt ex, ei vel menandri voluptaria.</p>
<p>Sapientem conclusionemque et pro, quo autem consul volutpat in? Graeci timeam usu no, ne pro vidit ridens, everti omnium epicurei te eam. Propriae splendide et pri, his labore habemus gloriatur ex, at vix alia ridens. In magna corrumpit his, vel solum electram suscipiantur te, te laudem eruditi percipitur ius! Natum sensibus vituperata his id, vel at quas autem, nominavi sensibus ocurreret id est.</p>
<p>Facete argumentum no qui, eos ne reque paulo intellegebat. In has iuvaret recusabo, vim eu simul perpetua. Vix mazim molestie necessitatibus cu, id eum discere efficiendi scriptorem, id facete corrumpit cum. Mea soluta explicari in, ex has iriure aperiam maiestatis, te nam ipsum nihil recteque.</p>
<p>Te nec minimum explicari, vix alii quaerendum cu. Te probo viderer alterum vel, ei saperet disputationi reprehendunt sed, in tollit utamur petentium nam? An cum autem impetus, doctus timeam est in, in commodo appareat hendrerit sit. In pro blandit sapientem, in eos option saperet. Ne choro integre vel, facer dicunt postulant nam id. Ius at veri animal gubergren, his diam vitae ut, sea ne tincidunt pertinacia eloquentiam? Option albucius conclusionemque ne nec?</p>
<p>Nam minim tractatos in! Pro vitae quaeque erroribus an, mundi virtute nam ex! Ex veri eirmod philosophia eos, qui ex adolescens reprehendunt. No consequat vulputate pro.</p>',
                'tmp_content' => null,
                'featured_image_id' => '8',
                'read_time' => '63',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '22',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Legimus tibique scribentur ut mel',
                'slug' => 'legimus-tibique-scribentur-ut-mel',
                'summary' => 'Has alii malorum propriae ut, eos ei debet persius invidunt! Ut possim persequeris cum, agam expetenda at usu. Sea et dolor consul timeam, an per autem reque. Cetero volumus sadipscing mel ut?',
                'content' => '<p>Legimus tibique scribentur ut mel, mea vero partem volumus et, in pro explicari torquatos definitiones. Quodsi mentitum pericula ut per, omnis similique est et! Falli volutpat gloriatur mel in, ei zril noster perfecto sed! Eum tale molestiae ei, ei mel accusam fabellas. Dicant laoreet delicata sea cu, eum vero aliquam ea?</p>
<p>Habeo aeque invidunt id ius, ex veri prima perfecto mea. Usu docendi pericula no, ne tractatos mnesarchum his. Sea ea graecis gubergren reprimique. Nec at solum idque! Ullum aeterno electram sed in, cu pro minim mundi, etiam utinam menandri an sea! Ei adhuc civibus vix, inani maiestatis quo et.</p>
<p>Id sonet qualisque duo! Singulis assueverit dissentiunt per eu, in ius convenire incorrupte argumentum, mea nostrum voluptaria ea? Ne cum essent maluisset! Viderer alterum in nam, has etiam fuisset reformidans ei? Error abhorreant appellantur usu et, cum nibh elit ut.</p>
<p>Te civibus imperdiet mel, ex nemore quaeque consulatu cum? Veri possim minimum pro id. No vix graeci voluptua, eos id malis harum. Qui ne esse laudem epicuri!</p>
<p>Mei ne omnium mnesarchum, dolorum fuisset sit cu. Elit dicat nec no, quo ut iusto graeco feugait. Eos veri perpetua eu! Duo liber fastidii phaedrum te. Pri ea commodo veritus, per ex idque eripuit reformidans. Falli tation posidonium ius ea, mea ei recteque vituperata, sit ei decore laoreet appareat.</p>
<p>Has alii malorum propriae ut, eos ei debet persius invidunt! Ut possim persequeris cum, agam expetenda at usu. Sea et dolor consul timeam, an per autem reque. Cetero volumus sadipscing mel ut?</p>
<p>Ei autem ludus eripuit vim, inciderint disputando repudiandae mei ne? Ne vim ubique aperiam, id verear invenire cotidieque mei! Illum omittam has id, ullum forensibus ius no? Ne vix rationibus moderatius constituam, vel ea movet tantas.</p>
<p>Ius ut dicunt dolorum voluptatibus, est denique reformidans ex. Te ignota noster eum? Nec cu habeo atqui, in eos graeci doctus, te mei meliore corrumpit? At melius corpora quo, vim doctus phaedrum platonem ne. Tibique blandit quo te?</p>
<p>Molestie placerat assueverit pro cu, fuisset expetenda consequuntur sed ex! Te rationibus signiferumque cum! Mea aliquid persequeris eloquentiam eu, eu vim augue forensibus? Ei autem offendit mea, nostrum placerat mei ei.</p>
<p>Ullum fabulas per in, corpora voluptua vel no, cu possit dolorum pro. Sit an electram tractatos, illum omnes pertinacia in ius. Eu autem blandit partiendo his! Percipit consectetuer his no. Ex melius corrumpit nec!</p>',
                'tmp_content' => null,
                'featured_image_id' => '7',
                'read_time' => '52',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '23',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Cu sea liber corrumpit honestatis',
                'slug' => 'cu-sea-liber-corrumpit-honestatis',
                'summary' => 'Est cu reque honestatis. Lorem verear ne sea. Nonumes fuisset in eos. Ea labitur definitiones sea? Et sed habeo antiopam sapientem, ea case admodum civibus vel.',
                'content' => '<p>Cu sea liber corrumpit honestatis, est unum tollit delectus no, ut has eros simul? An unum atomorum omittantur pri, ocurreret interesset repudiandae usu ex! Et est dolores erroribus. Ut sit dolor invidunt argumentum? Diam posse suscipit et sit. Sed sanctus vocibus te, pri purto probo possim id, qui ei phaedrum assueverit.</p>
<p>No est aeterno maiorum epicuri. Quo cibo scripta quaerendum in, at alii officiis verterem qui! Appareat accusamus no mea. In cum nisl delectus, quas mutat elitr eu vis, cu nostrum eleifend recteque per. No vivendo sapientem deterruisset ius. Iuvaret detracto liberavisse ei sit, definitionem interpretaris cu vix.</p>
<p>Eu qui malorum pertinax mnesarchum, dolorem feugait vel cu, te iracundia vituperatoribus duo! Eum hinc impetus integre ea, duo habeo definiebas ex. At soleat dolorum definitionem sit? At causae tibique senserit eam, congue ignota feugiat vel at, sit ei dicunt patrioque. Ad vix ornatus dissentias, cu vel maiorum sententiae quaerendum. Ex porro laboramus est? Purto virtute vivendo eu mei, vim ne tale blandit efficiendi, probo laboramus ut qui.</p>
<p>Est cu reque honestatis. Lorem verear ne sea. Nonumes fuisset in eos. Ea labitur definitiones sea? Et sed habeo antiopam sapientem, ea case admodum civibus vel.</p>
<p>His saperet impedit civibus at, vim an tantas mollis saperet! Animal delenit vocibus mei ei, quot scripta sapientem sit an. Vel melius consulatu ea. Hinc veritus per te, omnis soleat expetenda cu cum. Ex has invidunt deseruisse? Mel maluisset temporibus ei.</p>
<p>Eos ad assum efficiantur! Eam ut omnis forensibus vituperatoribus? Iriure consulatu voluptatum ad sit! Prima persius ne eum, tollit iisque voluptatibus id usu, ea volutpat forensibus liberavisse mei! Assum suavitate vituperata eos et. Est graeco sensibus reprimique no, an cetero accusam menandri nec, at mel tota probatus.</p>
<p>Usu ea modo ferri exerci. Sed ei graeci tacimates periculis, iisque deleniti at eam! Malis menandri nec an, similique vituperata temporibus eam in. Veniam luptatum efficiantur quo cu. Vim et ubique prodesset forensibus.</p>
<p>Per eu elitr solet, perfecto accusata theophrastus ei has! Nec aeterno fastidii ponderum in, his ut vero animal. Vix viris cotidieque ne, te eam saperet feugait antiopam? Erat vivendum constituto eu qui! Ad aeque deleniti oporteat his, appareat tractatos instructior sed id.</p>
<p>Cum ei putant invenire. Porro saepe ut sit, sit an diam erroribus, ad exerci apeirian referrentur mei. At nam insolens iudicabit, cum no facer nulla. Ei eirmod ancillae qui, atomorum petentium dissentias eu sed, essent aperiri maluisset per at. Duo doming integre ceteros id, nec fastidii eligendi adolescens at.</p>
<p>An nam tacimates ocurreret eloquentiam. Mei an petentium erroribus, no perpetua voluptaria vituperata vim, ad pri impetus intellegat! Nam tantas nemore ei, sit ei facilis interesset, liber fabulas mandamus ex qui. Mandamus posidonium at has, cu has utinam pertinacia, mea semper eruditi omittam ea. Ad has malis feugait.</p>',
                'tmp_content' => null,
                'featured_image_id' => '33',
                'read_time' => '64',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '24',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Convenire principes mnesarchum priid',
                'slug' => 'convenire-principes-mnesarchum-priid',
                'summary' => 'Simul voluptatum dissentias eu eam. Summo scribentur ne nam, quo ne iudico voluptua, usu ullum delenit eu! Tollit fabellas usu in? Usu eu impedit albucius, ut vim noster suavitate.',
                'content' => '<p>Convenire principes mnesarchum pri id, an est postulant democritum! Quo no verear timeam, minim verterem maiestatis cu vis. Duo ne dicit mentitum offendit, ea pri prima inciderint. Duo modo quot consul at, te assum dicam duo, vivendum expetendis scribentur eos at? Eligendi consulatu te qui, has tale clita vivendum ut.</p>
<p>Velit blandit nominavi id nam, quo ut soleat feugait fabellas? Quidam euismod aliquam ex ius. Eu sapientem splendide efficiendi vim. Ut quot cetero inermis vim, magna dicant offendit an sit? Ad his principes temporibus ullamcorper, eu has diam adipisci! Ad vix expetenda corrumpit sententiae. In has idque principes, est ut fuisset imperdiet incorrupte!</p>
<p>Novum omnes electram pri ut? Pri et cetero menandri voluptatum! Sit case soleat quodsi an, libris officiis petentium qui an. Cu quaeque scribentur theophrastus quo, ei his magna facilis alienum. Suas natum necessitatibus at pri, ad vel dicit aliquid liberavisse, pro vidit ocurreret constituam ad.</p>
<p>An mei quando audiam perpetua, sit id habemus apeirian laboramus. Nulla lucilius referrentur mei et, hinc justo appetere eam ut. Ut vis percipitur reformidans, ius vero postea et! Et mea vivendo scaevola, id mel vero definiebas, et pro posse sonet omnium. Est facer graece adversarium id!</p>
<p>Duis antiopam concludaturque et mel. Novum iudicabit consequat eu eam. Commodo inciderint sea at, lorem fuisset invidunt ut vis. An ocurreret contentiones quo, et per sale meliore voluptatum, decore bonorum ut eos? Partem verear adipisci cu sea, animal deseruisse sit no, suas nostrud efficiendi at quo.</p>
<p>Simul voluptatum dissentias eu eam. Summo scribentur ne nam, quo ne iudico voluptua, usu ullum delenit eu! Tollit fabellas usu in? Usu eu impedit albucius, ut vim noster suavitate.</p>
<p>Cum tantas copiosae definitionem no. Cu wisi atqui ignota mei, possit cotidieque no duo. Usu ubique neglegentur instructior ut, vivendo tractatos eu vix. Cu eum doctus comprehensam, pro in graecis suscipit? Sea in amet tamquam.</p>
<p>Meis possit alterum no pro. Ipsum prodesset has at, brute eligendi officiis mei no, ea unum noluisse praesent nec. Eum te saepe laudem officiis, aliquam ponderum incorrupte has ex? Phaedrum petentium ut his. Eu consul graeci aliquip mel, ius nostro maluisset repudiare ea. Mel et tractatos sadipscing. Modo fastidii scribentur pro te.</p>
<p>Meis falli dicam his et, quot dicat petentium est et, eos ne scripta dolorum! Pri at quodsi noluisse qualisque, at sea ornatus scaevola? Mollis ceteros splendide quo an? Errem doming vivendo eu vix, ius et utinam soleat, graeci doctus contentiones id pro. Vidit audire per in, nec facer debitis et.</p>
<p>Principes corrumpit nam et. Sumo dico dissentias mel id, timeam hendrerit voluptaria eos te? Vim ex dicam oratio gloriatur, tale fierent aliquando duo et, wisi appetere et usu? Animal detracto has no? Nec autem denique similique in?</p>',
                'tmp_content' => null,
                'featured_image_id' => '32',
                'read_time' => '60',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '25',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Mucius oporteat te vel!',
                'slug' => 'mucius-oporteat-te-vel',
                'summary' => 'Mucius oporteat te vel! Vitae lobortis scriptorem ius cu, eu usu diam tritani inimicus. Te usu dicta alienum conclusionemque, ei labores facilis scribentur usu. Eam ex nullam iisque quaestio, ex has quando nonumy aeterno?',
                'content' => '<p>Mucius oporteat te vel! Vitae lobortis scriptorem ius cu, eu usu diam tritani inimicus. Te usu dicta alienum conclusionemque, ei labores facilis scribentur usu. Eam ex nullam iisque quaestio, ex has quando nonumy aeterno?</p>
<p>Wisi bonorum et has, agam euismod usu no. Sea harum propriae ea! Dolore ignota id nam! Nec admodum propriae albucius no. At simul percipit per, an adhuc dolor propriae sit. Erat praesent consequuntur id est, ut partem docendi propriae cum! Duo id tation rationibus voluptatum!</p>
<p>Ut vim etiam homero mediocrem. Ei labore aperiri minimum pri, eu sit dico elitr, apeirian sadipscing theophrastus mei te. Sed cu eripuit eruditi vituperata, per eu option tamquam eligendi. No sed labore salutatus, integre bonorum definiebas ei vel, id sumo errem iisque duo? Pro at eirmod periculis referrentur?</p>
<p>Eu dolor dolore quaeque pro, te bonorum sensibus tractatos has, ei doming salutandi per! Sonet offendit epicurei an eam! In est similique abhorreant adipiscing, option consetetur in cum. Vix meliore dolores consectetuer id, alienum periculis no has, ea nusquam detraxit singulis vis!</p>
<p>Qui an mnesarchum consetetur appellantur? Ea vivendum volutpat consetetur usu, odio dicat hendrerit ius et? Per alterum platonem cu, eam errem mollis suavitate et. Eu cum tale sapientem philosophia? Antiopam perpetua complectitur ut vim, ut eam simul iuvaret molestie? Ex doctus legendos nam.</p>
<p>Cum cu odio gloriatur deseruisse, et vis insolens adipisci. Ei nulla meliore mea, cu augue convenire consequuntur duo. Ut ubique qualisque est, discere adolescens et mei! Veniam antiopam scribentur sea at, no eum virtute dissentias. Eu mel alia purto, ridens constituto contentiones est ex. Eu facete adversarium quo, ei recusabo oportere eam!</p>
<p>Ei usu molestiae scripserit disputationi, mea ei iuvaret oporteat scripserit, cu dolor ridens iriure vim. In solum iusto est, doming democritum interpretaris pri at. No usu simul eleifend accommodare. Vel rebum nihil no, sed ne graeci deserunt recusabo, harum exerci vituperata his ne! Elitr facilisis sed ei, vim quot probo populo no, vis tale iusto ne! Ancillae vivendum mediocritatem ad eum.</p>
<p>Qui ei iriure sanctus, assum sonet sit no, inani inimicus efficiantur an mel? Modus offendit qui ex. Soleat efficiantur te pri, probo quidam per no, at ius sale omittantur! Sed officiis perfecto id, cu inermis commune laboramus qui? Eos ex omnis adipiscing, sea no exerci aeterno?</p>
<p>Eos at liber docendi? Ei his civibus omnesque, possim virtute eos ea! Mei cu laudem graecis invenire, ei inimicus vituperata nec! Eu quas tritani pericula pro, et regione vulputate mea, latine facilisi quo ne. Solet offendit iudicabit vim at! Te regione constituam quo.</p>
<p>Nec adipiscing quaerendum et! Veniam nominati mei in, quidam apeirian invenire an qui, ei nec accusam urbanitas? Ad quo novum delicatissimi! Iriure petentium expetendis mea ei. Et mel diceret quaestio, his cu nihil torquatos reprehendunt. Ne nam quem impetus maiorum, nullam option eu pro.</p>',
                'tmp_content' => null,
                'featured_image_id' => '31',
                'read_time' => '64',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '26',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Omnium appetere voluptatum cu eam',
                'slug' => 'omnium-appetere-voluptatum-cu-eam',
                'summary' => 'Omnium appetere voluptatum cu eam, nonumy oporteat sed eu. Feugait perpetua ne ius, quo et accusam maluisset? Te duo verear aeterno labores, at quidam sensibus voluptatibus qui. Ignota volumus ea his?',
                'content' => '<p>Affert mucius eu mei, an ridens democritum mea? Mea autem aperiam suscipit ad, mazim senserit has te. Ludus propriae prodesset ad sea, et vis molestie repudiare dissentias. Vix congue suscipit disputando ea, ad tale definitiones nam. Possim alienum repudiare an his?</p>
<p>Omnium appetere voluptatum cu eam, nonumy oporteat sed eu. Feugait perpetua ne ius, quo et accusam maluisset? Te duo verear aeterno labores, at quidam sensibus voluptatibus qui. Ignota volumus ea his?</p>
<p>Has ne viris sapientem, per eius efficiendi eloquentiam at? Sed ad invenire erroribus, et usu quis explicari! In ius latine fabellas posidonium? Pri cu imperdiet hendrerit interpretaris, ne nec cetero propriae honestatis, assum abhorreant assueverit vel ex. At est pertinax volutpat, nihil mucius nostrum ut qui, vel possit complectitur ut! Nominati intellegat repudiandae ut vim, ex idque ridens voluptatum pri, ut iracundia consequat sed.</p>
<p>Prompta utroque invenire at ius. Te sit tibique torquatos intellegebat. Te cum vidit nominati. Ex nominati imperdiet temporibus vel.</p>
<p>Porro dicat in eos. In quodsi democritum nam. Pri choro feugait mandamus ex, dicunt eruditi te vim. Sea magna mollis alterum no, quo veritus admodum ea, quo hinc oratio tempor no. Pri in veri liber.</p>
<p>Ius cibo interpretaris cu, eu elitr suscipit ullamcorper sed? Eos reque gloriatur in, qui no liber gubergren incorrupte. Fugit adipisci patrioque ne nam, vis errem principes aliquando no. Ut qui populo integre conceptam, eros dissentiet ad sit. Ne pro wisi doming mediocritatem, quo te nemore urbanitas, an mundi eripuit vim. Error debitis ad eum.</p>
<p>Probatus constituto cum eu? Vim corpora delectus singulis et, ea eos meliore vivendo suavitate. Vocent regione qualisque eum in, te qui eros sadipscing eloquentiam, et utinam dissentias eos? Eu doming debitis sit, his omnis theophrastus ei! Eam ei solum postea referrentur, at lobortis erroribus eos!</p>
<p>At erant vocent repudiare vis, et nam doctus indoctum. Erat epicuri hendrerit vix ea, mea et ornatus insolens gubergren! Usu ipsum euismod no, te quod quot admodum his? Commodo constituam reformidans et duo, cum veri iusto ne? Ex inimicus reprehendunt cum.</p>
<p>Altera vivendo eu eam, id per possit numquam fabellas. Vix sale quaeque voluptua ne. Enim blandit quaestio cu sit, ei duo detracto omnesque? Nisl omnesque id usu, in soleat commune praesent cum, bonorum menandri dissentias cum ex. Pri ea case complectitur, te qui nullam appetere tractatos, id appetere maluisset pri?</p>
<p>Vim summo fabulas ea, vis cu placerat dissentiet! No fugit ullum duo, omnis vidisse malorum at usu, altera quodsi scribentur mei no. Te novum virtute consetetur quo! Ad mel graeco iriure, sea ex percipit inimicus? Ea habeo accusam usu! Patrioque repudiandae in has!</p>',
                'tmp_content' => null,
                'featured_image_id' => '30',
                'read_time' => '58',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '27',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Sea cu diam menandri fastidii',
                'slug' => 'sea-cu-diam-menandri-fastidii',
                'summary' => 'Pri ut tacimates imperdiet, altera honestatis has no, no aperiam facilis vel? Id quem adhuc oratio sit. Cu vim minim essent eripuit, delectus nominati per et? Malis tation eum ei.',
                'content' => '<p>Sea cu diam menandri, ea ius fastidii verterem salutandi. In pro probo evertitur scribentur? Quas probatus ad eam. Inani utamur sanctus ad qui. Liber utroque dissentiunt ex vis, elitr ignota mel te! Eum an populo volutpat? Latine voluptaria qui in, ea natum vocent vim, sint accusamus in eum.</p>
<p>Et eam aeque scripta erroribus. Facilis interpretaris mei te? Ut melius dolorum similique sed. At pri esse case! Usu vidit viderer inermis te, aliquam volutpat sadipscing cu his.</p>
<p>Tation vituperatoribus quo ei, eruditi sanctus assentior sit id, ex vel integre utroque pertinax. Ius id cetero menandri, ea sed viris iracundia definitiones! Duo sint doming oblique id, nec elitr sententiae no, vim natum salutandi repudiare ut. Postea fuisset propriae ut nec. His ullum copiosae ei, dicat patrioque usu ex, audiam alterum delicata per ei?</p>
<p>Essent audiam commune no his, ceteros consetetur cum no, noster similique cu eam? Ei quodsi malorum eum? Te eam tota minimum. Cu has nostro persecuti, eos dictas epicuri et. Solum percipit duo ne. Consetetur referrentur an mea, cu inermis officiis molestiae quo.</p>
<p>Diam delenit nec te, eam ea copiosae voluptatibus! An quo dicam consul, at movet errem duo. Vel summo iriure alterum te, pro posse regione commune ut. Et paulo convenire est. Cibo suscipiantur eum id.</p>
<p>At duo inani nominati, ius an labitur recteque urbanitas. Sit an paulo option vidisse. Agam sapientem an cum. Nam copiosae pericula in, per ex case persius prompta, eos ei ceteros dolores sadipscing. Summo delectus quaerendum ei pri, doming possim duo no? Nostro oporteat nam an, pri veri decore commune ei, mea discere oporteat cu?</p>
<p>Per ne wisi minim ponderum, no erat minimum inciderint eum! Ad mucius verear legimus per, doming eruditi petentium quo et. Cu regione epicuri indoctum vis? Mea an vocent luptatum disputando, ea deserunt praesent incorrupte vim. Ea aliquam convenire mea, ut pro brute mundi mandamus!</p>
<p>Molestie senserit delicatissimi cu nam, ne erant mnesarchum mea, ne pri eligendi perpetua! Simul lobortis contentiones eum cu, mei in suas error omnium? Id usu veniam graeci. Utroque adipiscing definitionem vix ei! Torquatos definitionem est an, causae malorum eloquentiam ut mea? Nam ad dicta eripuit referrentur, per in solet probatus convenire.</p>
<p>Vel an quaerendum instructior, mei ei amet civibus. Eu tota error iracundia pro, cetero aperiri est at. Oportere pertinacia ut eam! Nam ex modo postea omnium, in veritus phaedrum ius, eum nisl partem ut.</p>
<p>Pri ut tacimates imperdiet, altera honestatis has no, no aperiam facilis vel? Id quem adhuc oratio sit. Cu vim minim essent eripuit, delectus nominati per et? Malis tation eum ei.</p>',
                'tmp_content' => null,
                'featured_image_id' => '29',
                'read_time' => '57',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '28',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Deleniti scribentur mei nosingulis',
                'slug' => 'deleniti-scribentur-mei-nosingulis',
                'summary' => 'Inani fabulas iracundia ex eum! Assentior neglegentur at nam. Eos ne quem reprehendunt. Eos labore reprehendunt in. Atqui etiam euripidis et ius, melius antiopam an mei, no pri vidit doming torquatos. Verterem eleifend temporibus ut eum.',
                'content' => '<p>Deleniti scribentur mei no. Illum singulis ei pro, usu possit civibus reprimique ex. Autem rationibus te pri. In vix quas nemore corrumpit!</p>
<p>Eu tamquam prodesset disputando nam, delenit adipisci cotidieque ex duo, an deleniti reprehendunt vix! Congue assentior nec eu, sed ut quas vituperata necessitatibus! Ad aeque putant vix, per eu ornatus accusam. Duo accusata eleifend in. Nonumes fabellas hendrerit eu cum, quo feugait singulis eu. Quaestio reformidans eum ea. Sit blandit recusabo te.</p>
<p>Sea nulla democritum ea, ne sint laudem torquatos duo? Placerat accusamus referrentur sit te, eum no sanctus intellegat definitionem, pri eu ferri ullum conclusionemque! Ubique facilisi est ei, latine rationibus expetendis cu eos. Duo ad vocibus docendi civibus, qui in autem iracundia voluptatum, discere lobortis intellegat ut his. Decore debitis omittantur ne mei. Per ad erant audire voluptaria, nulla legendos mel ex?</p>
<p>Inani fabulas iracundia ex eum! Assentior neglegentur at nam. Eos ne quem reprehendunt. Eos labore reprehendunt in. Atqui etiam euripidis et ius, melius antiopam an mei, no pri vidit doming torquatos. Verterem eleifend temporibus ut eum.</p>
<p>Dolores sensibus efficiantur et nam. Nobis efficiendi an quo, eripuit qualisque prodesset an duo, ea mel oratio scripta? Inani omittam usu ei! No facer simul decore nec, latine feugait instructior vis id, mundi scriptorem vim ei. Purto ullum perpetua at eam, dolor vocent verterem vel in?</p>
<p>Nostrud sapientem expetenda quo at. Ne aeterno scribentur vix, novum docendi partiendo has ne? Quot etiam eligendi id vim, utamur quaestio eu sed! Simul libris volumus nam ad, nostro elaboraret definitiones quo no? Eu epicurei accommodare pro, in assum omnes vitae sed.</p>
<p>Mea volumus honestatis ad, dico debitis epicuri nec te, ubique discere vim no. Noluisse phaedrum atomorum mel at, an nam graeci feugait pertinax. Ut pro eirmod vidisse antiopam, has lorem malorum in? Te dolorem volumus mei?</p>
<p>No vix option laoreet constituam. Homero invenire partiendo has in, eam vero tamquam at, quot iriure ei sea? Adhuc antiopam nam ei, iisque regione probatus vim ne, qui vidisse facilisi et. Te enim assum expetenda his, has meis ignota dissentias et? Sit enim porro utroque ea?</p>
<p>An cibo malis mnesarchum mea, vim euismod suscipit euripidis ea, elit magna copiosae ad mei? Ex prima cetero oportere mei, eos at noluisse intellegam, id nec elit placerat antiopam? Duo an tacimates delicata definitiones, vis doming integre tibique at? Et doctus dissentias cum, tation dissentias no mea? Minimum recusabo ne nec, meis doming legimus an eos, ex tale melius per?</p>
<p>In essent reformidans sit, utinam postea cum ea, ad tota democritum vix. Amet solum sit no. Et cum tibique consetetur posidonium, ne eos quando postea graeci. An vim possim impetus forensibus, ius dico elitr fuisset ea! Etiam dolorum conceptam per no.</p>',
                'tmp_content' => null,
                'featured_image_id' => '28',
                'read_time' => '63',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '29',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Sumo graece quidam eapro ancillae',
                'slug' => 'sumo-graece-quidam-eapro-ancillae',
                'summary' => 'Mei an diceret lobortis. Cum doming molestie atomorum an. Ei usu audire convenire, viderer labores elaboraret nec ex. Cum nihil fabulas id, ei velit partem adversarium nec? Ei splendide posidonium assueverit mei, id eripuit accommodare quo?',
                'content' => '<p>Sumo graece quidam ea pro. Eam ancillae adolescens no, te falli repudiare persecuti nec. Modus principes eum at, ea civibus philosophia contentiones eum! Has in semper delenit assueverit, cu case ancillae mel? Te virtute facilisi ius. Ei sea atqui interpretaris, eum no accumsan volutpat, omnesque maluisset ius in.</p>
<p>Mei an diceret lobortis. Cum doming molestie atomorum an. Ei usu audire convenire, viderer labores elaboraret nec ex. Cum nihil fabulas id, ei velit partem adversarium nec? Ei splendide posidonium assueverit mei, id eripuit accommodare quo?</p>
<p>Modo deleniti recusabo an sea, eum ea pertinacia consequuntur. Eum option intellegat repudiandae ut. Has te erat iudicabit omittantur, nec magna omnis expetenda at. Consetetur omittantur et sea, sanctus intellegam vel ad. Eius saepe voluptaria mei ut!</p>
<p>Eu qui possit persequeris, ut mundi fierent est! Primis doming impetus ut cum? Mel minim salutandi expetendis cu. Liber dicunt adipisci no sit! Cum recusabo delicatissimi ne, id dolore utamur forensibus cum. Nonumes accumsan voluptaria in vel, quo eros gubergren disputando ex?</p>
<p>Qui assum delenit cu, sit legere offendit abhorreant ut. Pri veritus vivendo moderatius eu! Pri ei diam lorem alterum, mea et novum partem quaeque, graece propriae verterem eu est? Usu voluptua delicata id, his ut porro platonem theophrastus. Eu iudico semper vix?</p>
<p>Has quaeque nostrum offendit ad. No luptatum vituperatoribus his, corrumpit reformidans vix an. Pro ad consul accusam corpora, zril tempor ius id, ex vis stet scaevola suavitate. Eum ubique noluisse no. Primis mnesarchum elaboraret ius in, eos hinc errem moderatius an, ei sea reque electram!</p>
<p>Ea constituto consetetur eum, in quo mazim nullam. Est minim novum delicatissimi an, quaeque eligendi repudiare qui ei. Sed quas affert eloquentiam ea, vix at meliore accumsan interpretaris, mei vitae primis electram at. Hinc commune ius eu, an mei sumo movet probatus, id cum petentium percipitur repudiandae? Ex pro nisl falli evertitur, vel mazim veniam molestiae ad.</p>
<p>Ut veri novum essent usu, ad eum porro recteque, libris patrioque torquatos has id. Per iusto dicam ei, meliore lobortis te ius. Movet nonumy persius per ad! Mel dicat scripserit eu, quo no mazim essent vivendo. Nec voluptua liberavisse deterruisset ut, no saepe persecuti eloquentiam mea. In recusabo sensibus pro, cum ne tamquam sensibus. No meis quando animal his, nam ex minimum luptatum qualisque.</p>
<p>His nobis mediocritatem at, has ut enim scriptorem! Lobortis patrioque definiebas vim ea. Autem habemus dissentiet per in, autem nemore nec ad. Eum te alii erroribus, vidit debet facilisi et per. Electram qualisque pri ne.</p>
<p>At eros labitur oportere eam, odio omittam ex eos. Iusto regione nec id. Dicta nihil nam ei, nec an purto oratio mentitum. Cu pri fugit accumsan, no mea porro feugiat docendi. Qui suas impedit accusamus at, electram contentiones est eu.</p>',
                'tmp_content' => null,
                'featured_image_id' => '27',
                'read_time' => '61',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '30',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Nostro aliquid quite eruditi aliquando',
                'slug' => 'nostro-aliquid-quite-eruditi-aliquando',
                'summary' => 'Est illum tibique definitiones no, affert explicari neglegentur eu vim, vim nusquam recusabo at. Congue splendide ne mei, cum eu sale illum platonem. Cu cibo meis eos. Vim ei homero ancillae detracto, ad eos alia melius. Nec insolens salutatus honestatis an? Persius salutandi at eam, an eos incorrupte interesset.',
                'content' => '<p>Nostro aliquid qui te, eruditi aliquando ut mei! Putant accusata gubergren an mei, te qui virtute habemus definitionem? Sea no ceteros offendit maluisset, ut sonet ullamcorper eum, eu pro brute postea adversarium? Nullam commodo habemus mel ea, autem vidisse persequeris ut ius? Ut per malis facete, quo elit inciderint an?</p>
<p>Graecis corrumpit ut usu, cu vero docendi hendrerit nec. Ea per verterem suavitate eloquentiam? Eos decore pertinax petentium no, cum eros prima posidonium no. Lorem facilisis iudicabit cu usu, ea sed alia possit ornatus, dolorem convenire aliquando cum ut. Modo evertitur expetendis ut mei, in nam natum vitae nostro, no qui nostrud quaeque sanctus? Veri euripidis definitiones at ius.</p>
<p>Te sed feugait dignissim. Et quando antiopam consectetuer per, legendos sensibus mei ex. Et ius explicari voluptaria conclusionemque. Nec ut phaedrum molestiae referrentur, pro et veritus disputando. Et sit putent alienum, illum nobis pri ex.</p>
<p>Duo prompta veritus efficiantur id, quem nibh mea cu. Ex interpretaris conclusionemque eum. Vim doctus iriure constituto ne, te nostro facilis salutandi quo. Pro wisi solum facer ea. Ex alii nullam causae mei!</p>
<p>In usu ignota mandamus, nam quis scripta cu? Dicant ubique dolores his an, ne vide fugit ocurreret pri, eos cu suas impetus. Sed eu omnium albucius, eius deseruisse temporibus in mel. Movet sanctus singulis vis cu, pro an tacimates temporibus. Unum quando scaevola an sit. At perpetua salutandi gubergren duo, quodsi vocent signiferumque at sed!</p>
<p>Est illum tibique definitiones no, affert explicari neglegentur eu vim, vim nusquam recusabo at. Congue splendide ne mei, cum eu sale illum platonem. Cu cibo meis eos. Vim ei homero ancillae detracto, ad eos alia melius. Nec insolens salutatus honestatis an? Persius salutandi at eam, an eos incorrupte interesset.</p>
<p>Mel wisi vitae aliquid ei. No eam diam eirmod, qui equidem eligendi philosophia an. Ad duo solet iriure maiestatis, ex ipsum nostro iisque his? Vim phaedrum patrioque referrentur ad, id pri erat utamur postulant! Duo amet probatus democritum cu, option propriae prodesset eos et.</p>
<p>Solet petentium te vis, quo invidunt verterem torquatos id, no eam aeque nonumes menandri! Nibh dicat utamur vix eu. Cu sint natum habeo pri, ne mea mucius utamur discere. Munere disputationi in vel, porro dolor verear te mea.</p>
<p>Dicta graeco melius cum ei, nonumy concludaturque est ad. Cu nullam apeirian detraxit has. Atqui omnium disputationi ea mea, ex has nihil nostrud. Vel ne stet elitr adipisci, per at unum causae!</p>
<p>Vim verear sensibus no, te sonet maiorum has. Ex animal neglegentur usu. An iisque inimicus moderatius pro! At eloquentiam liberavisse necessitatibus quo, posse consulatu nec te. Praesent salutatus qui an, vis velit vulputate te.</p>',
                'tmp_content' => null,
                'featured_image_id' => '26',
                'read_time' => '60',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '31',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Prodesset expetendis ei eam',
                'slug' => 'prodesset-expetendis-ei-eam',
                'summary' => 'Prodesset expetendis ei eam, ea duo scripta tamquam urbanitas, utinam ponderum eum in. Exerci latine accumsan eu cum! Usu utroque veritus singulis ei, in debet elitr doming has, ad est erant petentium. Mel te tale oblique nominati! Placerat salutatus accommodare id pro.',
                'content' => '<p>Prodesset expetendis ei eam, ea duo scripta tamquam urbanitas, utinam ponderum eum in. Exerci latine accumsan eu cum! Usu utroque veritus singulis ei, in debet elitr doming has, ad est erant petentium. Mel te tale oblique nominati! Placerat salutatus accommodare id pro.</p>
<p>Nec populo quaerendum ad, et vel copiosae intellegat interesset? Elitr platonem sea ea, veri error eruditi an has. Ad eam stet voluptua iracundia, eu ius hinc causae postulant. Has paulo omnium accumsan an, has solet scripta percipitur ut, quo alii definitionem no. Quot errem quaeque mel ne, ne veniam sanctus scriptorem pri, mel ut perpetua recteque liberavisse. Eos minim erant audiam id.</p>
<p>Vel quis iusto placerat ei. Id menandri splendide eam, at eum hendrerit ullamcorper. Populo forensibus signiferumque pri ea? Usu cetero aeterno labitur te! Id errem qualisque democritum sea, pro harum tempor insolens an, fuisset incorrupte eam cu. Et probo ferri eum?</p>
<p>Sea ne tation iriure, nec purto omnes expetenda et. Esse prima his ne! Altera denique vis cu. Est alia sonet eu, has an alii aperiri.</p>
<p>Et aperiam malorum nostrud vis. Oratio elaboraret ut est, tamquam minimum in quo, eu minimum voluptatibus his! Quo ea diam graece audiam. Sed habemus deserunt te, eos meis eligendi ei. Per te etiam recusabo, sit dignissim laboramus contentiones et. Stet saepe posidonium pro ea, usu ut tincidunt deseruisse!</p>
<p>Ex delicata recteque salutatus nec, eu legere definiebas eum? Eu omnes numquam mei, nominati dignissim vis id, ipsum graeci eu eam! Qui ea nihil vivendum splendide! Populo doctus probatus cum te. Te placerat iracundia reformidans per, an tation appetere quo. Nec vide eius ad, elitr homero nominavi has an.</p>
<p>Paulo graece vidisse ad vim, ei mel iudico consul. Est nobis dicant in, his noster necessitatibus ne, tollit putant sea ut! Fierent voluptatum at eos. Nec vero quodsi an, qui ut debet probatus intellegebat, mei reque nonumy abhorreant at. No simul persius offendit eum?</p>
<p>An est modo velit interpretaris. Timeam aperiam sed ea, modo patrioque cum ex, has affert melius no. An eam tota tation ridens, qui corpora hendrerit ei. Ex has magna veritus reformidans.</p>
<p>Ex ludus bonorum mei. Duo ea cibo mazim decore, no aperiam maluisset pertinacia eam? At adipisci electram complectitur nam. Cum eu tempor doming convenire, eos id omnis graecis! Duis iusto expetenda quo no, nam ea scriptorem adversarium efficiantur, alii audire in per!</p>
<p>Semper recusabo an mea, reque vidisse invidunt pro ei? Doming docendi senserit an vel. Tempor vivendum efficiendi ut vix, vis erat etiam vivendum ea. Ne vel patrioque gloriatur neglegentur? Vidit assentior no eum, has eu quis tritani viderer! An sed sumo legimus alienum.</p>',
                'tmp_content' => null,
                'featured_image_id' => '25',
                'read_time' => '58',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '32',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Harum disputationi necessitatibus in sea',
                'slug' => 'harum-disputationi-necessitatibus-in-sea',
                'summary' => 'Harum disputationi necessitatibus in sea, eos ex persius argumentum. Est malorum delenit ne, usu id animal atomorum. Te duo dicta corpora torquatos? Liber fastidii quaerendum has ei, oporteat repudiare usu ex. Minim viderer cu vis, ex qui modus solet referrentur, ridens quaeque laoreet ut nam.',
                'content' => '<p>Omnis mediocritatem ad usu, eum animal eligendi senserit ea. Eligendi perpetua est id, ei affert aperiri aliquando eos. Idque graece feugiat cu per, eum facilisi legendos atomorum id, integre vulputate dissentiet mei ut? Id aeque indoctum eum, vel ad graece omittantur?</p>
<p>Facete reprimique necessitatibus ex eam? Phaedrum tractatos no nam, modo prima dissentiunt cum no? Sea et facer facilisi, in legere deterruisset vix, oratio legere disputando vis in. No exerci laudem mel, eu his summo nostrud facilisi. Vis dico diceret voluptaria an, vulputate dissentiunt mei an.</p>
<p>At per partiendo instructior, et vix officiis luptatum assueverit. Falli forensibus efficiantur vim ne, has explicari instructior in! Eam at partem efficiantur, ignota vituperata et vis, recusabo suavitate euripidis cu duo! Salutandi tincidunt usu id, mel ad justo praesent. Eu his diam tation consequat? Eu meis voluptatum his, id vim adipisci definiebas.</p>
<p>Numquam fabulas eu nam! Vivendum efficiantur est an, cu ludus sententiae mei. Enim brute at nec, ius illud veritus in. Quo consul dissentiet at, pro quidam tamquam virtute ut, eam natum liber nusquam ex. Idque fugit iisque ad has!</p>
<p>Ex vis error bonorum liberavisse. Nominati intellegam assueverit vim ea. Fabellas senserit repudiare ea his, ex nulla verear equidem sed? Brute nonumes gubergren te mel, qui reque dictas nusquam in. Omnium consequuntur nam no, pri quot argumentum disputando ut, eu graece nominavi ponderum nam?</p>
<p>Per at quem facilisis moderatius, nec eu molestie luptatum. Atqui labore persecuti pri no, nec pertinax scribentur ex. Ex saepe aperiam legendos sit! Eum eu elitr impetus impedit! Ei iudico decore vel, quo libris legimus conceptam eu, ut pro aliquip moderatius.</p>
<p>Ea mundi volumus alienum vel. Porro maiorum probatus sit id, errem iriure option eu sea. Mel no natum accusata. Cu solum concludaturque sea, sit et sint adhuc congue! Vel congue volutpat ad, sed ad vide indoctum corrumpit?</p>
<p>Id his justo aeterno epicurei, dicam reformidans delicatissimi nam ea. Probo tollit hendrerit ex est, per unum legere ea. Justo elaboraret intellegebat ei eos, pro tation doctus in. Mutat nonumes pro ut! Te epicurei liberavisse suscipiantur eam.</p>
<p>Sit et gubergren cotidieque! Ea his aperiri delicata complectitur. An mundi nobis sensibus per, legimus principes intellegebat id vel, an quo quod labore voluptaria. Accumsan laboramus sadipscing quo ea. Lobortis invenire an sea!</p>
<p>Harum disputationi necessitatibus in sea, eos ex persius argumentum. Est malorum delenit ne, usu id animal atomorum. Te duo dicta corpora torquatos? Liber fastidii quaerendum has ei, oporteat repudiare usu ex. Minim viderer cu vis, ex qui modus solet referrentur, ridens quaeque laoreet ut nam.</p>',
                'tmp_content' => null,
                'featured_image_id' => '24',
                'read_time' => '57',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '33',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Dictas eruditi theophrastus at duoex',
                'slug' => 'dictas-eruditi-theophrastus-at-duoex',
                'summary' => 'Cu doctus ocurreret hendrerit vix. Duo ubique maluisset mnesarchum eu. Fugit principes at sit, ea dolore tritani ponderum est, nisl ridens utamur ei eum. Ut iuvaret petentium intellegat vis, prodesset referrentur concludaturque eam in, iudico reprehendunt vis et! Id zril exerci alienum mea, id lorem verear tibique eos?',
                'content' => '<p>Nominavi deterruisset cum at, te pri odio placerat, consequat constituam reprehendunt duo ad! Vidisse vituperatoribus ne vel. Graeci blandit pericula ne eos, sumo erat ut ius. Quod libris aliquip in pri, qui deseruisse reformidans et, et numquam accommodare sed.</p>
<p>Ad mea solum docendi deleniti, eos ad denique reprehendunt. Eum ex tritani delenit. Vis quas putant ex, has at option bonorum appareat! Clita legere sapientem mel et, in nostrud habemus appetere sit! Ridens admodum persequeris ea mea, ius ad nisl ignota platonem!</p>
<p>At sed tantas civibus, iracundia instructior ea vix. In tamquam diceret efficiendi sit! Vero habeo graeci in cum, te vel propriae percipit sententiae, est perpetua adversarium an. Vim et quidam mandamus adolescens, in epicuri conceptam definitiones sed.</p>
<p>His ut sonet persecuti, reprimique consequuntur mea ne? Ex possim persecuti honestatis eum, no pri novum option rationibus, erat velit te mei? Dicam omittantur no pri, nec ea brute homero doctus. Ea nam enim facer petentium, movet ludus no est, tale falli dolor ei per. Cu has dico diceret dignissim, ne invenire mandamus duo, has persius laoreet voluptatum id.</p>
<p>Cu doctus ocurreret hendrerit vix. Duo ubique maluisset mnesarchum eu. Fugit principes at sit, ea dolore tritani ponderum est, nisl ridens utamur ei eum. Ut iuvaret petentium intellegat vis, prodesset referrentur concludaturque eam in, iudico reprehendunt vis et! Id zril exerci alienum mea, id lorem verear tibique eos?</p>
<p>Oblique discere ne sit, diceret conceptam cu vis? Iisque signiferumque ea ius, eu adolescens referrentur pri, has an velit delicatissimi! Cibo eruditi vel ne, mel te electram prodesset. Ei suas laudem voluptaria qui. An duo volumus moderatius!</p>
<p>Luptatum iudicabit et pro, cu sea dico maiorum appetere! Sit nulla gloriatur ex, ad maiestatis repudiandae quo. In vis autem posse. Ex per mutat interpretaris, ne pri persequeris comprehensam! No sint concludaturque sit.</p>
<p>Unum justo intellegat quo ad, ius cu etiam appetere. At dolore impedit vituperata vis? Essent forensibus temporibus in est, aliquam vocibus ut nam. Labore persius delenit qui ex, an nec vocent invidunt.</p>
<p>Has laudem feugait eligendi an, nostrum prodesset eu sed. Nec impedit fastidii offendit cu, id est ipsum regione. Labores lobortis ius te! Partiendo petentium ius no, eos eu nobis persequeris neglegentur. Nam denique vituperatoribus ei. Duo te commodo referrentur!</p>
<p>Dictas eruditi theophrastus at duo, ex exerci persius has. Idque praesent qui et. Ea cum mutat labores gloriatur, ex cum case saepe nonumes. Appareat concludaturque cu est, ius omittam elaboraret at, ea laudem consulatu has.</p>',
                'tmp_content' => null,
                'featured_image_id' => '23',
                'read_time' => '56',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '34',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Erat prima pertinacia at pro rebum',
                'slug' => 'erat-prima-pertinacia-at-pro-rebum',
                'summary' => 'Erat prima pertinacia at pro, rebum quaeque ancillae cu cum. An usu summo congue, ne virtute eloquentiam sea, modus scriptorem disputando cu mel. Ornatus philosophia et sit. Ex his ipsum dolore quaeque. Cibo dolor id cum, est eu saepe soleat. Vim augue admodum eleifend ad?',
                'content' => '<p>Te quaeque civibus ocurreret nec, at nec debet laudem. Id omittam omittantur per. Cibo menandri te nam! Ius saepe persequeris ea. Ex his atqui mundi feugait, atqui facer patrioque pro id, ex vel vitae facete!</p>
<p>Wisi falli impetus et sit, ea quo dicit iriure, natum minim accusam vis ex. Legendos deterruisset id his, porro homero evertitur vel an, et eam minim possit fierent! Ei quo quas option ceteros, has audiam petentium sententiae at. In ius sumo summo intellegebat! Vel an clita altera, sit eius quaestio ei. Ne eum soluta alienum. In ipsum sententiae vituperatoribus vis, purto altera honestatis no sed.</p>
<p>Qui vidit senserit torquatos ne, ius ex integre sententiae. Ad his nonumy noster, ei nonumy persius eos! In putent impetus facilisi vix, te quem reque option nam. Ea pri utamur alterum appareat, mel no mazim eirmod eleifend. His vero graeco laoreet ut, ignota iudicabit cum in. Utamur phaedrum mei te, aliquid disputationi ea has, decore ancillae neglegentur sed in. Ex duo dictas sententiae!</p>
<p>At vim delectus repudiare dissentiet? Iisque recusabo at pro, sit eu regione malorum? Ea eum nobis tempor labitur, per brute molestiae constituto at. Iudico libris omnium ei duo, sit in graecis legendos.</p>
<p>Denique consulatu posidonium te eum, esse harum timeam duo at. Mei ut equidem volutpat interpretaris, vis verterem recteque iracundia ad? Noster quaeque eloquentiam duo et. No dicant mucius accusamus mea. Id eum soluta pericula!</p>
<p>An vim graeci causae, duis aeque feugait vel id. Eirmod noluisse necessitatibus ei nam, has cu erroribus deseruisse vituperatoribus, cum tation partem possit an. Atomorum senserit rationibus ei vis, lobortis voluptatum ad ius. Vis bonorum cotidieque suscipiantur eu, agam libris suscipiantur ut pro. Vis audire dolorum inimicus ut, vidit necessitatibus vis an. Choro timeam iuvaret sed no, ius id modo offendit!</p>
<p>An ridens conceptam sit! Convenire gloriatur vituperatoribus ut usu, his an cibo prompta concludaturque. Id mel modo utinam consectetuer, mei soluta gubergren ex. Tale laoreet an his, habemus minimum eam cu? No semper partiendo persequeris sea?</p>
<p>Vide ornatus suscipit ad nec, eum facer erant voluptatum ex, pro et liber populo. Cum tale viris quidam in, in choro qualisque cum! Has ut modo fierent delicatissimi, dico aperiam at vis. Sea quas ornatus epicurei id, quaestio prodesset vel et, ut ferri appareat ius! Mea cu cibo porro, qui ipsum senserit interpretaris ne, cu tota vidisse vim. Te viderer dissentiet usu?</p>
<p>Cetero delectus eloquentiam nec an, est ne equidem veritus, falli quando cum an. Delenit lobortis pertinacia nam et, eam id inani insolens, nonumes definitionem cu usu. Ea suas illum scripta vel. Oratio perfecto his ex, omnis causae docendi ei sed, ei impedit adolescens efficiantur nec.</p>
<p>Erat prima pertinacia at pro, rebum quaeque ancillae cu cum. An usu summo congue, ne virtute eloquentiam sea, modus scriptorem disputando cu mel. Ornatus philosophia et sit. Ex his ipsum dolore quaeque. Cibo dolor id cum, est eu saepe soleat. Vim augue admodum eleifend ad?</p>',
                'tmp_content' => null,
                'featured_image_id' => '43',
                'read_time' => '66',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '35',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Duo no prodesset honestatis latine epicuri',
                'slug' => 'duo-no-prodesset-honestatis-latine-epicuri',
                'summary' => 'An liber possim perfecto mel, tantas percipit mel no! Ut posse solet interpretaris vis, ei eos expetenda pertinacia signiferumque. Vix ex soluta libris sententiae! Duo no prodesset honestatis! Ne latine epicuri eum, mel ex minim appareat assueverit, in mea putent albucius.',
                'content' => '<p>Sint veniam pro no, latine adipisci ullamcorper in mei! Ex labore copiosae rationibus eam. Eripuit pericula torquatos ex vis, duo eu menandri iudicabit! Ea eos diceret delicata, docendi noluisse deserunt cu sed.</p>
<p>Albucius abhorreant mei id, duo option nostrud in. Vivendum vituperata pri et! Sit civibus signiferumque no, vel invidunt repudiandae cu. Has ad purto rationibus, ne duis indoctum postulant cum. Cum saepe impedit et. Vel an nihil omittantur, facer copiosae in duo.</p>
<p>Ut nec congue hendrerit pertinacia, ne numquam sententiae appellantur has! Cu minim iuvaret evertitur vix, eum ei oratio tacimates quaerendum! Iisque sapientem consequat eu eum? Admodum docendi nostrum cum et, ne liber scripta ceteros duo. Magna percipitur eu cum, his rebum solet platonem ad. Alia lobortis eloquentiam mea ut. Ut est prima aeterno bonorum, an elit oporteat sit?</p>
<p>Ne sed possit sententiae voluptatum, option persius ad vel, vero omittantur accommodare cu sed! Vis te postulant forensibus voluptaria. In qui impetus equidem vulputate, veri aliquam quo id, numquam vivendum liberavisse sit ea? Has minimum expetendis et, delectus forensibus cotidieque vix ne, vel no sale appareat facilisis. Eam maiorum vivendo antiopam no, graecis conclusionemque mei ad.</p>
<p>Ex dictas volutpat neglegentur sed, ubique aeterno splendide ut sit. Duis everti vis id, erant meliore propriae ei sed, ridens sensibus suavitate sea an! In quod mediocrem patrioque mea, suas noluisse tractatos qui ex. Inimicus intellegat quo in, vel ei zril vitae! At cum dico docendi. Cu sea nulla habemus, ad labitur tacimates constituto pri.</p>
<p>An liber possim perfecto mel, tantas percipit mel no! Ut posse solet interpretaris vis, ei eos expetenda pertinacia signiferumque. Vix ex soluta libris sententiae! Duo no prodesset honestatis! Ne latine epicuri eum, mel ex minim appareat assueverit, in mea putent albucius.</p>
<p>Mucius feugait petentium mea ut, ius graeci eloquentiam consequuntur an! Per cu nonumy quaerendum, iusto ignota quaestio per no. Perfecto singulis corrumpit et has, vim oratio verterem eu. Aperiam reprimique ne sit!</p>
<p>Eum augue altera ut, in brute dicant repudiandae qui, graeci everti lucilius te per! Vix quaeque laoreet id, praesent constituto mea ea! His albucius pertinax repudiare et. Nostro signiferumque an has. Est id vidit argumentum, per vocibus posidonium at, sumo dicta ut eos.</p>
<p>Everti principes inciderint eu eum, per fastidii delectus ut! Cu pro enim elit? Duo phaedrum principes at, harum doming aperiri mel in! Facer oratio cum ex.</p>
<p>Quo suas ridens an, in vel facete fabellas, cu modus consul dignissim eam! Sed populo denique ei, ad duo tantas interesset, diam noluisse id vim. No eum tation mediocritatem, qui an tibique tincidunt. Est voluptua consetetur in, eos ad possit equidem, vel te probo democritum. Legimus tractatos et nam! Summo epicurei sit ut, cu mel nibh iusto tation! Eu quaeque adipisci sed, ei eius inermis deterruisset eum.</p>',
                'tmp_content' => null,
                'featured_image_id' => '34',
                'read_time' => '61',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '36',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Saepe ignota delicata ne eos',
                'slug' => 'saepe-ignota-delicata-ne-eos',
                'summary' => 'Ut vix veniam delectus consequuntur. Mel appareat percipit eu, ius dicta atomorum ut? At mei aliquam electram. Vis semper interpretaris et, altera nominati vis ne! His alterum democritum ea, alienum minimum sapientem an duo, sea ad quem mediocritatem. Per cu ullum reformidans.',
                'content' => '<p>Mundi doming assueverit at mel, nulla tincidunt an vis. Per no consetetur definiebas? Et mei solet inciderint, est eu alia disputando. Duis etiam alterum ea qui, altera democritum elaboraret sea in.</p>
<p>Ut vix veniam delectus consequuntur. Mel appareat percipit eu, ius dicta atomorum ut? At mei aliquam electram. Vis semper interpretaris et, altera nominati vis ne! His alterum democritum ea, alienum minimum sapientem an duo, sea ad quem mediocritatem. Per cu ullum reformidans.</p>
<p>Sea nulla accusamus at, his ei nisl delenit, ex admodum volumus nec? Vim at movet nominavi copiosae, sonet accusata an ius. Eu agam ferri sea, nam accusata persecuti an, hinc propriae ei vis. His dico aperiri detraxit ei, probo apeirian sit in, no nisl ludus aperiam his? In quod erant vix, viderer minimum cu est, doming nusquam constituam an vel. Quando essent intellegam mel ne.</p>
<p>Has at harum zril mollis, ne dictas doctus cum, eu sea utroque scribentur! Mel ea congue alterum mediocrem. Nam facer epicuri ad. Et debet interpretaris vel.</p>
<p>Sea cu graecis periculis, qui legere detraxit suavitate et? Vidit nominati no eos? Mei tota pertinacia cu, eu sanctus deleniti invidunt nec? Wisi honestatis id mel, vis et voluptaria intellegam consectetuer? Ei eos nisl falli nostrum, an copiosae torquatos ius.</p>
<p>Eam omittam antiopam recteque ad, unum efficiantur et eos. Perpetua abhorreant elaboraret ea eam. Ei labitur meliore persecuti mea, sed at duis persequeris, qui deleniti voluptatibus eu? Semper torquatos cotidieque usu ea, ut errem nonumy cum, te his meliore recteque voluptaria! Dicit quaeque tincidunt cu vis, id eos mutat complectitur!</p>
<p>Saepe ignota delicata ne eos. Ius cu autem mentitum, vide praesent cu est. Eam ne labitur luptatum. Vidit quando nonumy et vix, velit suscipit te sea, usu ad probo possit dictas. Ut odio tibique menandri sit, an has inani cotidieque reprehendunt? Vidisse vocibus quo ex. Ex sit quaestio repudiare, ullum virtute imperdiet nam ut.</p>
<p>Et mel populo accusam detraxit. Idque imperdiet an usu. Bonorum scripserit ne mei, ferri vivendum et quo, te civibus abhorreant his? Ea mucius sapientem per, inani doming democritum per ad. Ne illum torquatos incorrupte sit! Eam tota falli ex, eos no case audiam delicatissimi, sea accusam verterem prodesset ex.</p>
<p>Tacimates perpetua sed et, id quod inermis theophrastus cum. Ius everti qualisque te? Ne his aperiam moderatius. Impedit phaedrum deseruisse eos ea?</p>
<p>Ius movet perfecto salutandi an, an pri fuisset gubergren! Harum patrioque ei pro. Dicant putent ius ei. Sea at rebum cetero, legere mollis oportere est no. Id eum dico graeco, et mea odio numquam maiorum, eos percipit qualisque an.</p>',
                'tmp_content' => null,
                'featured_image_id' => '42',
                'read_time' => '58',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '37',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Impedit accusata qualisque ad mel',
                'slug' => 'impedit-accusata-qualisque-ad-mel',
                'summary' => 'Vis ad indoctum scriptorem, et has diam elit summo? Saperet euripidis theophrastus et vix, an tale contentiones vel, sit duis elitr veritus et? Vis ipsum nemore id, at tantas aliquid ius, te quidam pericula qualisque sit. His case deleniti honestatis no?',
                'content' => '<p>No omnis dolorum qualisque has. Usu diceret voluptatibus ei, oratio consetetur mea ut. Eligendi detraxit constituto in vix. Sea ei debitis accumsan antiopam, no noster intellegat abhorreant eum. Audiam laboramus usu at, nec te diam atomorum.</p>
<p>Est dicta tempor delicata at. Eu pro etiam noster aliquam? Veniam volutpat assueverit eos ei. Sit nominavi partiendo no, in per noluisse platonem tincidunt! Fugit constituam honestatis cum ut, cu putent eripuit vis, eam nibh soleat adolescens ei?</p>
<p>Quo movet deserunt voluptatum ei. Eu vim laudem vidisse, at labitur tractatos gubergren mea! Soluta laoreet nominati cu vis, eu quo dicunt omittam? At quo elitr denique referrentur, sonet vitae option qui et? Stet quaestio duo ea, malorum iuvaret ea sed.</p>
<p>Eum putent definitionem ei, eam ea ipsum dicunt convenire. Eros reformidans qui ne, quo an falli platonem torquatos! Pri comprehensam delicatissimi ea, modo idque ocurreret no mea. Te ius graeci constituto, id noluisse pertinacia has. Ut eius delicata vis, nam molestie consulatu ea. At fugit vitae fabellas vis? Sea aeque copiosae id, eos diceret delectus et.</p>
<p>At meliore percipit vix, quo ea fastidii verterem sensibus! At ferri eleifend conclusionemque eam. Fierent eligendi posidonium ne sea. Quo et impetus assueverit!</p>
<p>Te sit nullam omittam adipisci. Nec et esse populo definitionem, ius ad virtute facilis argumentum! An possim inimicus mel! Eum viris nemore suscipiantur at, dicat solet mandamus ut has, vel noster mediocritatem te? In pri eros utamur mediocrem. Stet erant his ad, sea invidunt phaedrum adipiscing cu?</p>
<p>Sea sumo ancillae vituperata ut, tempor impedit per in, ei pro ornatus molestiae! Nemore dicunt ius at, ei quo laudem oblique intellegat. Has ut latine rationibus temporibus? Ut his lucilius adolescens!</p>
<p>Vis ad indoctum scriptorem, et has diam elit summo? Saperet euripidis theophrastus et vix, an tale contentiones vel, sit duis elitr veritus et? Vis ipsum nemore id, at tantas aliquid ius, te quidam pericula qualisque sit. His case deleniti honestatis no?</p>
<p>Impedit accusata qualisque ad mel, ad case minim vim, at vix melius cetero nostrum. Eam errem ubique melius ut, his ne legendos invenire! Vis in facilisi convenire dissentias! Has viris probatus assueverit ei, eam latine malorum ad, quo in amet possim tritani. Alia latine voluptaria mel et, utamur viderer iuvaret an nam.</p>
<p>Pro eros novum inimicus ei, verear ponderum vix at. Assum complectitur ne per, facilis perfecto expetenda an quo. Graeci melius cu his, eu eum natum expetenda. Dissentias contentiones vis eu.</p>',
                'tmp_content' => null,
                'featured_image_id' => '41',
                'read_time' => '54',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '38',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Quot perpetua intellegam mel exchoro',
                'slug' => 'quot-perpetua-intellegam-mel-exchoro',
                'summary' => 'Quot perpetua intellegam mel ex, ad phaedrum antiopam delicata ius. Falli choro his an! Ei qui insolens temporibus theophrastus, alia duis te nec. Odio feugait te vix, ut eam eros perfecto moderatius. Reque vulputate cotidieque et eum! Modus posse sententiae eam ut, in his nostrud petentium. Velit denique ei vel, stet labores lucilius eu nec.',
                'content' => '<p>Mel et dictas prompta. Vim semper suavitate efficiendi te, id maiorum nominati antiopam mei. No usu saperet scaevola, has ei alii deserunt, aperiam imperdiet ei qui. An omnes urbanitas nec, ludus mollis nostrud pri at, quo nihil lobortis repudiandae ea. Eam nobis quodsi ei, id clita tation conclusionemque qui! Et per putant senserit, his ad fabulas inermis, semper voluptaria ad est. Ea eius admodum adversarium vel, et pri case vivendum, eum ut expetenda qualisque.</p>
<p>Elitr utinam disputationi ea mel. Eros suavitate at qui, ex pri dicam gubergren percipitur. Bonorum constituam et sea, qui et graece perpetua. Ea cibo simul usu. Id dolorum repudiare usu, qui viris hendrerit constituto no. Ex consul partem mediocrem vix, summo nihil imperdiet at nam.</p>
<p>In his putant oporteat. Ne unum utroque reformidans sea, sea ut dolores philosophia, eu aeterno splendide quaerendum mea. Pri natum graeco neglegentur eu! Pro eu omnis choro, has cu nullam nostro! No sit etiam debet vitae, his quot soleat sadipscing ei. Dictas alterum an mea, te feugiat epicuri quo.</p>
<p>Eu est sumo adhuc inani, quodsi nominavi conclusionemque ei vis? In his impetus eligendi scaevola, velit feugiat definiebas cu ius. Ludus detraxit pri ea, sit recusabo deterruisset ei! Pri paulo quaestio ut, homero liberavisse usu ei, ut sea iusto diceret vulputate. Nam ex timeam consetetur, primis quaestio elaboraret ad cum. Vim magna definitionem ne, his probo everti eu, has an omnes persequeris deterruisset!</p>
<p>Graecis insolens eu mel! Ea his alterum pertinacia abhorreant. Idque omnesque instructior ius eu, vel ea viderer molestie. Vim eirmod erroribus consequuntur ne, duo impedit tacimates persecuti ei. Sit tempor minimum recteque cu, percipitur consectetuer ex usu.</p>
<p>Cu pri iriure mediocritatem, in sea modus saepe liberavisse! Vim putant everti iuvaret no, eos iriure deterruisset te? Eos latine fierent suscipiantur an? Legimus nominavi imperdiet ea sit, mei dolorem consequat aliquando in! Purto ubique everti te vim?</p>
<p>Impetus nonumes molestiae ne cum, ei appellantur repudiandae has! Ut vix populo officiis, et vis docendi accusata. Cu nec stet nulla, per omnes ignota in. Eum nullam libris possim at, etiam perfecto eu mea. Fugit ridens ut sea, ut mea eligendi disputationi, mel minimum facilisi phaedrum an. Ne veniam constituam nec, quem posse tacimates no mel, aperiri maiorum accusam usu ea.</p>
<p>Vis fastidii suscipit accusata id, debet simul vulputate his ad? Maluisset complectitur eos ei, dicunt senserit pro eu. Ut possim nusquam constituam vim? Mel vidisse nostrum patrioque te, dolores persecuti ex ius? Pertinax facilisis laboramus pri an.</p>
<p>Quot perpetua intellegam mel ex, ad phaedrum antiopam delicata ius. Falli choro his an! Ei qui insolens temporibus theophrastus, alia duis te nec. Odio feugait te vix, ut eam eros perfecto moderatius. Reque vulputate cotidieque et eum! Modus posse sententiae eam ut, in his nostrud petentium. Velit denique ei vel, stet labores lucilius eu nec.</p>
<p>Detracto forensibus vix id, eum ut molestie legendos hendrerit. Te qui epicuri intellegam omittantur, sed ad solum nemore option. Omnes scaevola honestatis ei vel, liber convenire complectitur ea mea! Mel dicta nonumy minimum ne. Eu natum delectus eum, ut vis omnis simul evertitur.</p>',
                'tmp_content' => null,
                'featured_image_id' => '6',
                'read_time' => '69',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '39',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Corpora postulant cu has nibh mutat',
                'slug' => 'corpora-postulant-cu-has-nibh-mutat',
                'summary' => 'Corpora postulant cu has? Nibh debet definitionem sea no. Et mea eius latine imperdiet, pri eu commodo vulputate. Quo te malis noster laoreet, cum suavitate vituperata ei! In mutat invidunt periculis nec? Reque justo conceptam eam ut?',
                'content' => '<p>Corpora postulant cu has? Nibh debet definitionem sea no. Et mea eius latine imperdiet, pri eu commodo vulputate. Quo te malis noster laoreet, cum suavitate vituperata ei! In mutat invidunt periculis nec? Reque justo conceptam eam ut?</p>
<p>Mei option iracundia ex! Dicam dolorem mei in! Ei pro harum dicit scriptorem, et est ipsum expetendis. Te discere deserunt qualisque sit. Ex nam omnes dolorem feugait! Cum ea conceptam rationibus?</p>
<p>Pri putent copiosae at, ut quo eripuit definitionem. Quas euismod eum ex, pro saperet impedit detracto at, et eum persius patrioque. Ius dicit ullamcorper ad? Cu diceret instructior nec, illud salutatus quo ei, ex ius postulant cotidieque reformidans?</p>
<p>Ex sed nobis quidam reformidans, ex maiestatis signiferumque mediocritatem eam, quo at natum reque laboramus. Vis ne iisque laoreet perfecto, duo erant reformidans at. Sed ne diceret perpetua, ut melius minimum molestiae eum? Elitr oblique duo cu, cu usu causae senserit efficiantur?</p>
<p>Sea eu enim vidit mediocrem. Habeo simul electram vis ut, quo cu dicat maiorum indoctum. Fierent salutandi per ea, nibh persius voluptaria sit id, eum justo clita persius et. Est id graece interpretaris. Et sea ubique animal, eu omnes insolens eos? Eum eu mandamus quaerendum suscipiantur. Ne elitr rationibus his, per et nibh quas persius.</p>
<p>At ius quodsi repudiare eloquentiam, brute cetero quo te! Platonem molestiae cu eum? Eu esse hendrerit deseruisse usu, has habeo intellegat percipitur ne. Alienum albucius mediocrem mei an, vero habeo aliquando in sed! Quo audiam oportere ei.</p>
<p>Fastidii suavitate conclusionemque ne nam, cu persius electram eloquentiam pro, ad per movet veniam appareat. Ei senserit appellantur delicatissimi cum. Causae virtute ei quo, prompta fabellas pri eu, et option pertinacia vix? Vis ex noster nonumes consulatu, ea elitr qualisque vix. Et vis tation electram moderatius, est ad commodo salutatus conceptam!</p>
<p>Tibique incorrupte interesset vix eu, ea etiam labores nam. Nec et zril disputationi! Affert interesset omittantur ne usu, facer dolore consul in has, qui inani nulla copiosae ea. Sit maiorum expetenda similique ea, posse simul ullamcorper at eam? At legendos philosophia conclusionemque nam, elitr consetetur ad mei, molestie indoctum qui cu.</p>
<p>Cum eu labore liberavisse? Usu eu congue epicuri maiestatis, ei pri nisl wisi iudicabit, semper consequat ad sit. Eam id semper aliquid detraxit, ei facer mundi iudicabit mea. Duo error ludus consequuntur ea, in summo oratio recteque eam, eam no nemore timeam? Vim impetus explicari referrentur in, et pro exerci expetendis.</p>
<p>Putent oblique fierent ne vim, pro agam elit soleat cu. Mundi gubergren ei eum, solum decore complectitur ei sed. Eam quas oratio nusquam ex! Viris viderer usu ut! Ea pri liber lucilius, cu errem atomorum repudiandae usu.</p>',
                'tmp_content' => null,
                'featured_image_id' => '5',
                'read_time' => '59',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '40',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Facer ridens conceptam cum ea',
                'slug' => 'facer-ridens-conceptam-cum-ea',
                'summary' => 'Facer ridens conceptam cum ea, per no definiebas deterruisset consectetuer, ex duo exerci dolore partem. Vis soluta percipitur eu, vix inermis posidonium te. Assum corpora et mel, an nam justo detraxit consequuntur, et sit regione evertitur. His tollit nemore gubergren te, pri ei nonumy ceteros salutatus.',
                'content' => '<p>Rebum tantas mel at, has ei commune tractatos dissentiunt. Aperiri scripserit id mel, mel mundi quidam eu! Mel ea consul hendrerit, harum vivendum lobortis vis id. In sed hinc veniam ridens? Vel ad mundi contentiones, et quot feugiat honestatis eum, sed autem delectus ocurreret ne. In sed laoreet recteque disputando, qui nullam commune ex.</p>
<p>Commodo utroque consequat sed ei, his ea constituto argumentum eloquentiam. Cu essent audiam antiopam sit, ad pro stet consulatu, has et convenire salutandi! Has at quis hinc comprehensam, et vero choro denique sed! Purto aliquip definiebas eam ei, cu offendit mediocrem philosophia pri. Mea ex tantas soluta, illum euismod necessitatibus id sed! Ne qui paulo voluptua apeirian. Ex elit tota duo.</p>
<p>Lorem gloriatur nec ad. Ad his mutat posse. Vix no eius deserunt recusabo, mea id veniam electram dissentiunt. Velit vidisse ex eum, vix suscipit mandamus an, ne minim equidem saperet est! Semper dolorum has in, cu prompta intellegam theophrastus quo, eos atqui viris ea!</p>
<p>In iudico concludaturque usu, cum cu recteque salutandi consectetuer. Minimum epicurei evertitur ex qui? Vis facer consetetur at, nec tale consectetuer ne, altera persius ne sit. Doming audire an nec, probo ancillae consetetur ex mei? Est te elitr impedit. Cu vel stet modus, falli convenire signiferumque quo ne. Qui liber apeirian ex.</p>
<p>Eu nec posse dicant discere, alterum consequuntur at usu. Nemore civibus vel no, eligendi intellegebat consectetuer ne mei. Qui ad timeam theophrastus vituperatoribus, mel populo debitis ea. Invidunt intellegebat duo no.</p>
<p>At usu iisque impetus mnesarchum. Mei ex everti alterum mediocritatem. Usu labores percipit ei? Tamquam accusata concludaturque his at. Utroque mandamus mei ut, pro soleat consequuntur no.</p>
<p>Nam ullum tollit necessitatibus ei, cu qui hinc velit honestatis? Solet soleat quodsi vix ne, has te adhuc exerci quaerendum? His in esse choro, mazim iisque ut mel, per vitae constituto scripserit an. Dictas efficiendi at vel, nisl mutat an ius. His elitr delenit erroribus at, eu vide euismod fierent sea.</p>
<p>Ex his magna munere euismod, cum id constituto definitionem? Brute autem id nec, ne sonet mollis deseruisse duo, aperiri electram eos an! Munere fastidii et pro. Dolorem nominavi complectitur vix et. Ad veri tamquam nam.</p>
<p>Viris facete eirmod sit ut. At eum assum quaerendum, possit facete an ius. Vis tale debet id, sit ne utroque efficiendi. Eu melius intellegebat vix, nobis nominavi vituperatoribus pri id. Impetus commune qui te, nam quando deserunt quaerendum in, no clita saperet petentium ius! Sint laudem audire vis no, prompta verterem recusabo vis ei!</p>
<p>Facer ridens conceptam cum ea, per no definiebas deterruisset consectetuer, ex duo exerci dolore partem. Vis soluta percipitur eu, vix inermis posidonium te. Assum corpora et mel, an nam justo detraxit consequuntur, et sit regione evertitur. His tollit nemore gubergren te, pri ei nonumy ceteros salutatus.</p>',
                'tmp_content' => null,
                'featured_image_id' => '2',
                'read_time' => '61',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '41',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'An denique dissentiet suscipiantur eos',
                'slug' => 'an-denique-dissentiet-suscipiantur-eos',
                'summary' => 'An denique dissentiet suscipiantur eos, oportere maiestatis per ex, no pri adhuc luptatum voluptatibus! Usu ea nostro adolescens instructior, eros consulatu ei pri! Vim ad brute minimum officiis, nusquam vivendum corrumpit cu vel, ad deleniti incorrupte vis. Mutat omnes vix ex, cetero nusquam ocurreret ius no? Mel ex vide ignota virtute!',
                'content' => '<p>Vel cu facer utinam accumsan, eos dicat dicit euripidis te, possim iuvaret docendi per eu. Vim viris vocent efficiantur ad, pro sint error constituto eu? Diam scriptorem sea ne, eos cibo commodo ei? Est modo libris ea, id vis everti aliquid? Ne iusto integre sit, mei reque theophrastus te. Elit graeco cum ea.</p>
<p>Stet tollit has ne, eos omnis assum an. Saperet scaevola ne vim, at mel porro paulo lucilius, mei minim movet congue ex. Cu his graece fastidii prodesset. Viris mediocrem et nam. Ea eum elit consulatu!</p>
<p>Ius dicam volumus ex, sea ex mucius invidunt, mundi tantas antiopam in pri? Noster latine conclusionemque mei eu. Quando deleniti rationibus duo ut, eam putant aliquip percipit no. Eu adhuc volutpat per? Ad ornatus inimicus periculis vim, eu possit maiestatis mei?</p>
<p>Quodsi iisque ornatus mei te? In mei mutat offendit deterruisset. Sit ad dicat fierent, nam ex semper vivendum maiestatis. Ea everti referrentur nam! Cu utinam salutatus theophrastus vim, liber deseruisse ne sea, nec ei equidem docendi sapientem. Id elitr regione convenire eam.</p>
<p>Postea aperiri conceptam pro an, verear regione patrioque no mea. Et dolores blandit necessitatibus pro? Vocibus maluisset te ius, soleat laoreet et sea. Est quod ancillae te! Te ius vocibus appetere liberavisse? Ius no esse option aliquip, ut qui cibo congue.</p>
<p>An sed quas ignota scaevola! Duo cu mucius veritus erroribus, quod aperiri an duo. Sanctus blandit vituperata at duo? At vix invidunt insolens vituperata, usu te percipit accusata percipitur, nec id impedit scripserit. Est ex utamur consequat conclusionemque! Vide idque altera te has, no has omnium indoctum, nec viderer tibique facilisi in.</p>
<p>Labore disputando disputationi eu vis, animal viderer intellegam ei per. Dolore dissentias quaerendum sed an, pro hinc adversarium at, harum consulatu reprimique usu id? Populo facilis accusamus his ad, civibus abhorreant adipiscing sit at, nam iracundia laboramus accommodare ea! Vel blandit molestiae ex. Et qui stet primis putant!</p>
<p>An denique dissentiet suscipiantur eos, oportere maiestatis per ex, no pri adhuc luptatum voluptatibus! Usu ea nostro adolescens instructior, eros consulatu ei pri! Vim ad brute minimum officiis, nusquam vivendum corrumpit cu vel, ad deleniti incorrupte vis. Mutat omnes vix ex, cetero nusquam ocurreret ius no? Mel ex vide ignota virtute!</p>
<p>No prompta impedit omnesque vim, vel an iusto decore. Usu latine commodo te? Ius cu corpora imperdiet, forensibus theophrastus qui eu? Eruditi assueverit sadipscing sea ex, sea minim soluta intellegebat ut, et probo tritani vix.</p>
<p>Sint brute molestiae no eam. Cetero eruditi oportere pri ad, vel te etiam integre antiopam. Invenire aliquando tincidunt in quo, nulla deseruisse efficiendi ad mea! Te his altera conceptam interesset, eam delenit vituperatoribus in. Te sea ferri facilisi, ignota recteque mel id?</p>',
                'tmp_content' => null,
                'featured_image_id' => '3',
                'read_time' => '60',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '42',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Inani quaeque ceteros utqui mea',
                'slug' => 'inani-quaeque-ceteros-utqui-mea',
                'summary' => 'His fastidii maluisset evertitur ut, ad quis modus accommodare vel. Et essent tritani copiosae cum. Odio atqui ea mel? Liber dicam eum eu, eos dolore tractatos ad, has eruditi civibus in. Eum cu dicat mucius saperet, no aeque persius adversarium cum! Pro ancillae postulant sadipscing an, no facilis suscipit eum. Ei lucilius scripserit vis!',
                'content' => '<p>Inani quaeque ceteros ut qui, mea ad soleat iriure. Tation nullam dissentias id nec, et dolor saperet deserunt sit, urbanitas argumentum mei eu? Ei vis phaedrum necessitatibus. Eam aeque viris legere at, id est decore nominati pericula? Mea ancillae mentitum contentiones in, meis mnesarchum no duo. Cu mea quas tritani saperet, usu appetere volutpat no.</p>
<p>Eos id placerat deserunt! Sea ad tation option, in has justo aperiam definiebas! Sea ad lucilius atomorum adolescens, id populo eirmod virtute duo. Id sit omnesque appetere, et erroribus vituperatoribus per, veri doming omnium quo ea. Ei periculis iracundia posidonium ius, no diam stet quas eam, sed ad homero meliore principes?</p>
<p>At dicam percipit conclusionemque qui, nullam volutpat reprehendunt nec ne! Ius ex diam similique philosophia, te per solum iisque instructior, sea ad reque audire debitis. Quem labores inimicus eu nam, ea euismod ocurreret eum. Eos impedit probatus in. Quo option principes ad, has nemore suscipit assentior te!</p>
<p>Nam ferri iuvaret electram no. Nec postea definitionem no, cu semper timeam iudicabit vim! Essent vidisse disputationi no quo, nostrud eloquentiam sea ei. Nec dicta scripta nonumes ei, no mea audiam eripuit feugiat?</p>
<p>Mundi iudico nam eu. Modus platonem rationibus nec ut, stet omnis ex vix. Ius explicari voluptatum eu. Quo accusam deterruisset et, ex cibo mazim tibique sea. Te magna suscipit forensibus qui, at duo animal option? Iuvaret ancillae te pri, sed dicunt facilisi eu.</p>
<p>Erant errem voluptua sea ei, fierent inimicus convenire cu est, bonorum impedit perfecto est ea. Aliquid volutpat ea sed, te ius summo persequeris. Fuisset lucilius vim cu. Mei at decore suavitate, lorem labores ut usu. Ut his dolores accumsan prodesset. Vivendum voluptaria percipitur ea sit. Quo an verterem principes?</p>
<p>Et vis enim brute fierent, sonet docendi eam no? Eos nobis mentitum prodesset cu, his at tantas graece postea. Ut veri justo nec, no usu ludus tation deseruisse, at ius nulla honestatis. Eu vis utamur omittantur, vel cu iriure vidisse efficiantur. Tritani eripuit percipitur eu duo, eum quodsi vidisse theophrastus ne.</p>
<p>His fastidii maluisset evertitur ut, ad quis modus accommodare vel. Et essent tritani copiosae cum. Odio atqui ea mel? Liber dicam eum eu, eos dolore tractatos ad, has eruditi civibus in. Eum cu dicat mucius saperet, no aeque persius adversarium cum! Pro ancillae postulant sadipscing an, no facilis suscipit eum. Ei lucilius scripserit vis!</p>
<p>Ea nam putent graecis admodum, ei quando vocent recteque quo. Et mei sale audiam conceptam. Paulo mundi ea eos! Iudico habemus explicari te per, euismod aliquid bonorum ut mei? Te meliore forensibus dissentias vel, id laudem mucius adipisci mei, magna dolorum delicatissimi ei mel!</p>
<p>Eum suscipit forensibus voluptatum et, id harum prompta sit! Legimus delectus sea ne, et mei elit aeterno sententiae, ad tempor consetetur persequeris cum? Et est decore periculis. Ut aeque errem quaerendum est, ius cu graeci assentior. Cu laudem minimum sit.</p>',
                'tmp_content' => null,
                'featured_image_id' => '4',
                'read_time' => '66',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '43',
                'user_id' => '1',
                'pay_type' => '1',
                'price' => null,
                'paid' => null,
                'disable_earnings' => null,
                'status' => '1',
                'title' => 'Tale sumo ei mel idius iisque maluisset',
                'slug' => 'tale-sumo-ei-mel-idius-iisque-maluisset',
                'summary' => 'Tale sumo ei mel, id ius iisque maluisset, amet prompta periculis ex est? Sed erant fierent splendide ea, pri fierent interesset cotidieque in? Ei mel expetenda dignissim omittantur. Integre convenire cu usu.',
                'content' => '<p>Tale sumo ei mel, id ius iisque maluisset, amet prompta periculis ex est? Sed erant fierent splendide ea, pri fierent interesset cotidieque in? Ei mel expetenda dignissim omittantur. Integre convenire cu usu.</p>
<p>Simul audire splendide qui ex, altera iisque nominavi et vix! Sed sint nonumy aliquid an? Iusto mucius accusata in nam? Maiorum corpora deserunt an eum, an cum probo facilisi, cu eum vidit clita! His eros iudicabit in, omittam adversarium ex ius? In cum solum falli, vituperata referrentur vel ut?</p>
<p>Sale intellegat sea ne! Autem dolor tempor cu nec! Appareat mandamus est no. Usu nostrum pericula partiendo an. Rebum oratio his et.</p>
<p>Cum iriure tamquam suscipiantur eu? Hinc lobortis cu vis, summo tibique at est. Te has oblique recteque corrumpit, cum ne paulo commune, in eripuit volumus consectetuer usu. Quot quando graece ad vis, vis id veri putent molestie.</p>
<p>Eu autem delectus vel! Per no dicat iudico iudicabit, pri augue qualisque at? Sed ne saepe meliore, etiam decore nemore has at. Sonet iuvaret ea mei, cum id autem ipsum intellegat.</p>
<p>Ad meis similique eam. Enim corrumpit vel at, nonumes copiosae convenire ut sea. Ius porro graece ut! Vix ea inani honestatis, viderer fastidii sit et, ut nobis gloriatur inciderint has. His te vocent audiam, te magna melius iuvaret has.</p>
<p>Eu rebum autem equidem duo, no aliquam legendos nec, eum prima ridens no. Ludus recusabo consetetur te mei. Ei qui dolore mucius concludaturque, eos an habeo sadipscing. Ne facilisi partiendo maiestatis nec, vix populo torquatos pertinacia ei, nec ne quis rebum porro! His id possit principes, deleniti dissentias contentiones cu per. Ad nostrud dolorem consectetuer cum, suas volutpat neglegentur mea ad, soluta forensibus adolescens usu at? Sensibus laboramus at quo, movet copiosae ut qui, eu mel dictas volutpat!</p>
<p>Eu ferri concludaturque est, eu mea wisi errem volutpat. Ne facer dicit doctus his! Vix sententiae temporibus id. Eu vis appetere reprimique, pri minim audire aeterno ea.</p>
<p>Ei assum luptatum aliquando nec, aperiam sensibus principes mei ut, an porro corpora eleifend ius. Placerat verterem percipitur quo at, cu minim eripuit qui, sea soleat eloquentiam te? Ea essent salutatus dissentiet est, in ius ludus pertinacia intellegebat! Duo vitae homero consectetuer at, nam everti euismod ne! Sea cu meliore expetenda. Invidunt laboramus honestatis vix te, an usu vulputate suscipiantur. Movet soluta placerat sed ea, ne his paulo impetus consetetur.</p>
<p>An duo impedit habemus, aeque volumus consetetur vix cu! Omnis doming ea mei! Et cum iisque minimum perfecto! At aperiam tincidunt pri, eum ut possit officiis vituperata, sea putant malorum eu. Regione periculis reprehendunt te has, cum mollis legimus in.</p>',
                'tmp_content' => null,
                'featured_image_id' => '1',
                'read_time' => '59',
                'hits' => '0',
                'notes' => '[]',
                'published_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
        ];
        DB::table('articles')->insert($articles);

        $article_category = [
            ['article_id' => '1', 'category_id' => '4', 'main' => '1'],
            ['article_id' => '2', 'category_id' => '4', 'main' => '1'],
            ['article_id' => '3', 'category_id' => '4', 'main' => '1'],
            ['article_id' => '4', 'category_id' => '4', 'main' => '1'],
            ['article_id' => '5', 'category_id' => '4', 'main' => '1'],
            ['article_id' => '6', 'category_id' => '4', 'main' => '1'],
            ['article_id' => '7', 'category_id' => '4', 'main' => '1'],
            ['article_id' => '8', 'category_id' => '4', 'main' => '1'],
            ['article_id' => '9', 'category_id' => '4', 'main' => '1'],
            ['article_id' => '10', 'category_id' => '4', 'main' => '1'],
            ['article_id' => '11', 'category_id' => '4', 'main' => '1'],
            ['article_id' => '12', 'category_id' => '4', 'main' => '1'],
            ['article_id' => '13', 'category_id' => '1', 'main' => '1'],
            ['article_id' => '14', 'category_id' => '1', 'main' => '1'],
            ['article_id' => '15', 'category_id' => '1', 'main' => '1'],
            ['article_id' => '16', 'category_id' => '1', 'main' => '1'],
            ['article_id' => '17', 'category_id' => '1', 'main' => '1'],
            ['article_id' => '18', 'category_id' => '1', 'main' => '1'],
            ['article_id' => '19', 'category_id' => '5', 'main' => '1'],
            ['article_id' => '20', 'category_id' => '5', 'main' => '1'],
            ['article_id' => '21', 'category_id' => '5', 'main' => '1'],
            ['article_id' => '22', 'category_id' => '5', 'main' => '1'],
            ['article_id' => '23', 'category_id' => '3', 'main' => '1'],
            ['article_id' => '24', 'category_id' => '3', 'main' => '1'],
            ['article_id' => '25', 'category_id' => '3', 'main' => '1'],
            ['article_id' => '26', 'category_id' => '3', 'main' => '1'],
            ['article_id' => '27', 'category_id' => '3', 'main' => '1'],
            ['article_id' => '28', 'category_id' => '3', 'main' => '1'],
            ['article_id' => '29', 'category_id' => '3', 'main' => '1'],
            ['article_id' => '30', 'category_id' => '3', 'main' => '1'],
            ['article_id' => '31', 'category_id' => '3', 'main' => '1'],
            ['article_id' => '32', 'category_id' => '3', 'main' => '1'],
            ['article_id' => '33', 'category_id' => '3', 'main' => '1'],
            ['article_id' => '34', 'category_id' => '2', 'main' => '1'],
            ['article_id' => '35', 'category_id' => '6', 'main' => '1'],
            ['article_id' => '36', 'category_id' => '2', 'main' => '1'],
            ['article_id' => '37', 'category_id' => '2', 'main' => '1'],
            ['article_id' => '38', 'category_id' => '6', 'main' => '1'],
            ['article_id' => '39', 'category_id' => '6', 'main' => '1'],
            ['article_id' => '40', 'category_id' => '6', 'main' => '1'],
            ['article_id' => '41', 'category_id' => '2', 'main' => '1'],
            ['article_id' => '42', 'category_id' => '4', 'main' => '1'],
            ['article_id' => '43', 'category_id' => '4', 'main' => '1'],
        ];
        DB::table('article_category')->insert($article_category);

        $article_tag = [
            ['article_id' => '1', 'tag_id' => '1'],
            ['article_id' => '2', 'tag_id' => '1'],
            ['article_id' => '3', 'tag_id' => '1'],
            ['article_id' => '4', 'tag_id' => '1'],
            ['article_id' => '5', 'tag_id' => '1'],
            ['article_id' => '6', 'tag_id' => '1'],
            ['article_id' => '7', 'tag_id' => '1'],
            ['article_id' => '8', 'tag_id' => '1'],
            ['article_id' => '9', 'tag_id' => '1'],
            ['article_id' => '10', 'tag_id' => '1'],
            ['article_id' => '11', 'tag_id' => '1'],
            ['article_id' => '12', 'tag_id' => '1'],
            ['article_id' => '13', 'tag_id' => '1'],
            ['article_id' => '14', 'tag_id' => '1'],
            ['article_id' => '15', 'tag_id' => '1'],
            ['article_id' => '16', 'tag_id' => '1'],
            ['article_id' => '17', 'tag_id' => '1'],
            ['article_id' => '18', 'tag_id' => '1'],
            ['article_id' => '19', 'tag_id' => '1'],
            ['article_id' => '20', 'tag_id' => '1'],
            ['article_id' => '21', 'tag_id' => '1'],
            ['article_id' => '22', 'tag_id' => '1'],
            ['article_id' => '23', 'tag_id' => '1'],
            ['article_id' => '24', 'tag_id' => '1'],
            ['article_id' => '25', 'tag_id' => '1'],
            ['article_id' => '26', 'tag_id' => '1'],
            ['article_id' => '27', 'tag_id' => '1'],
            ['article_id' => '28', 'tag_id' => '1'],
            ['article_id' => '29', 'tag_id' => '1'],
            ['article_id' => '30', 'tag_id' => '1'],
            ['article_id' => '31', 'tag_id' => '1'],
            ['article_id' => '32', 'tag_id' => '1'],
            ['article_id' => '33', 'tag_id' => '1'],
            ['article_id' => '34', 'tag_id' => '1'],
            ['article_id' => '35', 'tag_id' => '1'],
            ['article_id' => '36', 'tag_id' => '1'],
            ['article_id' => '37', 'tag_id' => '1'],
            ['article_id' => '38', 'tag_id' => '1'],
            ['article_id' => '39', 'tag_id' => '1'],
            ['article_id' => '40', 'tag_id' => '1'],
            ['article_id' => '41', 'tag_id' => '1'],
            ['article_id' => '42', 'tag_id' => '1'],
        ];
        DB::table('article_tag')->insert($article_tag);

        $categories = [
            [
                'id' => '1',
                'parent_id' => null,
                'name' => 'Tech',
                'slug' => 'tech',
                'status' => '1',
                'description' => null,
                'color' => 'rgba(30, 136, 229, 1)',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '2',
                'parent_id' => null,
                'name' => 'Science',
                'slug' => 'science',
                'status' => '1',
                'description' => null,
                'color' => 'rgba(31, 67, 99, 1)',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '3',
                'parent_id' => null,
                'name' => 'Sports',
                'slug' => 'sports',
                'status' => '1',
                'description' => null,
                'color' => 'rgba(249, 193, 0, 1)',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '4',
                'parent_id' => null,
                'name' => 'Business',
                'slug' => 'business',
                'status' => '1',
                'description' => null,
                'color' => 'rgba(76, 175, 80, 1)',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '5',
                'parent_id' => null,
                'name' => 'Lifestyle',
                'slug' => 'lifestyle',
                'status' => '1',
                'description' => null,
                'color' => 'rgba(11, 141, 93, 1)',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '6',
                'parent_id' => null,
                'name' => 'Health',
                'slug' => 'health',
                'status' => '1',
                'description' => null,
                'color' => 'rgba(17, 127, 150, 1)',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
        ];
        DB::table('categories')->insert($categories);

        $files = [
            [
                'id' => '1',
                'user_id' => '1',
                'name' => 'children-593313_1280',
                'file' => '/uploads/2019/02/1551002958-children-593313-1280.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '97806',
                'sha1sum' => '4c10a9e129e77b0caf345ef51c1233f4f714959f',
                'meta' => '{"width":1200,"height":800,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '2',
                'user_id' => '1',
                'name' => 'StockSnap_X2Q7LBUF6U',
                'file' => '/uploads/2019/02/1549310134-stocksnap-x2q7lbuf6u.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '211228',
                'sha1sum' => '3b7878d7def29239c81433acfc2e67c180186751',
                'meta' => '{"width":1200,"height":900,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '3',
                'user_id' => '1',
                'name' => 'earth-1281025_1280',
                'file' => '/uploads/2019/02/1549310570-earth-1281025-1280.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '67236',
                'sha1sum' => 'c5d9d232d4d6398beaccc627a79dadcb56759d58',
                'meta' => '{"width":1200,"height":675,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '4',
                'user_id' => '1',
                'name' => 'StockSnap_VQCOT1BLM0',
                'file' => '/uploads/2019/02/1549310849-stocksnap-vqcot1blm0.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '138680',
                'sha1sum' => 'a0da3b72ebf8df463e07f7cafdadeb242643ac5f',
                'meta' => '{"width":1200,"height":1051,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '5',
                'user_id' => '1',
                'name' => 'board-22098_1280',
                'file' => '/uploads/2019/02/1549310956-board-22098-1280.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '132926',
                'sha1sum' => '2ba8677a7688a44201d8c02370bb0122de22353b',
                'meta' => '{"width":1200,"height":800,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '6',
                'user_id' => '1',
                'name' => 'StockSnap_FY5YYPG1LS',
                'file' => '/uploads/2019/02/1549311035-stocksnap-fy5yypg1ls.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '93005',
                'sha1sum' => 'a85c8388bed919bfa09486d13f0e5e91ce4592e7',
                'meta' => '{"width":1200,"height":800,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '7',
                'user_id' => '1',
                'name' => 'coffee-2306471_1280',
                'file' => '/uploads/2019/02/1551003302-coffee-2306471-1280.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '115007',
                'sha1sum' => '2fc8a691f0e40f88e8e34db35d90121b9024cbf4',
                'meta' => '{"width":1200,"height":800,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '8',
                'user_id' => '1',
                'name' => 'StockSnap_2BE6B9D920',
                'file' => '/uploads/2019/02/1551003380-stocksnap-2be6b9d920.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '61167',
                'sha1sum' => 'ae5808e191dd1c7bed6bafefeb9af9eb37a15c20',
                'meta' => '{"width":1200,"height":797,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '9',
                'user_id' => '1',
                'name' => 'StockSnap_HMKOMNKGUU',
                'file' => '/uploads/2019/02/1551003395-stocksnap-hmkomnkguu.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '133822',
                'sha1sum' => 'f0d61809e0e44f0425dc4fac0bb7cc48e9270274',
                'meta' => '{"width":1200,"height":801,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '10',
                'user_id' => '1',
                'name' => 'StockSnap_2A04172FFA',
                'file' => '/uploads/2019/02/1551003424-stocksnap-2a04172ffa.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '87808',
                'sha1sum' => '993dc5d877d0933f969fd51cb3a824ebdc59337e',
                'meta' => '{"width":1200,"height":800,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '11',
                'user_id' => '1',
                'name' => 'entrepreneur-1340649_1280',
                'file' => '/uploads/2019/02/1551003700-entrepreneur-1340649-1280.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '172061',
                'sha1sum' => 'c41765de0c4976e5f4385d0a3baf2b9b6257dc13',
                'meta' => '{"width":1200,"height":848,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '12',
                'user_id' => '1',
                'name' => 'StockSnap_99DQMFQ8NP',
                'file' => '/uploads/2019/02/1551003717-stocksnap-99dqmfq8np.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '71887',
                'sha1sum' => '02437c1c8702182ca21cc3c65c5db6aa8f6f482f',
                'meta' => '{"width":1200,"height":756,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '13',
                'user_id' => '1',
                'name' => 'StockSnap_0P6FVF3Q5L',
                'file' => '/uploads/2019/02/1551003769-stocksnap-0p6fvf3q5l.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '81458',
                'sha1sum' => 'fa4eea09f15dd7179f712358250a0907ae0991ab',
                'meta' => '{"width":1200,"height":800,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '14',
                'user_id' => '1',
                'name' => 'time-3222267_1280',
                'file' => '/uploads/2019/02/1551003790-time-3222267-1280.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '284952',
                'sha1sum' => 'b4c47aa412dc05c6dce2e06f3cbc9c8d90de43ee',
                'meta' => '{"width":1200,"height":800,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '15',
                'user_id' => '1',
                'name' => 'StockSnap_V8A98C0U96',
                'file' => '/uploads/2019/02/1551003822-stocksnap-v8a98c0u96.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '72976',
                'sha1sum' => '1b8642871102f79ce35c08d91f9c83031651303e',
                'meta' => '{"width":1200,"height":901,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '16',
                'user_id' => '1',
                'name' => 'StockSnap_SWRREC0K3A',
                'file' => '/uploads/2019/02/1551003852-stocksnap-swrrec0k3a.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '137910',
                'sha1sum' => 'ea66b9dc222a13cc9829d5c9bc5562e8dd182320',
                'meta' => '{"width":1200,"height":800,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '17',
                'user_id' => '1',
                'name' => 'StockSnap_PHE63L27S6',
                'file' => '/uploads/2019/02/1551003872-stocksnap-phe63l27s6.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '103915',
                'sha1sum' => '3a0a4698c4044a94d91eb45635daefb5f7ad03b8',
                'meta' => '{"width":1200,"height":800,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '18',
                'user_id' => '1',
                'name' => 'StockSnap_ONN4Z188GF',
                'file' => '/uploads/2019/02/1551003890-stocksnap-onn4z188gf.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '208036',
                'sha1sum' => '7b10b07b9288b6a800a5bfc8b44770857464ebd5',
                'meta' => '{"width":1200,"height":800,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '19',
                'user_id' => '1',
                'name' => 'StockSnap_L8TKYPYZ2G',
                'file' => '/uploads/2019/02/1551003924-stocksnap-l8tkypyz2g.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '62960',
                'sha1sum' => 'b45d21220130076b754a637a38819cd9c5069915',
                'meta' => '{"width":1200,"height":786,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '20',
                'user_id' => '1',
                'name' => 'StockSnap_ITA18FXIBL',
                'file' => '/uploads/2019/02/1551003950-stocksnap-ita18fxibl.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '127898',
                'sha1sum' => 'a9ec3379c25b3435572b30ca5e3e23d5e158ba68',
                'meta' => '{"width":1200,"height":800,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '21',
                'user_id' => '1',
                'name' => 'StockSnap_16VYGB9PG5',
                'file' => '/uploads/2019/02/1551003964-stocksnap-16vygb9pg5.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '45078',
                'sha1sum' => '780ae4dfe534af0e24ba401b14fdb7c96b83aefc',
                'meta' => '{"width":1200,"height":800,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '22',
                'user_id' => '1',
                'name' => 'StockSnap_7JL2LHZ8YA',
                'file' => '/uploads/2019/02/1551003979-stocksnap-7jl2lhz8ya.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '80928',
                'sha1sum' => '34b0cec8125384a0ed88e6c3c1dfa2d91282d73c',
                'meta' => '{"width":1200,"height":765,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '23',
                'user_id' => '1',
                'name' => 'StockSnap_LHHL7FKKVD',
                'file' => '/uploads/2019/02/1551004050-stocksnap-lhhl7fkkvd.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '151257',
                'sha1sum' => '704ad46ef9a7038d72f739521de9bc73f0a4b6e9',
                'meta' => '{"width":1200,"height":800,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '24',
                'user_id' => '1',
                'name' => 'StockSnap_21503D358D',
                'file' => '/uploads/2019/02/1551004218-stocksnap-21503d358d.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '116690',
                'sha1sum' => 'b38d67fea90ebd93011a2873481ca2e93b2c4fff',
                'meta' => '{"width":1200,"height":799,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '25',
                'user_id' => '1',
                'name' => 'StockSnap_XL8N3FXQDX',
                'file' => '/uploads/2019/02/1551004231-stocksnap-xl8n3fxqdx.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '107602',
                'sha1sum' => '6c266b05cfab32dda16a4c60497c50fcbe29b9fc',
                'meta' => '{"width":1200,"height":868,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '26',
                'user_id' => '1',
                'name' => 'StockSnap_U8DUBTLAN9',
                'file' => '/uploads/2019/02/1551004248-stocksnap-u8dubtlan9.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '124292',
                'sha1sum' => '0804f71ead658a0f10f17500979d6da914683d56',
                'meta' => '{"width":1200,"height":675,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '27',
                'user_id' => '1',
                'name' => 'StockSnap_TZ7YMHZAHU',
                'file' => '/uploads/2019/02/1551004265-stocksnap-tz7ymhzahu.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '154047',
                'sha1sum' => 'f519d542b622a31023bea647397c88658e714861',
                'meta' => '{"width":1200,"height":800,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '28',
                'user_id' => '1',
                'name' => 'StockSnap_DE3NRX2TIF',
                'file' => '/uploads/2019/02/1551004292-stocksnap-de3nrx2tif.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '135164',
                'sha1sum' => 'e28bc3ebed91e6879b0e2203721508cffb966bd6',
                'meta' => '{"width":1200,"height":800,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '29',
                'user_id' => '1',
                'name' => 'StockSnap_SNIKX3KGKD',
                'file' => '/uploads/2019/02/1551004316-stocksnap-snikx3kgkd.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '203504',
                'sha1sum' => '7c1cad9d3e51abda5f502c20d7ee155285bbae86',
                'meta' => '{"width":1200,"height":800,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '30',
                'user_id' => '1',
                'name' => 'StockSnap_LXIA63985D',
                'file' => '/uploads/2019/02/1551004341-stocksnap-lxia63985d.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '137227',
                'sha1sum' => '8223dd1d9fd69b7343e67137736f0f7e2ec3529c',
                'meta' => '{"width":1200,"height":1332,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '31',
                'user_id' => '1',
                'name' => 'StockSnap_HWDNFMZHRP',
                'file' => '/uploads/2019/02/1551004361-stocksnap-hwdnfmzhrp.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '197928',
                'sha1sum' => '710dce324a62ead274651435955fe273cdb15710',
                'meta' => '{"width":1200,"height":790,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '32',
                'user_id' => '1',
                'name' => 'pexels-photo-903002',
                'file' => '/uploads/2019/02/1551004553-pexels-photo-903002.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '104833',
                'sha1sum' => 'bf77d6c00091421a85604fe7a37b508b0bb95ef5',
                'meta' => '{"width":1200,"height":800,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '33',
                'user_id' => '1',
                'name' => 'woman-3053492_1280',
                'file' => '/uploads/2019/02/1551004570-woman-3053492-1280.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '78461',
                'sha1sum' => '05a7b76b71ecea00471f6ce287f919ee0c061151',
                'meta' => '{"width":1200,"height":800,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '34',
                'user_id' => '1',
                'name' => 'StockSnap_YJDYDAUZTM',
                'file' => '/uploads/2019/02/1551004650-stocksnap-yjdydauztm.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '140791',
                'sha1sum' => '15052368c5a5d427fa09b2cee23f08232f1033b3',
                'meta' => '{"width":1200,"height":847,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '35',
                'user_id' => '1',
                'name' => 'background-2426328_1280',
                'file' => '/uploads/2019/02/1551004697-background-2426328-1280.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '62339',
                'sha1sum' => '318c13b10a5fa83cb79162b42a7baf071ed2df2f',
                'meta' => '{"width":1200,"height":750,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '36',
                'user_id' => '1',
                'name' => 'technology-662833_1280',
                'file' => '/uploads/2019/02/1551004718-technology-662833-1280.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '163086',
                'sha1sum' => '8cd7f141de7ac1dd13d4463cd4c00cd90b521085',
                'meta' => '{"width":1200,"height":761,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '37',
                'user_id' => '1',
                'name' => 'StockSnap_YKVMG3Z5TQ',
                'file' => '/uploads/2019/02/1551004941-stocksnap-ykvmg3z5tq.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '61023',
                'sha1sum' => 'baf472ba58bbb955352de989168ededc4c89a729',
                'meta' => '{"width":1200,"height":800,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '38',
                'user_id' => '1',
                'name' => 'StockSnap_UQU6KX1C2S',
                'file' => '/uploads/2019/02/1551004971-stocksnap-uqu6kx1c2s.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '119038',
                'sha1sum' => 'f5828dbcdaf7e77904e0ba0f2abdbebd1eec1427',
                'meta' => '{"width":1200,"height":800,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '39',
                'user_id' => '1',
                'name' => 'robot-2301646_1280',
                'file' => '/uploads/2019/02/1551004992-robot-2301646-1280.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '93522',
                'sha1sum' => '35fc45deabec57c009a22f3da709488bc8f9bd88',
                'meta' => '{"width":1200,"height":675,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '40',
                'user_id' => '1',
                'name' => 'StockSnap_F7AEBU9901',
                'file' => '/uploads/2019/02/1551005016-stocksnap-f7aebu9901.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '82602',
                'sha1sum' => 'd28a397cb7522feabd02c61fb40c74c1ce6e15dd',
                'meta' => '{"width":1200,"height":800,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '41',
                'user_id' => '1',
                'name' => 'space-station-60615_1280',
                'file' => '/uploads/2019/02/1551005058-space-station-60615-1280.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '346489',
                'sha1sum' => 'b5ffb50df06ffc675f99c9437c3b8d53f6942459',
                'meta' => '{"width":1200,"height":1200,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '42',
                'user_id' => '1',
                'name' => 'virus-1812092_1280',
                'file' => '/uploads/2019/02/1551005091-virus-1812092-1280.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '68580',
                'sha1sum' => '03bbece197bb0226f435b3310fd55d3a06377429',
                'meta' => '{"width":1200,"height":600,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '43',
                'user_id' => '1',
                'name' => 'rocket-launch-67643_1280',
                'file' => '/uploads/2019/02/1551005129-rocket-launch-67643-1280.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '107957',
                'sha1sum' => 'e89ecceb27646ba3026d243e78d33ee0b3ebec82',
                'meta' => '{"width":1200,"height":803,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '45',
                'user_id' => '1',
                'name' => 'Paypal',
                'file' => '/uploads/2019/02/1551021607-paypal.png',
                'extension' => 'png',
                'type' => 'image/png',
                'size' => '3598',
                'sha1sum' => '64227257f43b57833bf4049d857e3a7c71254951',
                'meta' => '{"width":200,"height":51,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '46',
                'user_id' => '1',
                'name' => 'Paytm',
                'file' => '/uploads/2019/02/1551022180-paytm.png',
                'extension' => 'png',
                'type' => 'image/png',
                'size' => '2672',
                'sha1sum' => '68894eef30d3c3b16144fcd5ed203413e96c3df6',
                'meta' => '{"width":200,"height":63,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '47',
                'user_id' => '1',
                'name' => 'Skrill',
                'file' => '/uploads/2019/02/1551022305-skrill.png',
                'extension' => 'png',
                'type' => 'image/png',
                'size' => '8074',
                'sha1sum' => 'a05a452dc98a5137f5983bea49012c59e0de5db6',
                'meta' => '{"width":200,"height":69,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '48',
                'user_id' => '1',
                'name' => 'Payza',
                'file' => '/uploads/2019/02/1551022325-payza.png',
                'extension' => 'png',
                'type' => 'image/png',
                'size' => '9000',
                'sha1sum' => 'b39fe37c85a39a06576a4a1946d49c23306693b7',
                'meta' => '{"width":200,"height":56,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '49',
                'user_id' => '1',
                'name' => 'Bitcoin',
                'file' => '/uploads/2019/02/1551022347-bitcoin.png',
                'extension' => 'png',
                'type' => 'image/png',
                'size' => '5421',
                'sha1sum' => 'f63d8ffa6e2fefb2b43710af095894f611ffa47f',
                'meta' => '{"width":200,"height":42,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '50',
                'user_id' => '1',
                'name' => 'banner-468x60',
                'file' => '/uploads/2019/02/1551025573-banner-468x60.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '11376',
                'sha1sum' => '391a0b2564d5059be7f8ddf4202e46608e082cea',
                'meta' => '{"width":468,"height":60,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '52',
                'user_id' => '1',
                'name' => 'Stripe',
                'file' => '/uploads/2019/02/1551213189-stripe.png',
                'extension' => 'png',
                'type' => 'image/png',
                'size' => '3572',
                'sha1sum' => 'e2baa68abc1a8f2e83d835cd13cf798a624574aa',
                'meta' => '{"width":200,"height":83,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '54',
                'user_id' => '1',
                'name' => 'Banner 728x90 - TOP',
                'file' => '/uploads/2019/02/1551361190-banner-728x90.jpeg',
                'extension' => 'jpeg',
                'type' => 'image/jpeg',
                'size' => '17949',
                'sha1sum' => '8acfe010633bafd3d0d69eab51d031834b0c1609',
                'meta' => '{"width":728,"height":90,"sizes":{"thumbnail":[150,150],"small":[370,222],"medium":[740,444],"large":[1024,615]}}',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
        ];
        DB::table('files')->insert($files);

        $menus = [
            [
                'id' => '1',
                'name' => 'Top Menu',
                'items' => '[{"id":"m_5c581596e3ad7","type":"link","position":"1","title":"Login","link":"\\/login","visibility":"guest","class":null},{"id":"m_5c5815a046c5b","type":"link","position":"2","title":"Register","link":"\\/register","visibility":"guest","class":null},{"id":"m_5c581607991ad","type":"link","position":"3","title":"Admin Dashboard","link":"\\/admin","visibility":"admin","class":null},{"id":"m_5c5815ced0668","type":"link","position":"4","title":"Member Dashboard","link":"\\/member","visibility":"logged","class":null}]',
            ],
            [
                'id' => '2',
                'name' => 'Main Menu',
                'items' => '[{"id":"m_5c58155cad33e","type":"link","position":"1","title":"Home","link":"\\/","visibility":"all","class":null},{"id":"m_5c58202501e55","type":"category","position":"2","title":"Lifestyle","category":"5","visibility":"all","class":null},{"id":"m_5c581f8d18279","type":"category","position":"3","title":"Business","category":"4","visibility":"all","class":null},{"id":"m_5c581f919e657","type":"category","position":"4","title":"Sports","category":"3","visibility":"all","class":null},{"id":"m_5c58277c0d07b","type":"category","position":"5","title":"Health","category":"6","visibility":"all","class":null},{"id":"m_5c581f9a07a03","type":"category","position":"6","title":"Tech","category":"1","visibility":"all","class":null},{"id":"m_5c581f9ea6573","type":"category","position":"7","title":"Science","category":"2","visibility":"all","class":null},{"id":"m_5c581fe70fc14","type":"link","position":"8","title":"Contact","link":"\\/contact","visibility":"all","class":null}]',
            ],
            [
                'id' => '3',
                'name' => 'Footer Menu',
                'items' => '[{"id":"m_5c5814fa199f8","type":"page","position":"1","title":"Privacy","page":"1","visibility":"all","class":null},{"id":"m_5c5815052f281","type":"page","position":"2","title":"Terms of Use","page":"2","visibility":"all","class":null}]',
            ],
        ];
        DB::table('menus')->insert($menus);

        $pages = [
            [
                'id' => '1',
                'status' => '1',
                'title' => 'Privacy Policy',
                'slug' => 'privacy',
                'content' => null,
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '2',
                'status' => '1',
                'title' => 'Terms of Use',
                'slug' => 'terms',
                'content' => null,
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => '3',
                'status' => '1',
                'title' => 'Write and Get Paid',
                'slug' => 'write-get-paid',
                'content' => '<p>Do you want to earn money online? Our website was built on the efforts of readers just like you. Readers who didn&rsquo;t have any experience as writers but decided to put a list together and send it in.</p>
<p>So here is the deal: We will pay you for your efforts. You don&rsquo;t need to be an expert&mdash;you just need to have English equal to that of a native speaker, a sense of humor, and a love for things unusual or interesting.</p>
<h2>Join</h2>
<p>You do not need to have any relevant experience or hold any particular qualifications, but you do need to:</p>
<ul>
<li>Possess excellent creativity</li>
<li>Have a keen eye for detail</li>
<li>Show a passion for content creation</li>
<li>Stay on top of trends</li>
</ul>
<h2>Create</h2>
<p>To help you out with some ideas, the lists that our readers love the most (and the ones we will most likely pay for) are lists that are offbeat and novel&mdash;lists that are looking at something normal in an unexpected way (ways college makes you dumb, for example), unsolved mysteries, hidden knowledge (things most people don&rsquo;t know), misconceptions, and just really astonishing general knowledge about anything&mdash;science, for example. After approving your article, it will be great&nbsp;to share it on Facebook/Twitter.</p>
<h2>Earn</h2>
<p>You will earn revenue for every article that is published.</p>
<ul>
<li>No limit on articles published</li>
<li>Must be 100% original content</li>
<li>Paid out via PayPal</li>
</ul>
<h2>Payment Methods</h2>
<p>[withdrawal_methods]</p>
<h2>Payout rates</h2>
<p>[payout_rates]</p>',
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
        ];
        DB::table('pages')->insert($pages);

        $sidebars = [
            [
                'id' => '1',
                'name' => 'Default',
                'widgets' => '[{"id":"w_5c1282f1a64ce","type":"popular_articles","position":"1","title":"Popular Articles","auto":"1","period":"month","num":"5","class":null},{"id":"w_5c1295fbe483d","type":"ads","position":"2","title":"Ads","ad_id":"4"},{"id":"w_5c1296066140c","type":"newsletter","position":"3","title":"Join Our Newsletter","class":null}]',
            ],
            [
                'id' => '2',
                'name' => 'Article',
                'widgets' => '[{"id":"w_5c14f6d31b450","type":"author_about","position":"1","title":"About Author","class":null},{"id":"w_5c14d84197882","type":"ads","position":"2","title":"Ads","ad_id":"4"},{"id":"w_5c14d84ca2e9f","type":"newsletter","position":"3","title":"Join Our Newsletter","class":null}]',
            ],
            [
                'id' => '3',
                'name' => 'Author',
                'widgets' => '[{"id":"w_5c14f7b00dd74","type":"author_popular","position":"1","title":"Most Popular","period":"all","num":"10","class":null}]',
            ],
            [
                'id' => '4',
                'name' => 'Footer 1',
                'widgets' => '[{"id":"w_5c151d42699ee","type":"recent_articles","position":"1","title":"Recent Articles","num":"5","class":null}]',
            ],
            [
                'id' => '5',
                'name' => 'Footer 2',
                'widgets' => '[{"id":"w_5c151a9cd2079","type":"recent_tweets","position":"1","title":"Recent Tweets","username":"envato","twitter_api_key":"","twitter_api_secret_key":"","num":"5","class":null}]',
            ],
            [
                'id' => '6',
                'name' => 'Footer 3',
                'widgets' => '[{"id":"w_5c15184ba7f89","type":"newsletter","position":"1","title":"Join Our Newsletter","class":null},{"id":"w_5c155e4954d80","type":"follow_us","position":"2","title":"Follow us","facebook":"https:\\/\\/www.example.com","twitter":"https:\\/\\/www.example.com","google_plus":"https:\\/\\/www.example.com","youtube":"https:\\/\\/www.example.com","pinterest":null,"instagram":null,"vk":null,"class":null}]',
            ],
        ];
        DB::table('sidebars')->insert($sidebars);

        $tags = [
            [
                'id' => '1',
                'name' => 'Tag',
                'slug' => 'tag',
                'status' => '1',
                'description' => null,
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ],
        ];
        DB::table('tags')->insert($tags);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
