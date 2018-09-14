@extends('backend.layouts.default')

@section('content')
    <div class="mdl-cell mdl-cell--12-col">
        <span class="mdl-layout__title">
            <h3>New page:</h3>
        </span>

        <p>
            Add elements onto the corresponding column to manage the appearance of your new page. Change the order of the
            elements by dragging them around.
        </p>


        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <label class="mdl-textfield__label" for="page-title">Page title:</label>
            <input class="mdl-textfield__input" type="text" id="page-title" name="page-title" value="" required />
            <span class="mdl-textfield__error">Page title cannot be empty!</span>
        </div>

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
                                        <input type="radio" id="list-option-1" class="mdl-radio__button" name="options" data-app="{{ $element->getApp()->getName() }}" value="{{ $element->getIdentifier() }}" checked />
                                    </label>
                                </span>
                            </li>
                        @endforeach()
                    @endforeach()
                </ul>
            </div>
            <div class="mdl-dialog__actions">
                <button type="button" id="insert-done-button" class="mdl-button dialog-done-button">Done</button>
                <button type="button" id="insert-cancel-button" class="mdl-button close dialog-close-button">Cancel</button>
            </div>
        </dialog>
    </div>

    <div class="mdl-cell mdl-cell--6-col">
        <span class="mdl-layout__title">
            <h4>Left column:</h4>
        </span>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <label class="mdl-textfield__label" for="left-column-title">Column title:</label>
            <input class="mdl-textfield__input" type="text" id="left-column-title" name="left-column-title" value="" required />
            <span class="mdl-textfield__error">Column title cannot be empty!</span>
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <label class="mdl-textfield__label" for="left-column-width">Column width:</label>
            <select class="mdl-textfield__input" id="left-column-width" name="left-column-width">
                <option value="2">2</option>
                <option value="4">4</option>
                <option value="6">6</option>
                <option value="8">8</option>
                <option value="10">10</option>
                <option value="12">12</option>
            </select>
        </div>
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
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <label class="mdl-textfield__label" for="right-column-title">Column title:</label>
            <input class="mdl-textfield__input" type="text" id="right-column-title" name="right-column-title" value="" required />
            <span class="mdl-textfield__error">Column title cannot be empty!</span>
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <label class="mdl-textfield__label" for="right-column-width">Column width:</label>
            <select class="mdl-textfield__input" id="right-column-width" name="right-column-width">
                <option value="2">2</option>
                <option value="4">4</option>
                <option value="6">6</option>
                <option value="8">8</option>
                <option value="10">10</option>
                <option value="12">12</option>
            </select>
        </div>
        <div id="right-drop-destination" class="drop-column">
            <svg class="plus-sign" id="add-right-button" xmlns="http://www.w3.org/2000/svg" width="75" height="75" viewBox="0 0 24 24">
                <path d="M24 10h-10v-10h-4v10h-10v4h10v10h4v-10h10z"></path>
            </svg>
        </div>
    </div>

    <div class="center" style="padding-top: 10px;">
        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" id="publish-button">Publish page</button>
    </div>
@stop()

@section('javascript')
    @include('backend.pages.page.edit-js')
@stop()

@section('custom-style')
    <style>
        .drop-column {
            margin-top: 15px;
            outline: 2px dashed #92b0b3;
            outline-offset: -10px;
            min-height: 150px;
            padding-bottom: 15px;
            padding-top: 15px;
        }

        .plus-sign {
            display: block;
            padding-top: 33px;
            margin: auto auto 15px;
            fill: #bababa;
        }

        .plus-sign:hover {
            fill: #929292;
            cursor: pointer;
        }

        .mdl-dialog {
            z-index: 100;
        }

        .element-card {
            margin: 25px;
            width: 93%;
        }
    </style>
@stop()
