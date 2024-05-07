@extends('LaravelWebInstaller::_layout_master')

@section('template_title')
    {{ trans('LaravelWebInstaller::installer_messages.environment.wizard.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-magic fa-fw" aria-hidden="true"></i>
    {!! trans('LaravelWebInstaller::installer_messages.environment.wizard.title') !!}
@endsection

@section('container')
    <div class="tabs tabs-full">
        <input id="tab1" type="radio" name="tabs" class="tab-input" checked />
        <label for="tab1" class="tab-label">
            <i class="fa fa-cog fa-2x fa-fw" aria-hidden="true"></i>
            <br />
            {{ trans('LaravelWebInstaller::installer_messages.environment.wizard.tabs.environment') }}
        </label>

        <input id="tab2" type="radio" name="tabs" class="tab-input" />
        <label for="tab2" class="tab-label">
            <i class="fa fa-database fa-2x fa-fw" aria-hidden="true"></i>
            <br />
            {{ trans('LaravelWebInstaller::installer_messages.environment.wizard.tabs.database') }}
        </label>

        <form method="post" action="{{ route('LaravelWebInstaller::environment.save') }}" class="tabs-wrap">
            <div class="tab" id="tab1content">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group {{ $errors->has('app_name') ? ' has-error ' : '' }}">
                    <label for="app_name">
                        {{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.app_name_label') }}
                    </label>
                    <input type="text" name="app_name" id="app_name" value="{{ old('app_name', config('app.name')) }}" placeholder="{{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.app_name_placeholder') }}" />
                    @if ($errors->has('app_name'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('app_name') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('environment') ? ' has-error ' : '' }}">
                    <label for="environment">
                        {{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.app_environment_label') }}
                    </label>
                    <select name="environment" id="environment" onchange='checkEnvironment(this.value);'>
                        <option value="local" selected>{{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.app_environment_label_local') }}</option>
                        <option value="development">{{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.app_environment_label_developement') }}</option>
                        <option value="production">{{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.app_environment_label_production') }}</option>
                    </select>
                    @if ($errors->has('environment'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('environment') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('app_debug') ? ' has-error ' : '' }}">
                    <label for="app_debug">
                        {{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.app_debug_label') }}
                    </label>
                    <label for="app_debug_true">
                        <input type="radio" name="app_debug" id="app_debug_true" value="true" />
                        {{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.app_debug_label_true') }}
                    </label>
                    <label for="app_debug_false">
                        <input type="radio" name="app_debug" id="app_debug_false" value="false" checked />
                        {{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.app_debug_label_false') }}
                    </label>
                    @if ($errors->has('app_debug'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('app_debug') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('app_log_level') ? ' has-error ' : '' }}">
                    <label for="app_log_level">
                        {{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.app_log_level_label') }}
                    </label>
                    <select name="app_log_level" id="app_log_level">
                        <option value="debug" selected>{{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.app_log_level_label_debug') }}</option>
                        <option value="info">{{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.app_log_level_label_info') }}</option>
                        <option value="notice">{{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.app_log_level_label_notice') }}</option>
                        <option value="warning">{{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.app_log_level_label_warning') }}</option>
                        <option value="error">{{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.app_log_level_label_error') }}</option>
                        <option value="critical">{{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.app_log_level_label_critical') }}</option>
                        <option value="alert">{{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.app_log_level_label_alert') }}</option>
                        <option value="emergency">{{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.app_log_level_label_emergency') }}</option>
                    </select>
                    @if ($errors->has('app_log_level'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('app_log_level') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('app_url') ? ' has-error ' : '' }}">
                    <label for="app_url">
                        {{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.app_url_label') }}
                    </label>
                    <input type="url" name="app_url" id="app_url" value="{{ url('/') }}" placeholder="{{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.app_url_placeholder') }}" />
                    @if ($errors->has('app_url'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('app_url') }}
                        </span>
                    @endif
                </div>

                <div class="buttons">
                    <button class="button" onclick="showDatabaseSettings();return false">
                        {{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.buttons.setup_database') }}
                        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div class="tab" id="tab2content">

                <div class="form-group {{ $errors->has('database_connection') ? ' has-error ' : '' }}">
                    <label for="database_connection">
                        {{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.db_connection_label') }}
                    </label>
                    <select name="database_connection" id="database_connection">
                        <option value="mysql" selected>{{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.db_connection_label_mysql') }}</option>
                        <option value="sqlite">{{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.db_connection_label_sqlite') }}</option>
                        <option value="pgsql">{{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.db_connection_label_pgsql') }}</option>
                        <option value="sqlsrv">{{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.db_connection_label_sqlsrv') }}</option>
                    </select>
                    @if ($errors->has('database_connection'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_connection') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_hostname') ? ' has-error ' : '' }}">
                    <label for="database_hostname">
                        {{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.db_host_label') }}
                    </label>
                    <input type="text" name="database_hostname" id="database_hostname" value="127.0.0.1" placeholder="{{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.db_host_placeholder') }}" />
                    @if ($errors->has('database_hostname'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_hostname') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_port') ? ' has-error ' : '' }}">
                    <label for="database_port">
                        {{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.db_port_label') }}
                    </label>
                    <input type="number" name="database_port" id="database_port" value="3306" placeholder="{{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.db_port_placeholder') }}" />
                    @if ($errors->has('database_port'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_port') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_name') ? ' has-error ' : '' }}">
                    <label for="database_name">
                        {{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.db_name_label') }}
                    </label>
                    <input type="text" name="database_name" id="database_name" value="" placeholder="{{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.db_name_placeholder') }}" />
                    @if ($errors->has('database_name'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_name') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_username') ? ' has-error ' : '' }}">
                    <label for="database_username">
                        {{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.db_username_label') }}
                    </label>
                    <input type="text" name="database_username" id="database_username" value="" placeholder="{{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.db_username_placeholder') }}" />
                    @if ($errors->has('database_username'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_username') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_password') ? ' has-error ' : '' }}">
                    <label for="database_password">
                        {{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.db_password_label') }}
                    </label>
                    <input type="password" name="database_password" id="database_password" value="" placeholder="{{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.db_password_placeholder') }}" />
                    @if ($errors->has('database_password'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_password') }}
                        </span>
                    @endif
                </div>

                <div class="buttons">
                    <button class="button" onclick="showApplicationSettings();return false">
                        {{ trans('LaravelWebInstaller::installer_messages.environment.wizard.form.buttons.setup_application') }}
                        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function checkEnvironment(val) {
            const element = document.getElementById('environment_text_input');
            if(val==='other') {
                element.style.display='block';
            } else {
                element.style.display='none';
            }
        }

        function showDatabaseSettings() {
            document.getElementById('tab2').checked = true;
        }
    </script>
@endsection
