@extends('backend.layouts.default')

@section('title', 'Create page')

@section('content')
    <div class="mdl-cell mdl-cell--12-col">
        <span class="mdl-layout__title">
            <h3>New page:</h3>
        </span>

        <p>
            Add elements onto the corresponding column to manage the appearance of your new page. Change the order of the
            elements by dragging them around.
        </p>
    </div>

    <div class="mdl-cell mdl-cell--6-col">
        <span class="mdl-layout__title">
            <h4>Left column:</h4>
        </span>
        <div id="left-drop-destination" class="drop-column">
            <svg class="plus-sign" xmlns="http://www.w3.org/2000/svg" width="75" height="75" viewBox="0 0 24 24">
                <path d="M24 10h-10v-10h-4v10h-10v4h10v10h4v-10h10z"></path>
            </svg>
        </div>
    </div>

    <div class="mdl-cell mdl-cell--6-col">
        <span class="mdl-layout__title">
            <h4>Right column:</h4>
        </span>
        <div id="right-drop-destination" class="drop-column">
            <svg class="plus-sign" xmlns="http://www.w3.org/2000/svg" width="75" height="75" viewBox="0 0 24 24">
                <path d="M24 10h-10v-10h-4v10h-10v4h10v10h4v-10h10z"></path>
            </svg>
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

        .plus-sign {
            margin: auto;
            display: block;
            padding-top: 33px;
            fill: #bababa;
        }

        .plus-sign:hover {
            fill: #929292;
            cursor: pointer;
        }
    </style>
@stop()
