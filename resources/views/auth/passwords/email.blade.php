@extends('backend.layouts.default')

@section('title')
    Password reset
@stop()

@section('content')
    <div class="mdl-cell mdl-cell--3-col" style="margin: auto; text-align: center;">
        <img class="platform-logo" src="{{  URL::asset('graphics/platform-logo.svg') }}" />
    </div>
    <div class="mdl-cell mdl-cell--9-col">
        <span class="mdl-layout__title">
            <h3>Reset password:</h3>
        </span>
        <div class="input-form-group email">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <label class="mdl-textfield__label" for="email">E-mail:</label>
                    <input id="email" type="email" class="mdl-textfield__input" value="{{ old('email') }}" required autofocus name="email" pattern=".+">
                    @if ($errors->has('email'))
                        <span class="mdl-textfield__error">Must be a valid email address!</span>
                    @endif
                </div>

                <div class="mdl-layout-spacer"></div>
                <button id="reset" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">{{ __('Send Password Reset Link') }}</button>
            </form>
        </div>
    </div>
@endsection
