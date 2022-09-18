<script type='text/javascript'>
    /* <![CDATA[ */
    var app_vars = <?= json_encode([
        'base_url' => url('/'),
        'ajax_element_url' => route('ajax.element'),
        'captcha' => (bool)isset_captcha(),
        'captcha_type' => e(get_option('captcha_type')),
        'recaptcha_v2_checkbox_site_key' => e(get_option('recaptcha_v2_checkbox_site_key')),
        'recaptcha_v2_invisible_site_key' => e(get_option('recaptcha_v2_invisible_site_key')),
        'solvemedia_challenge_key' => e(get_option('solvemedia_challenge_key')),
        'recaptcha_v3_article' => (bool)get_option('recaptcha_v3_article', 0),
        'recaptcha_v3_site_key' => e(get_option('recaptcha_v3_site_key')),
        'captcha_login' => (bool)get_option('captcha_login', 0),
        'captcha_register' => (bool)get_option('captcha_register', 0),
        'captcha_forgot_password' => (bool)get_option('captcha_forgot_password', 0),
        'captcha_contact' => (bool)get_option('captcha_contact', 0),
        'force_disable_adblock' => (bool)get_option('force_disable_adblock', 0),
        'please_disable_adblock' => e(__("Please disable Adblock to view this article.")),
        'cookie_notification_bar' => (bool)get_option('cookie_notification_bar', 1),
        'cookie_message' => e(__('This website uses cookies to ensure you get the best experience on our website.')),
        'cookie_button' => e(__('Got it!')),
    ]) ?>;
    /* ]]> */
</script>
