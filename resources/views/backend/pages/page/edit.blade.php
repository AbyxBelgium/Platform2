@extends('backend.pages.page.form')

@section('title', 'Edit page')

@section('mode', 'edit');

@section('page-title', $page->name)

@section('left-column-title', $pageRepresentation->getContainers()[0]->getTitle())
@section('right-column-title', $pageRepresentation->getContainers()[1]->getTitle())

@section('javascript-extra')
    <script>
        $('#left-column-width').val("{{ $pageRepresentation->getContainers()[0]->getWidth() }}");
        $('#right-column-width').val("{{ $pageRepresentation->getContainers()[1]->getWidth() }}");
    </script>
@stop()
