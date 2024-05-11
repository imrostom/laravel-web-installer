@extends('LaravelWebInstaller::_layout_master')

@section('template_title')
    {{ trans('LaravelWebInstaller::installer_messages.final.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-flag-checkered fa-fw" aria-hidden="true"></i>
    {{ trans('LaravelWebInstaller::installer_messages.final.title') }}
@endsection

@section('container')

	<p><strong><small>{{ trans('LaravelWebInstaller::installer_messages.final.console') }}</small></strong></p>
	<p style="background: #000; padding: 5px 8px; color: #fff; border-radius: 5px; font-weight: 500">{{ $finalMessages }}</p>

	<p><strong><small>{{ trans('LaravelWebInstaller::installer_messages.final.log') }}</small></strong></p>
	<p style="background: #000; padding: 5px 8px; color: #fff; border-radius: 5px; font-weight: 500">{{ $finalStatusMessage }}</p>

    <p><strong>{{ __('System Admin Login information') }}</strong></p>
    <hr>
    <p><strong>{{ __('Email : admin@example.com') }}</strong></p>
    <p><strong>{{ __('Password : 123456') }}</strong></p>
    <p><strong>{{ __('You can change your information after login admin panel.') }}</strong></p>


    <div class="buttons">
        <a href="{{ url('/') }}" class="button">{{ trans('LaravelWebInstaller::installer_messages.final.exit') }}</a>
    </div>

@endsection
