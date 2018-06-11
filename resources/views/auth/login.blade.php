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
        @if($errors->count())
            <div class="error">
                <p>Following errors occurred:</p>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="input-form-group login">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <label class="mdl-textfield__label" for="email">E-mail:</label>
                    <input id="email" type="email" class="mdl-textfield__input" value="{{ old('email') }}" required name="email" pattern=".+">
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

                <a class="account-helper" id="register-link" href="/register"><span class="icon icon-vpn_key"></span> Register</a>
                <a class="account-helper" id="reset-password-link" href="/password/reset"><span class="icon icon-help_outline"></span> Forgot password?</a>

                <div class="mdl-layout-spacer"></div>
                <button id="login" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">Sign in</button>
            </form>
        </div>

    </div>
@stop()

@section('custom-style')
    <style>
        .account-helper {
            position: relative;
            top: -15px;
            text-decoration: none;
        }

        .account-helper > span {
            position: relative;
            top: 2px;
            font-size: 16px;
        }

        #reset-password-link {
            float: right;
        }
    </style>
@stop()
