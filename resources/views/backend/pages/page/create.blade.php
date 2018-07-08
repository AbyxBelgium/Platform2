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
    <script>
        let leftExtensions = [];
        let rightExtensions = [];

        let $leftColButton = $("#add-left-button");
        let $rightColButton = $("#add-right-button");
        let $publishButton = $("#publish-button");
        let dialog = document.getElementById("element-dialog");

        let $modalCloseButton = $("#insert-cancel-button");
        $modalCloseButton.click(function() {
            dialog.close();
        });

        let $leftColumn = $("#left-drop-destination");
        let $rightColumn = $("#right-drop-destination");

        let $modalDoneButton = $("#insert-done-button");

        let col = "left";
        $modalDoneButton.click(function() {
            // Get currently selected extension and add it to the corresponding column
            let $radioButtons = $('.mdl-radio__button');
            for (let i = 0; i < $radioButtons.length; i++) {
                let $element = $($radioButtons.get(i));

                let elementData = {
                    "app": $element.data('app'),
                    "identifier": $element.val()
                };

                if ($element.is(':checked')) {
                    let uuid = guid();

                    let data =
                        '<div class="mdl-card element-card mdl-shadow--2dp" id="' + uuid + '">' +
                        '    <div class="mdl-card__title mdl-card--expand">' +
                        '        <h4>' +
                        '            ' + $element.data('app') + ': ' + $element.val() +
                        '        </h4>' +
                        '    </div>' +
                        '    <div class="mdl-card__actions mdl-card--border">' +
                        '        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">' +
                        '            Delete' +
                        '            <span class="mdl-button__ripple-container">' +
                        '                <span class="mdl-ripple"></span>' +
                        '            </span>' +
                        '        </a>' +
                        '        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="up-' + uuid + '">' +
                        '            Move up' +
                        '            <span class="mdl-button__ripple-container">' +
                        '                <span class="mdl-ripple"></span>' +
                        '            </span>' +
                        '        </a>' +
                        '        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="down-' + uuid + '">' +
                        '            Move down' +
                        '            <span class="mdl-button__ripple-container">' +
                        '                <span class="mdl-ripple"></span>' +
                        '            </span>' +
                        '        </a>' +
                        '        <div class="mdl-layout-spacer"></div>' +
                        '    </div>' +
                        '</div>';

                    if (col === 'left') {
                        $leftColumn.prepend(data);
                        leftExtensions.push(elementData)
                    } else {
                        $rightColumn.prepend(data);
                        rightExtensions.push(elementData);
                    }

                    // Move element up one position in the list
                    $("#up-" + uuid).click(function() {
                        let $element = $("#" + uuid);
                        $element.prev().insertAfter($element);
                    });

                    // Move element down one position in the list
                    $("#down-" + uuid).click(function() {
                        let $element = $("#" + uuid);
                        $element.next().insertBefore($element);
                    });

                    break;
                }
            }
            dialog.close();
        });

        let initializeDialog = function(column) {
            col = column;
             dialog.show();
        };

        $leftColButton.click(function() {
            initializeDialog('left');
        });

        $rightColButton.click(function() {
            initializeDialog('right');
        });

        let $leftColumnTitle = $("#left-column-title");
        let $rightColumnTitle = $("#right-column-title");
        let $leftColumnWidth = $("#left-column-width");
        let $rightColumnWidth = $("#right-column-width");

        let $pageTitleInput = $("#page-title");

        $publishButton.click(function() {
            let publishData = {
                "columns": [{
                    "title": $leftColumnTitle.val(),
                    "width": $leftColumnWidth.val(),
                    "elements": leftExtensions
                }, {
                    "title": $rightColumnTitle.val(),
                    "width": $rightColumnWidth.val(),
                    "elements": rightExtensions
                }]
            };

            $.post({
                url: "{{ route('backend/page/store') }}",
                type: "POST",
                data: {
                    "title": $pageTitleInput.val(),
                    "content": JSON.stringify(publishData)
                },
                complete: function() {
                    location.href = "{{ route('backend/page/index') }}"
                }
            });
        });

        function guid() {
            function s4() {
                return Math.floor((1 + Math.random()) * 0x10000)
                    .toString(16)
                    .substring(1);
            }
            return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
        }
    </script>
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
