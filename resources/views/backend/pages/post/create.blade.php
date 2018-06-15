@extends('backend.pages.post.form')

@section('title', 'Create new post')

@section('form-title', 'Add post:')

@section('form-action'){{ route('backend/post/store') }}@stop()

@section('form-method', 'POST')

@section('form-title'){{ old('title') }}@stop()

@section('form-content'){{ old('content') }}@stop()

@section('form-tags'){{ old('tags') }}@stop()

@section('form-submit', 'Publish post')
