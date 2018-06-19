@extends('backend.layouts.default')

@section('title', 'Images')

@section('content')
    <div class="mdl-cell mdl-cell--12-col">
        <span class="mdl-layout__title">
            <h3>Images:</h3>
        </span>

        <a class="mdl-button mdl-js-button mdl-js-ripple-effect create-button">
            <span class="icon icon-add icon-fix-position"></span> Upload new
        </a>

        <!-- Advanced file upload form. Based on https://css-tricks.com/drag-and-drop-file-uploading/ -->
        <form method="post" enctype="multipart/form-data" action="{{ route('backend/image/create') }}" novalidate="" class="box box__invisible">
            <div class="box__input">
                <svg class="box__icon" xmlns="http://www.w3.org/2000/svg" width="50" height="43" viewBox="0 0 50 43">
                    <path d="M48.4 26.5c-.9 0-1.7.7-1.7 1.7v11.6h-43.3v-11.6c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v13.2c0 .9.7 1.7 1.7 1.7h46.7c.9 0 1.7-.7 1.7-1.7v-13.2c0-1-.7-1.7-1.7-1.7zm-24.5 6.1c.3.3.8.5 1.2.5.4 0 .9-.2 1.2-.5l10-11.6c.7-.7.7-1.7 0-2.4s-1.7-.7-2.4 0l-7.1 8.3v-25.3c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v25.3l-7.1-8.3c-.7-.7-1.7-.7-2.4 0s-.7 1.7 0 2.4l10 11.6z"></path>
                </svg>
                <input type="file" name="files[]" id="file" class="box__file" data-multiple-caption="{count} files selected" multiple="">
                <label for="file"><strong>Choose an image</strong><span class="box__dragndrop"> or drag it here</span>.</label>
                <button type="submit" class="box__button">Upload</button>
            </div>
            <div class="box__uploading">Uploading…</div>
            <div class="box__success">Done! <a href="{{ route('backend/image/index') }}" class="box__restart" role="button">Upload more?</a></div>
            <div class="box__error">Error! <span></span>. <a href="{{ route('backend/image/index') }}" class="box__restart" role="button">Try again!</a></div>
            <input type="hidden" name="ajax" value="1">
        </form>

        <div class="mdl-grid" id="images">
            @foreach($images as $img)
                <div class="mdl-card mdl-cell mdl-cell--4-col mdl-shadow--2dp">
                    <figure class="mdl-card__media thumb-wrapper">
                        <span class="helper"></span>
                        <img class="thumb" title="Loyalty v2.0 - 3" src="https://abyx.be/images/1dd9113c4dced9df62326611fc961e7e.png">
                    </figure>
                    <div class="mdl-card__actions mdl-card--border image-actions">
                        <a href="{{ route('backend/image/show', ['id' => $img->id]) }}" title="permalink">
                            <button class="mdl-button mdl-button--icon mdl-button--accent">
                                <span class="icon icon-link"></span>
                            </button>
                        </a>
                        <a href="{{ route('backend/image/destroy'), ['id' => $img->id] }}">
                            <button class="mdl-button mdl-button--icon mdl-button--accent">
                                <span class="icon icon-delete"></span>
                            </button>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{ $images->links('backend.includes.pagination') }}
@stop()

@section('custom-style')
    <style>
        .box {
            font-size: 1.25rem; /* 20 */
            background-color: #c8dadf;
            position: relative;
            padding: 50px 0;
            outline: 2px dashed #92b0b3;
            outline-offset: -10px;
            width: 100%;
            text-align: center;
            height: 100px;

            -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
            transition: outline-offset .15s ease-in-out, background-color .15s linear;
        }

        .box__invisible {
            display: none;
        }

        .box.is-dragover {
            outline-offset: -20px;
            outline-color: #c8dadf;
            background-color: #fff;
        }

        .box__icon {
            width: 100%;
            height: 50px;
            fill: #92b0b3;
            display: block;
            margin-bottom: 40px;
        }

        .box__uploading,
        .box__success,
        .box__error {
            display: none;
        }

        .box.is-uploading .box__input {
            visibility: hidden;
        }

        .box.is-uploading .box__uploading {
            display: block;
        }

        .box__file {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        .box__file + label {
            max-width: 80%;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
            display: inline-block;
            overflow: hidden;
        }

        .box__file + label:hover strong,
        .box__file:focus + label strong,
        .box__file.has-focus + label strong {
            color: #39bfd3;
        }

        .box__file:focus + label,
        .box__file.has-focus + label {
            outline: 1px dotted #000;
            outline: -webkit-focus-ring-color auto 5px;
        }

        .box__button {
            font-weight: 700;
            color: #e5edf1;
            background-color: #39bfd3;
            display: none;
            padding: 8px 16px;
            margin: 40px auto 0;
        }
    </style>
@stop()

@section('javascript')
    <script>
        let $addButton = $('.create-button');
        $addButton.click(function() {
            $('.box').toggleClass('box__invisible')
        });

        // Start of upload controlling code
        let $form = $('.box');

        let droppedFiles = false;

        $form.on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
        })
            .on('dragover dragenter', function() {
                $form.addClass('is-dragover');
            })
            .on('dragleave dragend drop', function() {
                $form.removeClass('is-dragover');
            })
            .on('drop', function(e) {
                droppedFiles = e.originalEvent.dataTransfer.files;
                $form.trigger('submit');
            });

        $form.on('submit', function(e) {
            if ($form.hasClass('is-uploading')){
                return false;
            }

            $form.addClass('is-uploading').removeClass('is-error');

            e.preventDefault();

            let ajaxData = new FormData($form.get(0));

            let $input = $('input[type="file"]');

            if (droppedFiles) {
                $.each( droppedFiles, function(i, file) {
                    ajaxData.append($input.attr('name'), file);
                });
            }

            console.log('Going to perform an AJAX!');

            $.ajax({
                url: $form.attr('action'),
                type: $form.attr('method'),
                data: ajaxData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                complete: function() {
                    $form.removeClass('is-uploading');
                },
                success: function(data) {
                    $form.addClass(data.success === true ? 'is-success' : 'is-error' );
                    if (!data.success) $errorMsg.text(data.error);
                }
            });
        });
        // End of upload controlling code
    </script>
@stop()
