@extends('backend.layouts.default')
@section('title')
    Desktop
@stop()
@section('content')
    <div class="mdl-cell mdl-cell--12-col statistics">
        <div title="Registered users" class="material-icons mdl-badge mdl-badge--overlap statistic-badge" data-badge="{{ $userCount }}">account_box</div>
        <div title="Total posts" class="material-icons mdl-badge mdl-badge--overlap statistic-badge" data-badge="{{ $postCount }}">mode_comment</div>
        <div title="Categories" class="material-icons mdl-badge mdl-badge--overlap statistic-badge" data-badge="{{ $categoryCount }}">toc</div>
        <div title="Platform version" class="material-icons mdl-badge mdl-badge--overlap statistic-badge" data-badge="1.3">update</div>
        <div title="Memory usage" class="material-icons mdl-badge mdl-badge--overlap statistic-badge" id="mem-badge" data-badge="{{ $resourceManager->getMemoryLoad() }}%">memory</div>
        <div title="Storage usage" class="material-icons mdl-badge mdl-badge--overlap statistic-badge" id="storage-badge" data-badge="{{ $resourceManager->getStorageUsage() }}%">storage</div>
        <div title="Current CPU load" class="material-icons mdl-badge mdl-badge--overlap statistic-badge" id="cpu-badge" data-badge="{{ $resourceManager->getCPULoad()  }}%">settings_applications</div>
    </div>

    <div class="mdl-cell mdl-cell--12-col">
        <span class="mdl-layout__title">
            <h3>Recent posts:</h3>
        </span>
        <div>
            @include('backend.pages.post.table')
        </div>
    </div>
@stop()

@section('javascript')
    <script>
        let $cpuBadge = $("#cpu-badge");
        let $memBadge = $("#mem-badge");
        let $storageBadge = $("#storage-badge");

        let refresh = function() {
            $.ajax("/api/system-resources")
                .done(function(data) {
                    $memBadge.attr("data-badge", data["memory"] + "%");
                    $cpuBadge.attr("data-badge", data["cpu"] + "%");
                    $storageBadge.attr("data-badge", data["storage"] + "%");
                })
        };

        setInterval(refresh, 5000);
    </script>
@stop()
