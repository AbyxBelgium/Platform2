@extends('backend.pages.post.form')

@section('title', 'Update post')

@section('form-title', 'Update post:')

@section('form-action'){{ route('backend/post/update', ['id' => $post->id]) }}@stop()

@section('form-method', 'PUT')

@section('form-submit', 'Update post')

@section('form-title-input')
@if(old('title')){{ old('title') }}@else{{ $post->title }}@endif
@stop()

@section('form-content')
@if(old('content')){{ old('content') }}@else{{ $post->content }}@endif
@stop()

@section('form-tags')
@if(old('tags')){{ old('tags') }}@else{{ $tags }}@endif
@stop()

@section('javascript-extra')
    <script>
        $.each($categories, function(index, element) {
            $element = $(element);
            if ($element.data('id') === "{{ $post->category_id }}") {
                $element.trigger('click');
            }
        });
    </script>
@stop()
