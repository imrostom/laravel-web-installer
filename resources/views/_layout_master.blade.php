<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ trans('LaravelWebInstaller::installer_messages.title') }}</title>

        <link rel="icon" type="image/png" href="{{ asset('vendor/laravel-web-installer/img/favicon/favicon-16x16.png') }}" sizes="16x16"/>
        <link rel="icon" type="image/png" href="{{ asset('vendor/laravel-web-installer/img/favicon/favicon-32x32.png') }}" sizes="32x32"/>
        <link rel="icon" type="image/png" href="{{ asset('vendor/laravel-web-installer/img/favicon/favicon-96x96.png') }}" sizes="96x96"/>

        <link href="{{ asset('vendor/laravel-web-installer/css/style.min.css') }}" rel="stylesheet"/>
    </head>
    <body>
        <div class="master">
            <div class="box">
                <div class="header">
                    <h1 class="header__title">@yield('title')</h1>
                </div>
                <ul class="step">
                    <li class="step__divider"></li>
                    <li class="step__item {{ isActive('LaravelWebInstaller::final') }}">
                        <i class="step__icon fa fa-server" aria-hidden="true"></i>
                    </li>
                    <li class="step__divider"></li>
                    <li class="step__item {{ isActive('LaravelWebInstaller::environment')}} {{ isActive('LaravelWebInstaller::environmentWizard')}} {{ isActive('LaravelWebInstaller::environmentClassic')}}">
                        @if(Request::is('install/environment') || Request::is('install/environment') )
                            <a href="{{ route('LaravelWebInstaller::environment') }}">
                                <i class="step__icon fa fa-cog" aria-hidden="true"></i>
                            </a>
                        @else
                            <i class="step__icon fa fa-cog" aria-hidden="true"></i>
                        @endif
                    </li>
                    <li class="step__divider"></li>
                    <li class="step__item {{ isActive('LaravelWebInstaller::verify') }}">
                        @if(Request::is('install/verify') || Request::is('install/environment') )
                            <a href="{{ route('LaravelWebInstaller::verify') }}">
                                <i class="step__icon fa fa-check-circle"></i>
                            </a>
                        @else
                            <i class="step__icon fa fa-check-circle"></i>
                        @endif
                    </li>
                    <li class="step__divider"></li>
                    <li class="step__item {{ isActive('LaravelWebInstaller::permissions') }}">
                        @if(Request::is('install/permissions') || Request::is('install/verify') || Request::is('install/environment') )
                            <a href="{{ route('LaravelWebInstaller::permissions') }}">
                                <i class="step__icon fa fa-key" aria-hidden="true"></i>
                            </a>
                        @else
                            <i class="step__icon fa fa-key" aria-hidden="true"></i>
                        @endif
                    </li>
                    <li class="step__divider"></li>
                    <li class="step__item {{ isActive('LaravelWebInstaller::requirement') }}">
                        @if(Request::is('install/requirement') || Request::is('install/permissions') || Request::is('install/verify') || Request::is('install/environment') )
                            <a href="{{ route('LaravelWebInstaller::requirement') }}">
                                <i class="step__icon fa fa-list" aria-hidden="true"></i>
                            </a>
                        @else
                            <i class="step__icon fa fa-list" aria-hidden="true"></i>
                        @endif
                    </li>
                    <li class="step__divider"></li>
                    <li class="step__item {{ isActive('LaravelWebInstaller::welcome') }}">
                        @if(Request::is('install') || Request::is('install/requirement') || Request::is('install/permissions') || Request::is('install/verify') || Request::is('install/environment') )
                            <a href="{{ route('LaravelWebInstaller::welcome') }}">
                                <i class="step__icon fa fa-home" aria-hidden="true"></i>
                            </a>
                        @else
                            <i class="step__icon fa fa-home" aria-hidden="true"></i>
                        @endif
                    </li>
                    <li class="step__divider"></li>
                </ul>
                <div class="main">
                    @if (session('message'))
                        <p class="alert text-center">
                            <strong>
                                @if(is_array(session('message')))
                                    {{ session('message')['message'] }}
                                @else
                                    {{ session('message') }}
                                @endif
                            </strong>
                        </p>
                    @endif
                    @if(session()->has('errors'))
                        <div class="alert alert-danger" id="error_alert">
                            <button type="button" class="close" id="close_alert" data-dismiss="alert" aria-hidden="true">
                                 <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                            <p>
                                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                {{ trans('LaravelWebInstaller::installer_messages.forms.errorTitle') }}
                            </p>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @yield('container')
                </div>
            </div>
        </div>
        @yield('scripts')
        <script type="text/javascript">
            const x = document.getElementById('error_alert');
            const y = document.getElementById('close_alert');
            y.onclick = function() {
                x.style.display = "none";
            };
        </script>
    </body>
</html>
