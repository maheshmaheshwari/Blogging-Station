// https://coderwall.com/p/fnvjvg/jquery-test-if-element-is-in-viewport
$.fn.isOnScreen = function () {

    if (!this.length) {
        return false;
    }

    var win = $(window);

    var viewport = {
        top: win.scrollTop(),
        left: win.scrollLeft(),
    };
    viewport.right = viewport.left + win.width();
    viewport.bottom = viewport.top + win.height();

    var bounds = this.offset();
    bounds.right = bounds.left + this.outerWidth();
    bounds.bottom = bounds.top + this.outerHeight();

    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top ||
        viewport.top > bounds.bottom));

};

/**
 * reCAPTCHA Stuff
 */
var captchaLogin;
var captchaRegister;
var captchaForgotPassword;
var captchaContact;
var invisibleCaptchaSignin;
var invisibleCaptchaSignup;
var invisibleCaptchaForgotpassword;
var invisibleCaptchaContact;
var CaptchaArticleScore;

window.onload = function () {

    if (!app_vars.captcha) {
        return true;
    }

    if (app_vars.captcha_type === 'solvemedia') {
        if (app_vars.captcha_login && $('#captchaLogin').length) {
            captchaLogin = ACPuzzle.create(
                app_vars.solvemedia_challenge_key,
                'captchaLogin',
                {multi: true, id: 'captchaLogin'}
            );
        }

        if (app_vars.captcha_register && $('#captchaRegister').length) {
            captchaRegister = ACPuzzle.create(
                app_vars.solvemedia_challenge_key,
                'captchaRegister',
                {multi: true, id: 'captchaRegister'}
            );
        }

        if (app_vars.captcha_forgot_password && $('#captchaForgotPassword').length) {
            captchaForgotPassword = ACPuzzle.create(
                app_vars.solvemedia_challenge_key,
                'captchaForgotPassword',
                {multi: true, id: 'captchaForgotPassword'}
            );
        }

        if (app_vars.captcha_contact && $('#captchaContact').length) {
            captchaContact = ACPuzzle.create(
                app_vars.solvemedia_challenge_key,
                'captchaContact',
                {multi: true, id: 'captchaContact'}
            );
        }
    }

};

var onloadRecaptchaCallback = function () {
    if (app_vars.recaptcha_v3_article && app_vars.recaptcha_v3_site_key) {
        CaptchaArticleScore = grecaptcha.render({
            'sitekey': app_vars.recaptcha_v3_site_key,
        });
    }

    if (!app_vars.captcha) {
        return true;
    }

    if (app_vars.captcha_type === 'recaptcha_v2_checkbox') {
        if (app_vars.captcha_login && $('#captchaLogin').length) {
            $('#login-form button[type=submit], #login-form input[type=submit]').attr('disabled', 'disabled');
            captchaLogin = grecaptcha.render('captchaLogin', {
                'sitekey': app_vars.recaptcha_v2_checkbox_site_key,
                'callback': function (response) {
                    $('#login-form button[type=submit], #login-form input[type=submit]').removeAttr('disabled');
                },
            });
        }

        if (app_vars.captcha_register && $('#captchaRegister').length) {
            $('#register-form button[type=submit], #register-form input[type=submit]').attr('disabled', 'disabled');
            captchaRegister = grecaptcha.render('captchaRegister', {
                'sitekey': app_vars.recaptcha_v2_checkbox_site_key,
                'callback': function (response) {
                    $('#register-form button[type=submit], #register-form input[type=submit]').removeAttr('disabled');
                },
            });
        }

        if (app_vars.captcha_forgot_password && $('#captchaForgotPassword').length) {
            $('#forgot-password-form button[type=submit], #forgot-password-form input[type=submit]').attr('disabled', 'disabled');
            captchaForgotPassword = grecaptcha.render('captchaForgotPassword', {
                'sitekey': app_vars.recaptcha_v2_checkbox_site_key,
                'callback': function (response) {
                    $('#forgot-password-form button[type=submit], #forgot-password-form input[type=submit]').removeAttr('disabled');
                },
            });
        }

        if (app_vars.captcha_contact && $('#captchaContact').length) {
            $('#contact-form button[type=submit], #contact-form input[type=submit]').attr('disabled', 'disabled');
            captchaContact = grecaptcha.render('captchaContact', {
                'sitekey': app_vars.recaptcha_v2_checkbox_site_key,
                'callback': function (response) {
                    $('#contact-form button[type=submit], #contact-form input[type=submit]').removeAttr('disabled');
                },
            });
        }
    }

    if (app_vars.captcha_type === 'recaptcha_v2_invisible') {
        if (app_vars.captcha_login && $('#captchaLogin').length) {
            invisibleCaptchaSignin = grecaptcha.render('captchaLogin', {
                'sitekey': app_vars.recaptcha_v2_invisible_site_key,
                'size': 'invisible',
                'callback': function (response) {
                    $('#login-form').submit();
                },
            });

            $('#login-form').submit(function (event) {
                if (!grecaptcha.getResponse(invisibleCaptchaSignin)) {
                    event.preventDefault(); //prevent form submit before captcha is completed
                    grecaptcha.execute(invisibleCaptchaSignin);
                }
            });
        }

        if (app_vars.captcha_register && $('#captchaRegister').length) {
            invisibleCaptchaSignup = grecaptcha.render('captchaRegister', {
                'sitekey': app_vars.recaptcha_v2_invisible_site_key,
                'size': 'invisible',
                'callback': function (response) {
                    $('#register-form').submit();
                },
            });

            $('#register-form').submit(function (event) {
                if (!grecaptcha.getResponse(invisibleCaptchaSignup)) {
                    event.preventDefault(); //prevent form submit before captcha is completed
                    grecaptcha.execute(invisibleCaptchaSignup);
                }
            });
        }

        if (app_vars.captcha_forgot_password && $('#captchaForgotPassword').length) {
            invisibleCaptchaForgotpassword = grecaptcha.render(
                'captchaForgotPassword',
                {
                    'sitekey': app_vars.recaptcha_v2_invisible_site_key,
                    'size': 'invisible',
                    'callback': function (response) {
                        $('#forgot-password-form').submit();
                    },
                }
            );

            $('#forgot-password-form').submit(function (event) {
                if (!grecaptcha.getResponse(invisibleCaptchaForgotpassword)) {
                    event.preventDefault(); //prevent form submit before captcha is completed
                    grecaptcha.execute(invisibleCaptchaForgotpassword);
                }
            });
        }

        if (app_vars.captcha_contact && $('#captchaContact').length) {
            invisibleCaptchaContact = grecaptcha.render('captchaContact', {
                'sitekey': app_vars.recaptcha_v2_invisible_site_key,
                'size': 'invisible',
                'callback': function (response) {
                    if (grecaptcha.getResponse(invisibleCaptchaContact)) {
                        $('#contact-form').addClass('captcha-done').submit();
                    }
                },
            });

            $('#contact-form').submit(function (event) {
                if (!grecaptcha.getResponse(invisibleCaptchaContact)) {
                    event.preventDefault(); //prevent form submit before captcha is completed
                    grecaptcha.execute(invisibleCaptchaContact);
                }
            });
        }
    }

};

/**
 * Ads JS
 */
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = 'expires=' + d.toUTCString();
    document.cookie = cname + '=' + cvalue + ';' + expires + ';path=/';
}

function getCookie(cname) {
    var name = cname + '=';
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return '';
}

document.cookie = 'ab=0; path=/';

function checkAdblockUser() {
    //alert('Begin adblock check');
    if (getCookie('ab') === '1') {
        //alert('No adblock check');
        return;
    }
    document.cookie = 'ab=2; path=/';

    var adBlock = $('#ad-banner');

    if (adBlock.filter(':visible').length === 0 ||
        adBlock.filter(':hidden').length > 0 ||
        adBlock.height() === 0) {
        document.cookie = 'ab=1; path=/';
        /**
         * Force disable adblocker
         */
        if (app_vars.force_disable_adblock) {
            var adblock_message = '<div class="alert alert-danger" style="display: inline-block;">' +
                app_vars.please_disable_adblock + '</div>';

            $('.article-content').replaceWith(adblock_message);
        }
    }
    //alert('End adblock check');
}

function checkAdsbypasserUser() {
    //alert('Begin Adsbypasser check');
    if (getCookie('ab') === '1') {
        //alert('No Adsbypasser check');
        return;
    }
    var ads_bypassers = ['AdsBypasser', 'SafeBrowse'];
    var word = document.title.split(' ').splice(-1)[0];
    document.cookie = 'ab=2; path=/';
    if (ads_bypassers.indexOf(word) >= 0) {
        document.cookie = 'ab=1; path=/';
    }
    //alert('End Adsbypasser check');
}

function checkPrivateMode() {
    if (typeof Promise === 'function') {
        new Promise(function (resolve) {
            var db,
                on = function () {
                    resolve(true);
                },
                off = function () {
                    resolve(false);
                },
                tryls = function tryls() {
                    try {
                        localStorage.length
                            ? off()
                            : (localStorage.x = 1, localStorage.removeItem('x'), off());
                    } catch (e) {
                        // Safari only enables cookie in private mode
                        // if cookie is disabled then all client side storage is disabled
                        // if all client side storage is disabled, then there is no point
                        // in using private mode
                        navigator.cookieEnabled ? on() : off();
                    }
                };

            // Blink (chrome & opera)
            window.webkitRequestFileSystem
                ? webkitRequestFileSystem(0, 0, off, on)
                // FF
                : 'MozAppearance' in document.documentElement.style
                ? (db = indexedDB.open(
                    'test'
                ), db.onerror = on, db.onsuccess = off)
                // Safari
                : /constructor/i.test(window.HTMLElement)
                    ? tryls()
                    // IE10+ & edge
                    : !window.indexedDB &&
                    (window.PointerEvent || window.MSPointerEvent)
                        ? on()
                        // Rest
                        : off();
        }).then(function (isPrivateMode) {
            //alert('Begin Promise check');
            if (getCookie('ab') === '1') {
                //alert('No Promise check');
                return;
            }
            document.cookie = 'ab=2; path=/';
            if (isPrivateMode) {
                document.cookie = 'ab=1; path=/';
            }
            //alert('End Promise check');
        });
    }
}

document.cookie = 'av=0; path=/';
$(document).on('scroll.reader', function (event) {
    var article_end = $('.article-content > :last-child');
    if (article_end.isOnScreen()) {
        document.cookie = 'av=1; path=/';
        //article_end.css('color', 'lime');
        $(this).off('scroll.reader');
    }
});

checkPrivateMode();

$(window).on('load.checkAdblockers', function (e) {
    checkAdsbypasserUser();

    window.setTimeout(function () {
        checkAdblockUser();
    }, 1000);
});

$(document).on('DOMContentLoaded.counter', function (e) {
    window.setTimeout(function () {
        if (typeof read_time !== 'undefined') {
            var time = read_time * 1000,
                delta = 1000,
                tid;

            tid = setInterval(function () {
                if (window.blurred) {
                    return;
                }
                time -= delta;
                //console.log(time / 1000);
                if (time <= 0) {
                    clearInterval(tid);

                    $('#view-form').addClass('view-form');

                    if ($('body').hasClass('article-show') && app_vars.recaptcha_v3_article && app_vars.recaptcha_v3_site_key) {
                        recaptchav3_run();
                    } else {
                        $('#view-form.view-form').submit();
                    }
                }
            }, delta);
        }
    }, 500);

    window.onblur = function () {
        window.blurred = true;
    };
    window.onfocus = function () {
        window.blurred = false;
    };

});

function recaptchav3_run() {
    // https://stackoverflow.com/a/50749773/1794834
    // https://developers.google.com/recaptcha/docs/v3
    grecaptcha.ready(function () {
        // do request for recaptcha token
        // response is promise with passed token
        grecaptcha.execute(CaptchaArticleScore, {action: 'articleShow'}).then(function (token) {
            // add token to form
            var show_form = $('#view-form.view-form');

            show_form.prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
            show_form.prepend('<input type="hidden" name="g-recaptcha-action" value="articleShow">');

            show_form.submit();
        });
    });
}

/**
 * Report invalid link
 */
$('#view-form').one('submit.counterSubmit', function (e) {
    e.preventDefault();
    var goForm = $(this);

    if (!goForm.hasClass('view-form')) {
        return;
    }

    var submitButton = goForm.find('button');

    $.ajax({
        dataType: 'json', // The type of data that you're expecting back from the server.
        type: 'POST', // he HTTP method to use for the request
        url: goForm.attr('action'),
        data: goForm.serialize(), // Data to be sent to the server.
        beforeSend: function (xhr) {
            submitButton.attr('disabled', 'disabled');
        },
        success: function (result, status, xhr) {
        },
        error: function (xhr, status, error) {
            console.log('An error occurred: ' + xhr.status + ' ' + xhr.statusText);
        },
        complete: function (xhr, status) {
        },
    });
});

function cookie_accept() {
    var cookie_html = '<div id="cookie-pop"><div class="container-fluid"><div class="d-flex align-items-center">' +
        '<div class="cookie-message">' + app_vars.cookie_message + '</div>' +
        '<div class="cookie-confirm">' +
        '<button id="got-cookie" class="btn btn-light" type="submit">' + app_vars.cookie_button + '</button>' +
        '</div>' +
        '</div></div></div>';

    $('body').append(cookie_html);
}

if (app_vars.cookie_notification_bar) {
    if (getCookie('cookieLaw') === '') {
        cookie_accept();

        $('#cookie-pop').show();

        $('#got-cookie').click(function () {
            setCookie('cookieLaw', 'got_it', 365);
            $('#cookie-pop').remove();
        });
    }
}

$(document).ready(function () {

    var url = window.location.href;
    $('.member-menu a').filter(function () {
        return this.href === url;
        //}).parents('.member-menu li').addClass('active');
    }).addClass('selected');

    $('.carousel-loop').owlCarousel({
        center: true,
        items: 2,
        nav: false,
        dots: false,
        loop: true,
        margin: 0,
        //autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        // http://owlcarousel2.github.io/OwlCarousel2/demos/responsive.html
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            },
            1200: {
                items: 5
            }
        },
    });

    /*
     * Stick Main Element
     */

    $('.sticky-element > .col-inner').stickUp({
        keepInWrapper: true,
        topMargin: $("nav.sticky-top").outerHeight() + 25,
        wrapperSelector: ".row",
        disableOn: function () {
            if ($(window).width() < 768) {
                return false;
            }
            return true;
        }
    });
});

/**
 * Load recaptcha/invisible-recaptcha captcha script
 */
if (
    ['recaptcha_v2_checkbox', 'recaptcha_v2_invisible'].indexOf(app_vars.captcha_type) !== -1 ||
    ($('body').hasClass('article-show') && app_vars.recaptcha_v3_article && app_vars.recaptcha_v3_site_key)
) {
    var recaptcha_script = document.createElement('script');
    recaptcha_script.src = "https://www.recaptcha.net/recaptcha/api.js?onload=onloadRecaptchaCallback&render=explicit";
    recaptcha_script.async = true;
    recaptcha_script.defer = true;
    document.body.appendChild(recaptcha_script);
}

/**
 * Load SolveMedia captcha script
 */
if (app_vars.captcha_type === 'solvemedia') {
    var script_solvemedia = document.createElement('script');
    script_solvemedia.type = 'text/javascript';

    if (location.protocol === 'https:') {
        script_solvemedia.src = 'https://api-secure.solvemedia.com/papi/challenge.ajax';
    } else {
        script_solvemedia.src = 'http://api.solvemedia.com/papi/challenge.ajax';
    }
    document.body.appendChild(script_solvemedia);
}

function spinner_html(spinner) {
    spinner = typeof spinner !== 'undefined' ? spinner : 'spinner-1';

    var spinner_html = '';
    switch (spinner) {
        case 'spinner-1':
            spinner_html = '<div class="spinner spinner1"></div>';
            break;
        case 'spinner-2':
            spinner_html = '<div class="spinner spinner2">' +
                '<div class="double-bounce1"></div>' +
                '<div class="double-bounce2"></div>' +
                '</div>';
            break;
        case 'spinner-3':
            spinner_html = '<div class="spinner spinner3">' +
                '<div class="rect1"></div>' +
                '<div class="rect2"></div>' +
                '<div class="rect3"></div>' +
                '<div class="rect4"></div>' +
                '<div class="rect5"></div>' +
                '</div>';
            break;
        case 'spinner-4':
            spinner_html = '<div class="spinner spinner4">' +
                '<div class="cube1"></div>' +
                '<div class="cube2"></div>' +
                '</div>';
            break;
        case 'spinner-5':
            spinner_html = '<div class="spinner spinner5"></div>';
            break;
        case 'spinner-6':
            spinner_html = '<div class="spinner spinner6">' +
                '<div class="dot1"></div>' +
                '<div class="dot2"></div>' +
                '</div>';
            break;
        case 'spinner-7':
            spinner_html = '<div class="spinner spinner7">' +
                '<div class="bounce1"></div>' +
                '<div class="bounce2"></div>' +
                '<div class="bounce3"></div>' +
                '</div>';
            break;
        case 'spinner-8':
            spinner_html = '<div class="spinner spinner8">' +
                '<div class="sk-circle1 sk-child"></div>' +
                '<div class="sk-circle2 sk-child"></div>' +
                '<div class="sk-circle3 sk-child"></div>' +
                '<div class="sk-circle4 sk-child"></div>' +
                '<div class="sk-circle5 sk-child"></div>' +
                '<div class="sk-circle6 sk-child"></div>' +
                '<div class="sk-circle7 sk-child"></div>' +
                '<div class="sk-circle8 sk-child"></div>' +
                '<div class="sk-circle9 sk-child"></div>' +
                '<div class="sk-circle10 sk-child"></div>' +
                '<div class="sk-circle11 sk-child"></div>' +
                '<div class="sk-circle12 sk-child"></div>' +
                '</div>';
            break;
        case 'spinner-9':
            spinner_html = '<div class="spinner spinner9">' +
                '<div class="sk-cube sk-cube1"></div>' +
                '<div class="sk-cube sk-cube2"></div>' +
                '<div class="sk-cube sk-cube3"></div>' +
                '<div class="sk-cube sk-cube4"></div>' +
                '<div class="sk-cube sk-cube5"></div>' +
                '<div class="sk-cube sk-cube6"></div>' +
                '<div class="sk-cube sk-cube7"></div>' +
                '<div class="sk-cube sk-cube8"></div>' +
                '<div class="sk-cube sk-cube9"></div>' +
                '</div>';
            break;
        case 'spinner-10':
            spinner_html = '<div class="spinner spinner10">' +
                '<div class="sk-circle1 sk-circle"></div>' +
                '<div class="sk-circle2 sk-circle"></div>' +
                '<div class="sk-circle3 sk-circle"></div>' +
                '<div class="sk-circle4 sk-circle"></div>' +
                '<div class="sk-circle5 sk-circle"></div>' +
                '<div class="sk-circle6 sk-circle"></div>' +
                '<div class="sk-circle7 sk-circle"></div>' +
                '<div class="sk-circle8 sk-circle"></div>' +
                '<div class="sk-circle9 sk-circle"></div>' +
                '<div class="sk-circle10 sk-circle"></div>' +
                '<div class="sk-circle11 sk-circle"></div>' +
                '<div class="sk-circle12 sk-circle"></div>' +
                '</div>';
            break;
        case 'spinner-11':
            spinner_html = '<div class="spinner spinner11">' +
                '<div class="sk-cube1 sk-cube"></div>' +
                '<div class="sk-cube2 sk-cube"></div>' +
                '<div class="sk-cube4 sk-cube"></div>' +
                '<div class="sk-cube3 sk-cube"></div>' +
                '</div>';
            break;
    }

    return spinner_html;
}

$(document).on(
    'click',
    '.block-cats a.nav-cat,' +
    '.block .mna-nav-next-prev,' +
    '.block .mna-nav-load-more,' +
    '.block .mna-nav-show-more,' +
    '.block .pagination li a',
    function (event) {
        event.preventDefault();

        var $this = $(this);
        var block = $this.closest('.block');

        var action = block.attr('data-action');
        var pagination = block.attr('data-pagination');
        var spinner = spinner_html(block.attr('data-spinner'));
        var current_page = parseInt(block.attr('data-currentPage'));

        var target_page = 1;

        var category_change = false;

        if ($this.attr('data-category')) {
            block.attr('data-cats', $this.attr('data-category'));
            category_change = true;
        }

        /**
         * Pagination: next-prev
         */
        if (false === category_change && 'next-prev' === pagination) {
            if ($this.hasClass('disabled')) {
                return;
            }

            target_page = parseInt($this.attr('data-page'));
        }

        /**
         * Pagination: load-more
         */
        if (false === category_change && 'load-more' === pagination) {
            if ($this.hasClass('disabled')) {
                return;
            }

            target_page = current_page + 1;
        }

        /**
         * Pagination: show-more
         */
        if (false === category_change && 'show-more' === pagination) {
            if ($this.hasClass('disabled')) {
                return;
            }

            target_page = current_page + 1;
        }

        /**
         * Pagination: numeric
         */
        if (false === category_change && 'numeric' === pagination) {
            if ($this.hasClass('disabled')) {
                return;
            }

            target_page = parseInt($this.attr('data-page'));
        }

        $.ajax(
            {
                url: app_vars.ajax_element_url,
                type: 'get',
                data: {
                    element: action,
                    per_page: parseInt(block.attr('data-perPage')),
                    cats: block.attr('data-cats'),
                    excerpt: block.attr('data-summaryLength'),
                    pagination: pagination,
                    page: target_page,
                    orderby: block.attr('data-orderBy'),
                    order: block.attr('data-order'),
                },
                beforeSend: function (xhr, opts) {
                    var loaded_pages = block.attr('data-loadedPages').split(',').map(function (x) {
                        return parseInt(x);
                    });

                    block.find('.block-content').append('<div class="spinner-container">' + spinner + '</div>');

                    if (false === category_change &&
                        loaded_pages.indexOf(target_page) > -1) {
                        this.navigation();
                        xhr.abort();
                    }
                },
                success: function (html, status, xhr) {
                    var new_html = $(html);

                    if (false === category_change) {
                        block.attr('data-loadedPages', block.attr('data-loadedPages') + ',' + target_page);
                    }

                    if (true === category_change) {
                        block.attr('data-loadedPages', 1);
                        block.find('.block-content').empty();
                    }

                    block.find('.block-content').append(new_html.find('.block-content').html());
                    this.navigation();
                },
                error: function (xhr, status, error) {
                    alert('An error occurred: ' + xhr.status + ' ' + xhr.statusText);
                },
                complete: function (xhr, status) {
                },
                navigation: function () {

                    block.attr('data-currentPage', target_page);

                    /**
                     * Pagination: next-prev
                     */
                    if ('next-prev' === pagination) {
                        block.find('[data-loadedPage]').hide();
                        block.find('[data-loadedPage="' + target_page + '"]').show();
                    }

                    /**
                     * Pagination: load-more
                     */
                    if ('load-more' === pagination) {
                    }

                    /**
                     * Pagination: show-more
                     */
                    if ('show-more' === pagination) {
                        block.find('[data-loadedPage]').hide();
                        block.find('[data-loadedPage="' + target_page + '"]').show();
                    }

                    /**
                     * Pagination: numeric
                     */
                    if ('numeric' === pagination) {
                        block.find('[data-loadedPage]').hide();
                        block.find('[data-loadedPage="' + target_page + '"]').show();
                    }

                    block.find('.spinner-container').remove();

                },
            }
        );
    }
);


$(document).on('click', '.reply-add', function (event) {
    event.preventDefault();
    $(this).closest('.display-comment').find(".reply-form:first").css("display", "block");
});

$('.newsletter-subscribe').on('submit', function (e) {
    e.preventDefault();

    var form = $(this);

    var submitButton = form.find('input[type="submit"]');

    $.ajax({
        dataType: 'json', // The type of data that you're expecting back from the server.
        type: 'POST', // The HTTP method to use for the request
        url: form.attr('action'),
        data: form.serialize(), // Data to be sent to the server.
        beforeSend: function (xhr) {
            submitButton.attr('disabled', 'disabled');
        },
        success: function (result, status, xhr) {
            if (result.status) {
            }
            alert(result.message);
        },
        error: function (xhr, status, error) {
            console.log('An error occurred: ' + xhr.status + ' ' + xhr.statusText);
        },
        complete: function (xhr, status) {
            submitButton.attr('disabled', false);
        },
    });
});

$('.search-menu-item').on('click', 'a.nav-link', function (event) {
    event.preventDefault();

    //var search_menu_item = $(this).parent('.search-menu-item');
    // OR
    var search_menu_item = $(event.delegateTarget);

    search_menu_item.toggleClass('show-search-form');

    if (search_menu_item.hasClass('show-search-form')) {
        setTimeout(function () {
            search_menu_item.find('input[type=search]').focus();
        }, 500); // 500 means after CSS transition complete
    }
});

$(function () {
    $('.toast').toast('show');

    if (typeof selectionSharer === "function") {
        $('.article-show .article-content').selectionSharer();
    }

    $('[data-toggle="tooltip"]').tooltip();
});
