<!-- resources/views/auth/reset_password_success.blade.php -->
{{-- <!doctype html>
<html>
<head>
    <title>Reset Password Success</title>
</head>
<body>
    <h2>Reset Password Success</h2>

    <p>Your password has been successfully reset. You can now login with your new password.</p>

    <a href="/">Go to Login</a>
</body>
</html> --}}



<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta17
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Reset Password Success</title>
    <!-- CSS files -->
    <link href="{{ asset('tabler/dist/css/tabler.min.css?1674944402') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/dist/css/tabler-flags.min.css?1674944402') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/dist/css/tabler-payments.min.css?1674944402') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/dist/css/tabler-vendors.min.css?1674944402') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/dist/css/demo.min.css?1674944402') }}" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class=" d-flex flex-column">
    <script src="{{ asset('tabler/dist/js/demo-theme.min.js?1674944402') }}"></script>
    <div class="page page-center">
        <div class="container container-normal py-4">
            <div class="row align-items-center g-4">
                <div class="col-lg">
                    <div class="container-tight">
                        <div class="text-center mb-4">
                            <img src="{{ asset('tabler/static/e-simasfix.webp') }}"
                                style="width:150px; height:100px;border-radius:20px" alt="Tabler"
                                class="navbar-brand-image">

                        </div>
                        <div class="card card-md">
                            <div class="card-body">
                                <h2 class="h2 text-center mb-4">Reset Password Success</h2>
                                <p>Your password has been successfully reset. You can now login with your new password.
                                </p>
                                <a href="/" class="btn btn-primary">Go to Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ asset('tabler/dist/js/tabler.min.js?1674944402') }}" defer></script>
    <script src="{{ asset('tabler/dist/js/demo.min.js?1674944402') }}" defer></script>
</body>

</html>
