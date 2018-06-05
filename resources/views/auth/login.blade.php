@extends('backend.layouts.default')

@section('title')
    Login
@stop()

@section('content')
    <div class="mdl-cell mdl-cell--3-col" style="margin: auto; text-align: center;">
    <img class="platform-logo" src="{{  URL::asset('graphics/platform-logo.svg') }}" />
    </div>
    <div class="mdl-cell mdl-cell--9-col">
        <span class="mdl-layout__title">
            <h3>Sign in:</h3>
        </span>
        <div class="input-form-group login">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <label class="mdl-textfield__label" for="email">E-mail:</label>
                    <input id="email" type="email" class="mdl-textfield__input" value="{{ old('email') }}" required autofocus name="email" pattern=".+">
                    @if ($errors->has('email'))
                        <span class="mdl-textfield__error">Must be a valid email address!</span>
                    @endif
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <label class="mdl-textfield__label" for="password">Password:</label>
                    <input id="password" type="password" class="mdl-textfield__input" required name="password">
                    @if ($errors->has('password'))
                        <span class="mdl-textfield__error">Cannot be blank!</span>
                    @endif
                </div>
                <div class="mdl-layout-spacer"></div>
                <button id="login" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">Sign in</button>
            </form>
        </div>

    </div>
@stop()
