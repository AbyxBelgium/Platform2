@extends('backend.layouts.default')

@section('title', 'Create page')

@section('content')
    <div class="mdl-cell mdl-cell--12-col">
        <span class="mdl-layout__title">
            <h3>New page:</h3>
        </span>

        <p>Drag and drop elements onto the corresponding column to manage the appearance of your new page.</p>
    </div>

    <div class="mdl-cell mdl-cell--6-col">
        <span class="mdl-layout__title">
            <h3>Left column:</h3>
        </span>
        <div id="left-drop-destination" class="drop-column">

        </div>
    </div>

    <div class="mdl-cell mdl-cell--6-col">
        <span class="mdl-layout__title">
            <h3>Right column:</h3>
        </span>
        <div id="right-drop-destination" class="drop-column">

        </div>
    </div>
@stop()

@section('custom-style')
    <style>
        .drop-column {
            outline: 2px dashed #92b0b3;
            outline-offset: -10px;
            min-height: 150px;
        }
    </style>
@stop()
