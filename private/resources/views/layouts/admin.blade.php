<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', e(get_option('site_name')) )</title>

    <link href='{{ asset(get_style('favicon', '/favicon.ico')) }}' type='image/x-icon' rel='icon'/>
    <link href='{{ asset(get_style('favicon', '/favicon.ico')) }}' type='image/x-icon' rel='shortcut icon'/>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.11.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.10/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.0.0-rc.4/dist/css/adminlte.min.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/gh/claviska/jquery-minicolors@2.3.4/jquery.minicolors.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/app.css?v=' . APP_VERSION) }}">

    @stack('header')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('member.dashboard') }}">{{ __('Member Area') }}</a>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-user-cog"></i>
                </a>
                <div class="dropdown-menu dropdown-menu dropdown-menu-right">
                    <a href="{{ route('member.settings') }}" class="dropdown-item">
                        <i class="far fa-user mr-2"></i> {{ __('My Settings') }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item">
                        <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Logout') }}
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ url('/') }}" target="_blank" class="brand-link text-center">
            <span class="brand-text font-weight-light">{{ get_option('site_name') }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p><?= __('Dashboard') ?></p></a></li>

                    <li class="nav-item has-treeview">
                        <a class="nav-link" href="#">
                            <i class="nav-icon far fa-file-alt"></i>
                            <p>
                                <?= __(' Articles') ?>
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.articles.index') }}">
                                    <i class="nav-icon fa fa-angle-right"></i>
                                    <p>{{ __('List') }}</p></a></li>
                            <li class="nav-item"><a class="nav-link"
                                                    href="{{ route('admin.articles.indexNewPending') }}">
                                    <i class="nav-icon fa fa-angle-right"></i>
                                    <p>{{ __('New Pending') }}</p></a></li>
                            <li class="nav-item"><a class="nav-link"
                                                    href="{{ route('admin.articles.indexUpdatePending') }}">
                                    <i class="nav-icon fa fa-angle-right"></i>
                                    <p><?= __('Update Pending') ?></p></a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.comments.index') }}">
                            <i class="nav-icon fas fa-comments"></i>
                            <p><?= __('Comments') ?></p></a></li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.categories.index') }}">
                            <i class="nav-icon fas fa-layer-group"></i>
                            <p><?= __('Categories') ?></p></a></li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.tags.index') }}">
                            <i class="nav-icon fa fa-tags"></i>
                            <p><?= __('Tags') ?></p></a></li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.pages.index') }}">
                            <i class="nav-icon far fa-copy"></i>
                            <p><?= __('Pages') ?></p></a></li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.files.index') }}">
                            <i class="nav-icon far fa-images"></i>
                            <p><?= __('Files') ?></p></a></li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.pages.homepage') }}">
                            <i class="nav-icon fa fa-table"></i>
                            <p><?= __('Home Page') ?></p></a></li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.menus.index') }}">
                            <i class="nav-icon far fa-caret-square-down"></i>
                            <p><?= __('Menus') ?></p></a></li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.sidebars.index') }}">
                            <i class="nav-icon fa fa-columns"></i>
                            <p><?= __('Sidebars') ?></p></a></li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.ads.index') }}">
                            <i class="nav-icon fas fa-ad"></i>
                            <p><?= __('Ads') ?></p></a></li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.prices') }}">
                            <i class="nav-icon fas fa-dollar-sign"></i>
                            <p>{{ __('Payout Rates') }}</p></a></li>

                    <li class="nav-item has-treeview">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i
                                class="nav-icon fas fa-hand-holding-usd"></i>
                            <p>
                                <?= __('Withdrawals') ?>
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.withdraws.index') }}">
                                    <i class="nav-icon fa fa-angle-right"></i>
                                    <p>{{ __('Requests') }}</p></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.withdraws.methods') }}">
                                    <i class="nav-icon fa fa-angle-right"></i>
                                    <p><?= __('Withdrawal Methods') ?></p></a></li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-users"></i>
                            <p>
                                <?= __('Users') ?>
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">
                                    <i class="nav-icon fa fa-angle-right"></i>
                                    <p><?= __('List') ?></p></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.create') }}">
                                    <i class="nav-icon fa fa-angle-right"></i>
                                    <p><?= __('Add') ?></p></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.referrals') }}">
                                    <i class="nav-icon fa fa-angle-right"></i>
                                    <p><?= __('Referrals') ?></p></a></li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fas fa-cogs"></i>
                            <p>
                                <?= __('Settings') ?>
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.options.index') }}">
                                    <i class="nav-icon fa fa-angle-right"></i>
                                    <p><?= __('Settings') ?></p></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.options.style') }}">
                                    <i class="nav-icon fa fa-angle-right"></i>
                                    <p><?= __('Styling') ?></p></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.language.index') }}">
                                    <i class="nav-icon fa fa-angle-right"></i>
                                    <p><?= __('Language Manager') ?></p></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.options.system') }}"
                                                    target="_blank">
                                    <i class="nav-icon fa fa-angle-right"></i>
                                    <p><?= __('System Info') ?></p></a></li>
                        </ul>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="mb-2 text-dark">@yield('title', e(get_option('site_name')) )</h1>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                @if (version_compare(PHP_VERSION, '7.2.0') < 0)
                    <div class="alert alert-danger" role="alert">
                        <?= __("PressFly will work only on PHP <b>7.2.0</b> or higher starting from the next update so please ask your hosting company to upgrade the PHP version as soon as possible.") ?>
                    </div>
                @endif

                @include('_partials.flash_message')

                @yield('content')

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            <span>{{ __('Version') }}</span> {{ APP_VERSION }}
        </div>
        <!-- Default to the left -->
        <strong>{{ __('Copyright') }} &copy; {{ now()->format("Y") }} {{ get_option('site_name') }}
            .</strong> {{ __('All rights reserved.') }}
    </footer>
</div>

<!-- Bootstrap and necessary plugins-->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-ui-dist@1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.10/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.0.0-rc.4/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/claviska/jquery-minicolors@2.3.4/jquery.minicolors.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/rguliev/conditionize2.js@2.0.0/jquery.conditionize2.min.js"></script>
<script src="{{ asset('assets/dashboard/js/app.js?v=' . APP_VERSION) }}"></script>

@stack('footer')

</body>
</html>
