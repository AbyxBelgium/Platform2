@extends('frontend.layouts.default')

@section('title', $title)

@section('content')
    @foreach($columns as $column)
        <div class="mdl-cell mdl-cell--6-col">
            @foreach($column->getElements() as $element)
                {!! $element->getContent() !!}
            @endforeach
        </div>
    @endforeach
@stop()

