<script>
    let mode = "@yield('mode')";

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

    let col = 'left';

    let $leftColumn = $("#left-drop-destination");
    let $rightColumn = $("#right-drop-destination");

    let $modalDoneButton = $("#insert-done-button");

    let $leftColumnTitle = $("#left-column-title");
    let $rightColumnTitle = $("#right-column-title");
    let $leftColumnWidth = $("#left-column-width");
    let $rightColumnWidth = $("#right-column-width");

    let $pageTitleInput = $("#page-title");

    let moveElementUp = function(arr, idx) {
        let prevIdx = idx - 1;
        if (prevIdx < 0) {
            return arr;
        }

        let temp = arr[prevIdx];
        arr[prevIdx] = arr[idx];
        arr[idx] = temp;
        return arr;
    };

    let moveElementDown = function(arr, idx) {
        let nextIdx = idx + 1;
        if (nextIdx >= arr.length) {
            return arr;
        }

        let temp = arr[nextIdx];
        arr[nextIdx] = arr[idx];
        arr[idx] = temp;
        return arr;
    };

    let renderCard = function(app, identifier, uuid, content) {
        return '' +
            '<div class="mdl-card element-card mdl-shadow--2dp" id="' + uuid + '">' +
            '    <div class="mdl-card__title mdl-card--expand">' +
            '        <h4>' +
            '            ' + app + ': ' + identifier +
            '        </h4>' +
            '    </div>' +
            '    <div class="mdl-card__supporting-text">' +
            '    <div class="error" id="error-' + uuid + '" style="display: none;">' +
            '    </div>' +
            '    <div class="center" id="form-loading-' + uuid + '" style="display: none;">' +
            '        <div class="mdl-spinner mdl-spinner--single-color mdl-js-spinner is-active"></div>' +
            '    </div>' +
            '        <fieldset id="form-data-' + uuid + '">' +
            '           ' + content +
            '        </fieldset>' +
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
    };

    let initializeCard = function(app, identifier, received, col) {
        let uuid = received.uuid;

        let elementData = {
            "app": app,
            "identifier": identifier,
            "uuid": uuid
        };

        let data = renderCard(app, identifier, uuid, received.content);

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
            if (col === 'left') {
                moveElementUp(leftExtensions, leftExtensions.find(elementData));
            } else {
                moveElementUp(rightExtensions, rightExtensions.find(elementData));
            }
        });

        // Move element down one position in the list
        $("#down-" + uuid).click(function() {
            let $element = $("#" + uuid);
            $element.next().insertBefore($element);
            if (col === 'left') {
                moveElementDown(leftExtensions, leftExtensions.find(elementData));
            } else {
                moveElementDown(rightExtensions, rightExtensions.find(elementData));
            }
        });

        let $extensionButton = $("#button-" + uuid);
        let $extensionForm = $("#form-" + uuid);
        let $formFieldSet = $("#form-data-" + uuid);
        let $loadIndicator = $("#form-loading-" + uuid);
        let $errorField = $("#error-" + uuid);

        $extensionButton.click(function() {
            $formFieldSet.attr("disabled", "disabled");
            $loadIndicator.css("display", "block");
            $extensionButton.prop("disabled", true);
            $errorField.css("display", "none");

            let route = $extensionButton.data("action");

            // Loop over form inputs and retrieve key-value pairs.
            let keyValues = {};
            // First check all default inputs
            let $inputs = $extensionForm.find("input");
            $inputs.each(function(index) {
                keyValues[$(this).attr("name")] = $(this).val();
                if (col === 'left') {
                    let prevIdx = index - 1;
                    if (prevIdx < 0) {
                        return;
                    }
                }
            });

            // Then check all textarea's
            let $texts = $extensionForm.find("textarea");
            $texts.each(function(index) {
                keyValues[$(this).attr("name")] = $(this).val();
            });

            $.post({
                "url": route,
                "data": {
                    "data-pairs": JSON.stringify(keyValues),
                    "uuid": uuid
                }
            }).done(function(result) {
                $formFieldSet.attr("disabled", false);
                $loadIndicator.css("display", "none");
                $extensionButton.prop("disabled", false);

                if (!result["status"]) {
                    $errorField.text("An error occurred: " + result["error"]);
                    $errorField.css("display", "block");
                }
            }).fail(function() {
                $formFieldSet.attr("disabled", false);
                $loadIndicator.css("display", "none");
                $extensionButton.prop("disabled", false);

                $errorField.text("Server error while processing request!");
                $errorField.css("display", "block");
            })
        });

        // Activate loader itself from Material Design Lite library
        // This call is required when the spinner was added using JavaScript instead of plain HTML
        $('.mdl-js-spinner').each(function() {
            componentHandler.upgradeElement(this);
        });
        $('.mdl-textfield').each(function() {
            componentHandler.upgradeElement(this);
        });
    };

    let receiveCardData = function(app, identifier, col) {
        $.ajax({
            "url": "/api/extension/" + app + "/" + identifier + '/settings',
            "headers": {
                "Authorization": "Bearer {{ $token }}"
            }
        })
            .done(function(received) {
                initializeCard(app, identifier, received, col);
            });
    };

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

    $modalDoneButton.click(function() {
        // Get currently selected extension and add it to the corresponding column
        let $radioButtons = $('.mdl-radio__button');
        for (let i = 0; i < $radioButtons.length; i++) {
            let $element = $($radioButtons.get(i));

            if ($element.is(':checked')) {
                receiveCardData($element.data('app'), $element.val(), col)
            }
        }
        dialog.close();
    });

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

    if (mode === 'edit') {
        $.get({
            url: "{{ route('page/show', ['id' => $page->id]) }}",
            headers: {
                Accept: "application/json"
            }
        }).done(function(received) {
            console.log(received);

            // For now we assume that 2 containers are always present
            // First we fill the left column
            let container = received.containers[0];
            for (let j = 0; j < container.elements.length; j++) {
                console.log("call left!");
                let element = container.elements[j];
                receiveCardData(element.app, element.identifier, 'left');
            }

            container = received.containers[1];
            for (let j = 0; j < container.elements.length; j++) {
                console.log("call right!");
                let element = container.elements[j];
                receiveCardData(element.app, element.identifier, 'right');
            }
        })
    }
</script>
