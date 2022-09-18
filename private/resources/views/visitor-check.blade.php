<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ get_option('language_direction', 'ltr') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow"/>
    <title>{{ __('Just a moment...') }}</title>
    <link href='{{ asset(get_style('favicon', '/favicon.ico')) }}' type='image/x-icon' rel='icon'/>
    <link href='{{ asset(get_style('favicon', '/favicon.ico')) }}' type='image/x-icon' rel='shortcut icon'/>
    <style>
        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #ffffff;
            font-family: Helvetica, Arial, sans-serif;
            font-size: 100%;
        }

        table {
            width: 100%;
            height: 100%;
        }

        td {
            vertical-align: middle;
            text-align: center;
            padding: 20px;
        }

        h1 {
            font-size: 1.5em;
            color: #404040;
            text-align: center;
        }

        p {
            font-size: 1em;
            color: #404040;
            text-align: center;
            margin: 10px 0 0 0;
        }


        .spinner3 div {
            background-color: #151515 !important;
        }

        .spinner-container {
        }

        .spinner {
            position: relative;
        }

        .spinner3 {
            margin: 0 auto;
            width: 65px;
            height: 40px;
            text-align: center;
            font-size: 10px;
        }

        .spinner3 > div {
            height: 100%;
            width: 6px;
            margin: 0 2px 0 0;
            display: inline-block;
            -webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;
            animation: sk-stretchdelay 1.2s infinite ease-in-out;
        }

        .spinner3 .rect2 {
            -webkit-animation-delay: -1.1s;
            animation-delay: -1.1s;
        }

        .spinner3 .rect3 {
            -webkit-animation-delay: -1.0s;
            animation-delay: -1.0s;
        }

        .spinner3 .rect4 {
            -webkit-animation-delay: -0.9s;
            animation-delay: -0.9s;
        }

        .spinner3 .rect5 {
            -webkit-animation-delay: -0.8s;
            animation-delay: -0.8s;
        }

        @-webkit-keyframes sk-stretchdelay {
            0%, 40%, 100% {
                -webkit-transform: scaleY(0.4);
            }
            20% {
                -webkit-transform: scaleY(1);
            }
        }

        @keyframes sk-stretchdelay {
            0%, 40%, 100% {
                transform: scaleY(0.4);
                -webkit-transform: scaleY(0.4);
            }
            20% {
                transform: scaleY(1);
                -webkit-transform: scaleY(1);
            }
        }

    </style>
</head>
<body>

<table>
    <tr>
        <td>
            <div class="spinner-container">
                <div class="spinner spinner3">
                    <div class="rect1"></div>
                    <div class="rect2"></div>
                    <div class="rect3"></div>
                    <div class="rect4"></div>
                    <div class="rect5"></div>
                </div>
            </div>

            <h1>{{ __('Checking your browser before accessing the website') }}</h1>
            <p>{{ __('This process is automatic. your browser will redirect to your requested content shortly.') }}</p>
            <p>{{ __('Please allow up to 5 seconds...') }}</p>
        </td>
    </tr>
</table>

<form id="visitorCheck" action="{{ route('visitor-check') }}" style="display: none;">@csrf</form>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>

@include('_partials.js_vars')

<script>
    var visitorCheckForm = $('#visitorCheck');

    function visitorCheckProcess() {
        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: visitorCheckForm.attr('action'),
            data: visitorCheckForm.serialize(),
            success: function (result, status, xhr) {
                location.reload();
            },
            error: function (xhr, status, error) {
                alert('An error occurred: ' + xhr.status + ' ' + xhr.statusText);
            },
        });
    }

    if (app_vars.recaptcha_v3_site_key) {
        var recaptcha_script = document.createElement('script');
        recaptcha_script.src = "https://www.recaptcha.net/recaptcha/api.js?onload=onloadRecaptchaCallback&render=explicit";
        recaptcha_script.async = true;
        recaptcha_script.defer = true;
        document.body.appendChild(recaptcha_script);

        var CheckVisitorScore;

        var onloadRecaptchaCallback = function () {
            CheckVisitorScore = grecaptcha.render({
                'sitekey': app_vars.recaptcha_v3_site_key,
            });

            grecaptcha.ready(function () {
                grecaptcha.execute(CheckVisitorScore, {action: 'visitorCheck'}).then(function (token) {
                    visitorCheckForm.prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
                    visitorCheckForm.prepend('<input type="hidden" name="g-recaptcha-action" value="visitorCheck">');

                    visitorCheckProcess();
                });
            });
        };
    } else {
        visitorCheckProcess();
    }
</script>
</body>
</html>
