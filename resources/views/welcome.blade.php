@extends('LaravelWebInstaller::_layout_master')

@section('template_title')
    {{ trans('LaravelWebInstaller::installer_messages.welcome.templateTitle') }}
@endsection

@section('title')
    {{ trans('LaravelWebInstaller::installer_messages.welcome.title') }}
@endsection

@section('container')
    <p class="text-center">
        {{ trans('LaravelWebInstaller::installer_messages.welcome.message') }}
    </p>

    <p class="text-center">
        <a href="{{ route('LaravelWebInstaller::requirement') }}" class="button">
            {{ trans('LaravelWebInstaller::installer_messages.welcome.next') }}
            <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
        </a>
    </p>
@endsection
