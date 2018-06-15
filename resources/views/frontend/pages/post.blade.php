@extends('frontend.layouts.default')
@section('title')
    Home
@stop()

@section('content')
    <div class="mdl-cell mdl-cell--12-col mdl-color--white mdl-shadow--4dp mdl-color-text--grey-800 post-content">
        <span class="mdl-layout__title margin">
            <h3>{{ $post->title }}</h3>
        </span>
        <div class="main-content">
            {!! $markdownConverter->convertToHtml($post->content) !!}
        </div>
        <p class="credit">Last updated by {{ $user->name }} on {{ $user->updated_at }}</p>
    </div>
@stop
