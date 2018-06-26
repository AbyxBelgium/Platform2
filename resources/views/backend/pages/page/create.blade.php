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

        <dialog class="mdl-dialog" id="element-dialog">
            <h4 class="mdl-dialog__title">Add element</h4>
            <div class="mdl-dialog__content">
                <ul class="mdl-list">
                    @foreach($elements as $key => $elementsPerKey)
                        <span class="mdl-list__item-primary-content">
                            <span>{{ $key }}:</span>
                        </span>
                        @foreach($elementsPerKey as $element)
                            <li class="mdl-list__item">
                                <span class="mdl-list__item-primary-content">
                                    {{ $element->getIdentifier() }}
                                </span>
                                <span class="mdl-list__item-secondary-action">
                                    <label class="demo-list-radio mdl-radio mdl-js-radio mdl-js-ripple-effect" for="list-option-1">
                                        <input type="radio" id="list-option-1" class="mdl-radio__button" name="options" value="1" checked />
                                    </label>
                                </span>
                            </li>
                        @endforeach()
                    @endforeach()
                </ul>
            </div>
            <div class="mdl-dialog__actions">
                <button type="button" id='insert-done-button' class="mdl-button dialog-done-button">Done</button>
                <button type="button" id='insert-cancel-button' class="mdl-button close dialog-close-button">Cancel</button>
            </div>
        </dialog>
    </div>

    <div class="mdl-cell mdl-cell--6-col">
        <span class="mdl-layout__title">
            <h4>Left column:</h4>
        </span>
        <div id="left-drop-destination" class="drop-column">
            <svg class="plus-sign" id="add-left-button" xmlns="http://www.w3.org/2000/svg" width="75" height="75" viewBox="0 0 24 24">
                <path d="M24 10h-10v-10h-4v10h-10v4h10v10h4v-10h10z"></path>
            </svg>
        </div>
    </div>

    <div class="mdl-cell mdl-cell--6-col">
        <span class="mdl-layout__title">
            <h4>Right column:</h4>
        </span>
        <div id="right-drop-destination" class="drop-column">
            <svg class="plus-sign" id="add-right-button" xmlns="http://www.w3.org/2000/svg" width="75" height="75" viewBox="0 0 24 24">
                <path d="M24 10h-10v-10h-4v10h-10v4h10v10h4v-10h10z"></path>
            </svg>
        </div>
    </div>
@stop()

@section('javascript')
    <script>
        let $leftColButton = $("#add-left-button");
        let $rightColButton = $("#add-right-button");
        let dialog = document.getElementById("element-dialog");

        let $modalCloseButton = $("#insert-cancel-button");
        $modalCloseButton.click(function() {
            dialog.close();
        });

        let initializeDialog = function($col) {
             dialog.show();
        };

        $leftColButton.click(function() {
            initializeDialog('left');
        });

        $rightColButton.click(function() {
            initializeDialog('right');
        })
    </script>
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

        .mdl-dialog {
            z-index: 100;
        }
    </style>
@stop()
