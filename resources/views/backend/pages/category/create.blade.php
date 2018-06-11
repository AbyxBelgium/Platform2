@extends('backend.layouts.default')

@section('title')
    Create new post
@stop()

@section('content')
    <div class="mdl-cell mdl-cell--12-col">
        <span class="mdl-layout__title">
            <h3>Add category:</h3>
        </span>
        <form method="POST" action="{{ route('backend/category/store') }}">
            @csrf

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <label class="mdl-textfield__label" for="name">Name:</label>
                <input class="mdl-textfield__input" type="text" id="name" name="name" value="{{ old('name') }}" />
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="icon-input">
                <label class="mdl-textfield__label" for="icon">Icon:</label>
                <input class="mdl-textfield__input" type="text" id="icon" name="icon" value="{{ old('icon') }}"/>
            </div>
            <span class="icon icon-help"></span>

            <div class="center" style="padding-top: 10px;">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" id="publish-button" type="submit">Create category</button>
            </div>
        </form>
    </div>
@stop()

@section('javascript')
    <script>
        $icon = $("#icon");
        $example = $("#example-icon");

        $icon.change(function() {
            $example.removeClass();
            $example.addClass("icon");
            $example.addClass("icon-" + $icon.value);
        });
    </script>
@stop()

@section('custom-style')
    <style>

    </style>
@stop()
