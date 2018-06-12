@extends('backend.pages.category.form')

@section('title', 'Create new category')

@section('form-title', 'Add category:')

@section('form-method', 'POST')

@section('form-action'){{ route('backend/category/store') }}@stop()

@section('form-name'){{ old('name') }}@stop()

@section('form-icon'){{ old('icon') }}@stop()

@section('form-submit', 'Create category')
