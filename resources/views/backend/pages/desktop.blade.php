@extends('backend.layouts.default')

@section('title')
    Desktop
@stop()

@section('content')
    <resource-monitor users="{{ $userCount }}" posts="{{ $postCount }}" categories="{{ $categoryCount }}" token="{{ $token }}" refresh-rate="1000"></resource-monitor>
    <resource-graph token="{{ $token }}" id="resource-graph"></resource-graph>

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

@section('javascript')
    <script>
        let $cpuBadge = $("#cpu-badge");
        let $memBadge = $("#mem-badge");
        let $storageBadge = $("#storage-badge");

        let token = "{{ $token }}";
        let refreshRate = 1000;

        let steps = 20;
        let cpuData = [];
        let memData = [];
        let storageData = [];

        let currentTime = (new Date()).getTime();

        for (let i = 0; i < steps; i++) {
            cpuData.push([currentTime - (steps - i) * refreshRate, 0]);
            memData.push([currentTime - (steps - i) * refreshRate, 0]);
            storageData.push([currentTime - (steps - i) * refreshRate, 0]);
        }
    </script>
@stop()
