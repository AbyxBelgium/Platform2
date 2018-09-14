@extends('backend.pages.page.form')

@section('title', 'Edit page')

@section('mode', 'edit');

@section('page-title', $page->name)

@section('left-column-title', $pageRepresentation->getContainers()[0]->getTitle())
@section('right-column-title', $pageRepresentation->getContainers()[0]->getTitle())
