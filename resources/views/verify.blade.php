@extends('LaravelWebInstaller::_layout_master')

@section('template_title')
    {{ trans('LaravelWebInstaller::installer_messages.verify.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-magic fa-fw" aria-hidden="true"></i>
    {!! trans('LaravelWebInstaller::installer_messages.verify.title') !!}
@endsection

@section('container')
    <form method="post" action="{{ route('LaravelWebInstaller::verify.check') }}">
        @csrf
        <div class="form-group {{ $errors->has('purchase_code') ? ' has-error ' : '' }}">
            <label for="purchase_code">
                {{ trans('LaravelWebInstaller::installer_messages.verify.purchase_code_label') }}
            </label>
            <input type="text" name="purchase_code" value="{{ old('purchase_code') }}" id="purchase_code" placeholder="{{ trans('LaravelWebInstaller::installer_messages.verify.purchase_code_placeholder') }}" />
            @if ($errors->has('purchase_code'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('purchase_code') }}
                </span>
            @endif
        </div>
        <div class="buttons">
            <button class="button">
                {{ trans('LaravelWebInstaller::installer_messages.verify.next') }}
                <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
            </button>
        </div>
    </form>
@endsection