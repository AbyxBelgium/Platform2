@extends('frontend.layouts.default')

@section('title', $title)

@section('content')
    @foreach($columns as $column)
        <div class="mdl-cell mdl-cell--{{ $column->getWidth() }}-col">
            @if($column->getTitle())
                <span class="mdl-layout__title">
                    <h3>{{ $column->getTitle() }}:</h3>
                </span>
            @endif
            @foreach($column->getElements() as $element)
                {!! $element->getContent() !!}
            @endforeach
        </div>
    @endforeach
@stop()

