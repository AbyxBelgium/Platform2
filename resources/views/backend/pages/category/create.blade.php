@extends('backend.layouts.default')

@section('title')
    Create new category
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
                <input class="mdl-textfield__input" type="text" id="name" name="name" value="{{ old('name') }}" required />
                <span class="mdl-textfield__error">Name cannot be empty!</span>
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="icon-input">
                <label class="mdl-textfield__label" for="icon">Icon:</label>
                <input class="mdl-textfield__input" type="text" id="icon" name="icon" value="{{ old('icon') }}" required />
                <span class="mdl-textfield__error">Please enter a valid icon!</span>
            </div>

            <div id="icons">
                @foreach($iconManager->icons as $icon)
                    <span title="{{ $icon }}" data-icon="{{ $icon }}" class="select-icon icon icon-{{ $icon }}"></span>
                @endforeach
            </div>

            <div class="center" style="padding-top: 10px;">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" id="publish-button" type="submit">Create category</button>
            </div>
        </form>
    </div>
@stop()

@section('javascript')
    <script>
        let allIcons = [
            @foreach($iconManager->icons as $icon)
            "{{ $icon }}",
            @endforeach
        ];

        let $iconInput = $("#icon");
        let $iconField = $("#icon-input");
        let $icons = $(".select-icon");
        $icons.click(function() {
            $icons.removeClass("selected-icon");
            $(this).addClass("selected-icon");
            $iconField.removeClass("is-invalid");
            $iconInput.val($(this).data("icon"));
            $iconField.addClass("is-dirty");
        });

        $iconInput.keyup(function() {
            $iconField.removeClass("is-invalid");
            let iconVal = $iconInput.val();
            console.log(iconVal);
            $iconField.addClass("is-dirty");
            if (allIcons.includes(iconVal)) {
                $currentIcon = $(".icon-" + iconVal);
                $icons.removeClass("selected-icon");
                $currentIcon.addClass("selected-icon");
            } else {
                $iconField.addClass("is-invalid");
            }
        });
    </script>
@stop()

@section('custom-style')
    <style>
        .select-icon {
            font-size: 36px;
        }

        .selected-icon {
            color: rgb(255,82,82);
        }

        #icons {
            margin-top: 20px;
            max-height: 300px;
            overflow: auto;
        }
    </style>
@stop()
