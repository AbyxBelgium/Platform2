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
                $.ajax({
                    "url": "/api/extension/" + $element.data("app") + "/" + $element.val() + '/settings',
                    "headers": {
                        "Authorization": "Bearer {{ $token }}"
                    }
                })
                    .done(function(received) {
                        let uuid = received.uuid;

                        let data =
                            '<div class="mdl-card element-card mdl-shadow--2dp" id="' + uuid + '">' +
                            '    <div class="mdl-card__title mdl-card--expand">' +
                            '        <h4>' +
                            '            ' + $element.data('app') + ': ' + $element.val() +
                            '        </h4>' +
                            '    </div>' +
                            '    <div class="mdl-card__supporting-text">' +
                            '           ' +  received.content +
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

                        let $extensionButton = $("#button-" + uuid);
                        let $extensionForm = $("#form-" + uuid);

                        $extensionButton.click(function() {
                            let route = $extensionButton.data("action");

                            // Loop over form inputs and retrieve key-value pairs.
                            let keyValues = {};
                            // First check all default inputs
                            let $inputs = $extensionForm.find("input");
                            $inputs.each(function(index) {
                                keyValues[$(this).attr("name")] = $(this).val();
                            });
                            // Then check all textarea's
                            let $texts = $extensionForm.find("textarea");
                            $texts.each(function(index) {
                                keyValues[$(this).attr("name")] = $(this).val();
                            });

                            console.log(keyValues);

                            $.post({
                                "url": route,
                                "data": {
                                    "data-pairs": JSON.stringify(keyValues),
                                    "test-data": "this is a string!"
                                }
                            })
                        })
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
