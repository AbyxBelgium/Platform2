@extends('backend.layouts.default')

@section('title')
    All posts
@stop()

@section('content')
    <div class="mdl-cell mdl-cell--12-col">
        <span class="mdl-layout__title">
            <h3>Posts:</h3>
        </span>

        <a class="mdl-button mdl-js-button mdl-js-ripple-effect create-button" href="{{ route('backend/post/create') }}">
            <span class="icon icon-add icon-fix-position"></span> Add post
        </a>

        @include('backend.pages.post.table')

        {{ $posts->links('backend.includes.pagination') }}
    </div>
@stop()
