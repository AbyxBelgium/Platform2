@extends('frontend.layouts.default')
@section('title')
    Home
@stop()

@section('content')
    <div class="mdl-cell mdl-cell--6-col">
        <span class="mdl-layout__title">
            <h3>Our website:</h3>
        </span>
    </div>
    <div class="mdl-cell mdl-cell--6-col">
        <span class="mdl-layout__title">
            <h3>Recent posts:</h3>
        </span>
        @foreach($posts as $post)
            <div class="mdl-card mdl-shadow--2dp mdl-cell mdl-cell--12-col">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">{{ $post->title }}</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    {!! substr($post->content, 0, 150) !!} @if(strlen($post->content) > 150){{  "..." }}@endif
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <a href="{{ route('post/show', ['id' => $post->id]) }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                        Read More
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@stop
