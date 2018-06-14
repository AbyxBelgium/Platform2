@extends('backend.layouts.default')

@section('title')
    All posts
@stop()

@section('content')
    <div class="mdl-cell mdl-cell--12-col">
        <span class="mdl-layout__title">
            <h3>Posts:</h3>
        </span>

        @include('backend.pages.post.table')

        {{ $posts->links('backend.includes.pagination') }}
    </div>
@stop()
