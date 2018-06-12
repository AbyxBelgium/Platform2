@extends('backend.pages.category.form')

@section('title', 'Edit category')

@section('form-title', 'Edit category:')

@section('form-method', 'POST')

@section('form-action'){{ route('backend/category/update', ['id' => $category->id]) }}@stop()

@section('form-special-fields')
    {{ method_field('PUT') }}
@stop()

@section('form-name')
@if(old('name')){{ old('name') }}@else{{ $category->name }}@endif
@stop()

@section('form-icon')
@if(old('icon')){{ old('icon') }}@else{{ $category->icon }}@endif
@stop()

@section('form-submit', 'Update category')
