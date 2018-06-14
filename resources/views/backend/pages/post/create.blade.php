@extends('backend.layouts.default')

@section('title')
    Create new post
@stop()

@section('content')
    <div class="mdl-cell mdl-cell--9-col">
        <span class="mdl-layout__title">
            <h3>Add post:</h3>
        </span>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <label class="mdl-textfield__label" for="title">Title:</label>
            <input class="mdl-textfield__input" type="text" id="title" name="title" value="{{ old('title') }}" />
        </div>

        <div id="markdown-editor">
            <div id="icons">
                <button title="bold" id="bold-button" aria-label="Bold">
                    <span class="icon icon-format_bold" aria-hidden="true"></span>
                </button>
                <button title="italic" id="italic-button" aria-label="Italic">
                    <span class="icon icon-format_italic" aria-hidden="true"></span>
                </button>
                <button title="unordered list" id="list-button" aria-label="List">
                    <span class="icon icon-list" aria-hidden="true"></span>
                </button>
                <button title="H1" class="text-button" id="h1-button" aria-label="H1">
                    <div class="button-text">H1</div>
                </button>
                <button title="H2" class="text-button" id="h2-button" aria-label="H2">
                    <div class="button-text">H2</div>
                </button>
                <button title="H3" class="text-button" id="h3-button" aria-label="H3">
                    <div class="button-text">H3</div>
                </button>
                <button title="H4" class="text-button" id="h4-button" aria-label="H4">
                    <div class="button-text">H4</div>
                </button>
                <button title="insert image" id="image-button" aria-label="Left Align">
                    <span class="icon icon-photo_library" aria-hidden="true"></span>
                </button>
                <button title="quote" id="quote-button" aria-label="Left Align">
                    <span class="icon icon-format_quote"></span>
                </button>
                <button title="code" id="code-button" aria-label="Left Align">
                    <span class="icon icon-code" aria-hidden="true"></span>
                </button>
                <button title="link" id="link-button" aria-label="Left Align">
                    <span class="icon icon-link" aria-hidden="true"></span>
                </button>
                <button title="help" id="help-button" aria-label="Help">
                    <span class="icon icon-help"></span>
                </button>
            </div>
            <textarea rows="14" class="form-control" id="markdown-data" name="content">{{ old('content') }}</textarea>
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <label for="tags" class="mdl-textfield__label">Tags (Separated by comma):</label>
            <input type="text" class="mdl-textfield__input" id="tags" name="tags" onkeyup="updateTags(this)">
        </div>
        <div id="chips" style="margin-bottom: 10px;">
        </div>

        <div class="center" style="padding-top: 10px;">
            <button class="mdl-button mld-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" id="save-button">Save post</button>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" id="publish-button">Publish post</button>
        </div>
    </div>
    <div class="mdl-cell mdl-cell--3-col">
        <span class="mdl-layout__title">
            <h3>Category:</h3>
        </span>
        @foreach($categories as $category)
            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect">
                <input type="radio" class="mdl-radio__button" name="catRadio" data-id="{{ $category->id }}" value="{{ $category->name }}">
                <span class="mdl-radio__label">{{ $category->name }}</span>
            </label>
        @endforeach
    </div>
@stop()

@section('javascript')
    <!-- Control save and publish button -->
    <script>
        let $saveButton = $("#save-button");
        let $publishButton = $("#publish-button");

        let $editor = $("#markdown-data");
        let $titleInput = $("#title");
        let $tagsInput = $("#tags");

        let $categories = $(".mdl-radio__button");

        let $selected = null;
        $.each($categories, function(index, element) {
            $element = $(element);
            if ($element.is(':checked')) {
                $selected = $element;
            }
        });

        if ($selected === null) {
            $selected = $($categories.get(0));
            $selected.prop('checked', true);
        }

        $publishButton.click(function () {
            console.log();
            $.post("{{ route('backend/post/store') }}", {
                title: $titleInput.val(),
                content: $editor.val(),
                tags: $tagsInput.val(),
                category: $selected.data('id')
            })
                .done(function(data) {
                    window.location.href = "{{ route('backend/post/index', ["page" => 1]) }}"
                });
        });
    </script>

    <!-- Markdown editor script -->
    <script>
        function setObjectHighlightedText(object, replacement){
            if(typeof object.selectionStart === 'number' && typeof object.selectionEnd === 'number') {
                // All browsers except IE
                let start = object.selectionStart;
                let end = object.selectionEnd;

                let before = object.value.slice(0, start);
                let after = object.value.slice(end);

                object.value = before + replacement + after;
            }
        }

        // Replace the highlighted text with a given string
        function setHighlightedText(replacement) {
            let textarea = document.getElementById("markdown-data");
            setObjectHighlightedText(textarea, replacement);
        }

        function getObjectHighlightedText(object){
            if(typeof object.selectionStart === 'number' && typeof object.selectionEnd === 'number') {
                // All browsers except IE
                let start = object.selectionStart;
                let end = object.selectionEnd;

                return object.value.slice(start, end);
            }
        }

        // Returns the text highlighted (selected) by the user
        function getHighlightedText(){
            let textarea = document.getElementById("markdown-data");
            return getObjectHighlightedText(textarea);
        }

        // Returns the number of #-characters at the beginning of a string
        function numberOfStartHashes(text){
            let amount = 0;
            for (let i = 0; i < text.length; i++) {
                if (text[i] ===  "#"){
                    amount++;
                }
            }
            return amount;
        }

        $("#bold-button").click(function(){
            let selected = getHighlightedText();
            if (selected.startsWith("**") && selected.endsWith("**")){
                setHighlightedText(selected.slice(2, selected.length - 2));
            } else {
                setHighlightedText("**" + selected + "**");
            }
        });

        $("#italic-button").click(function(){
            let selected = getHighlightedText();
            if (selected.startsWith("_") && selected.endsWith("_")){
                setHighlightedText(selected.slice(1, selected.length - 1));
            } else {
                setHighlightedText("_" + selected + "_");
            }
        });

        $("#list-button").click(function(){
            let selected = getHighlightedText();
            let replace = "";
            let lines = selected.split('\n');
            for(let i = 0; i < lines.length; i++){
                replace += "*" + lines[i] + "\n";
            }
            setHighlightedText(replace);
        });

        // Sets a specific header layout. The header argument is the number of the header (eg 1 for H1)
        function headerSetter(header){
            let selected = getHighlightedText();
            let startHashes = numberOfStartHashes(selected);
            if (startHashes === header){
                setHighlightedText(selected.slice(header, selected.length));
            } else {
                setHighlightedText("#".repeat(header) + selected.slice(startHashes, selected.length));
            }
        }

        $("#h1-button").click(function(){
            headerSetter(1);
        });

        $("#h2-button").click(function(){
            headerSetter(2);
        });

        $("#h3-button").click(function(){
            headerSetter(3);
        });

        $("#h4-button").click(function(){
            headerSetter(4);
        });

        $("#help-button").click(function(){
            window.open("https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet");
        });

        $("#quote-button").click(function(){
            let selected = getHighlightedText();
            // Get all selected lines and let each one start with the quote identifier (>)
            let lines = selected.split("\n");
            let replace = "";
            // When the selected lines allready start with a ">", then remove them (thus disabling the quote)
            if (selected.startsWith(">")){
                for (let i = 0; i < lines.length; i++){
                    if (lines[i].startsWith(">")){
                        replace += lines[i].slice(1, lines[i].length) + "\n";
                    } else {
                        replace += lines[i] + "\n";
                    }
                }
            } else {
                for (let i = 0; i < lines.length; i++){
                    replace += ">" + lines[i] + "\n";
                }
            }
            setHighlightedText(replace);
        });

        // Start of code that controls the popup code formatter
        let $codeField = $("#code");
        let $languageSelector = $("#language-selector");

        $("#code-button").click(function(){
            // Find code popup object and open the popup
            let popup = document.getElementById("popup2");
            popup.style.display = "block";

            let selected = getHighlightedText().trim();
            if (selected !== "" && selected.startsWith("<pre") && selected.endsWith("</pre>")){
                // Remove all characters up until the start of the language name
                let language = selected.slice(19, selected.length);
                // Extract language name
                language = language.replace(/;[^]*$/m, "");
                $languageSelector.val(language);
                // Extract code
                let code = selected.replace(/^[^>]+>\n([^]*)\n<\/pre>/m, /$1/);
                // Strip the leading and trailing slash by using slice
                $codeField.val(code.slice(1, code.length - 1));
            }
        });

        $("#insert-code-button").click(function(){
            // Selected language (is value of dropdown menu)
            let language = $languageSelector.val();

            // Get inserted code
            let code = $codeField.val();

            let replacement = "<pre class='brush: " + language + ";'>\n" + code + "\n</pre>";
            setHighlightedText(replacement);

            let popup = document.getElementById("popup2");
            popup.style.display = "none";

            // Clear code textarea
            $codeField.val("");
        });

        // This function converts a press on the TAB-key to 4 spaces
        $codeField.keydown(function(e) {
            if(e.keyCode === 9) {
                let text = getObjectHighlightedText($codeField[0]);

                let lines = text.split("\n");
                let replacement = "";
                if (lines.length > 1){
                    for (let i = 0; i < lines.length; i++){
                        replacement += "    " + lines[i] + "\n";
                    }
                } else {
                    replacement = "    " + text;
                }
                setObjectHighlightedText($codeField[0], replacement);

                // prevent the focus lose
                return false;
            }
        });
        // End of code that controls the popup code formatter

        // Start of code that controls the insert link popup
        let $linkInput = $("#link-input");

        $("#link-button").click(function(){
            let popup = document.getElementById("popup3");
            popup.style.display = "block";

            let selected = getHighlightedText();
            if (selected.startsWith("[") && selected.endsWith(")")){
                let url = selected.replace(/.*\((.*)\)/, /$1/);
                // Remove slashes from begin and end of string
                $linkInput.val(url.slice(1, url.length - 1));
            }
        });

        $("#insert-link-button").click(function(){
            let selected = getHighlightedText();
            let url = $linkInput.val();
            if (selected.startsWith("[") && selected.endsWith(")")){
                let text = selected.replace(/\[(.*)\].*/, /$1/);
                setHighlightedText("[" + text.slice(1, text.length - 1) + "](" + url + ")");
            } else {
                setHighlightedText("[" + selected + "](" + url + ")");
            }

            document.getElementById("popup3").style.display = "none";
            $linkInput.val("");
        });
        // End of code that controls the insert link popup

        // Hide popup when done or cancel button is pressed
        $(".done, .cancel").click(function(){
            let $popup = $(".popup");
            $popup.css("display", "none");
        });

        // Start of code that controls the tags
        let updateTags = function(value) {
            let tags = $("#tags").val();
            let allTags = tags.split(", ");
            let chips = "";
            for (let i = 0; i < allTags.length; i++) {
                if (allTags[i].trim() !== ""){
                    chips +=
                        "<span class='mdl-chip mdl-chip--deletable' style='margin-left: 5px;'>" +
                        "   <span class='mdl-chip__text'>" + allTags[i] + "</span>" +
                        "   <button type='button' class='mdl-chip__action'><i class='material-icons'>cancel</i></button>" +
                        "</span>";
                }
            }
            $("#chips").html(chips);
        };
        // End of code that controls tags
    </script>
@stop()

@section('custom-style')
    <style>
        #markdown-editor {
            background-color: #F0F0F0;
            padding: 7px 7px 0 7px;
        }

        #markdown-editor button {
            background-color: #F0F0F0;
            color: black;
            padding: 5px;
            border: none;
        }

        #markdown-editor button:hover {
            margin: -1px;
            border: 1px solid #555;
            border-radius: 2px;
        }

        #markdown-editor #icons {
            margin: 0;
        }

        #markdown-editor .text-button {
            width: 35px;
            height: 35px;
            padding: 0;
            position: relative;
            top: -4px;
        }

        #markdown-editor .text-button:hover {
            margin: 0;
        }

        #markdown-editor .button-text {
            font-family: "Arial Black", Gadget, sans-serif;
        }

        #markdown-editor .icon {
            top: 0 !important;
            color: rgb(45, 45, 45);
        }

        #markdown-editor textarea {
            width: 100%;
            position: relative;
            left: -3px;
        }

        .popup {
            border: 1px solid grey;
        }

        .thumb-wrapper {
            position: relative;
            overflow: hidden;
            width: 130px;
            height: 130px;
            display: inline-block;
            border: 1px solid grey;
            border-radius: 7px;
            margin: 5px;
        }

        .popup img {
            position: absolute;
            left: -1000%;
            right: -1000%;
            top: -1000%;
            bottom: -1000%;
            margin: auto;
            max-width: 300px;
            max-height: 300px;
        }

        .nav-button {
            padding: 0 !important;
        }

        .nav-button .icon {
            position: relative;
            top: 0;
        }
    </style>
@stop()
