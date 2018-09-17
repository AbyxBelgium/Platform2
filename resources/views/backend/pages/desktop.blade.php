@extends('backend.layouts.default')

@section('title')
    Desktop
@stop()

@section('content')
    <resource-monitor users="{{ $userCount }}" posts="{{ $postCount }}" categories="{{ $categoryCount }}" token="{{ $token }}" refresh-rate="1000"></resource-monitor>
    <resource-graph token="{{ $token }}" steps="20" refresh-rate="1000" id="resource-graph"></resource-graph>

    <div class="mdl-cell mdl-cell--12-col">
        <span class="mdl-layout__title">
            <h3>Recent posts:</h3>
        </span>
        <div>
            @include('backend.pages.post.table')
        </div>
    </div>
@stop()

@section('custom-style')
    <style>
        #post-list {
            position: inherit;
            top: 0;
        }

        #resource-graph {
            position: relative;
            top: 20px;
        }
    </style>
@stop()
