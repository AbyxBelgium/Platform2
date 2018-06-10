@extends('backend.layouts.default')
@section('title')
    Desktop
@stop()
@section('content')
    <div class="mdl-cell mdl-cell--12-col statistics">
        <div title="Registered users" class="material-icons mdl-badge mdl-badge--overlap statistic-badge" data-badge="2">account_box</div>
        <div title="Total posts" class="material-icons mdl-badge mdl-badge--overlap statistic-badge" data-badge="17">mode_comment</div>
        <div title="Categories" class="material-icons mdl-badge mdl-badge--overlap statistic-badge" data-badge="2">toc</div>
        <div title="Total pageviews" class="material-icons mdl-badge mdl-badge--overlap statistic-badge" data-badge="312">remove_red_eye</div>
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
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" id="post-list">
                <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">Title</th>
                    <th class="mdl-data-table__cell--non-numeric action-col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td class="resizable-col">{{ $post->title }}</td>
                        <td class="action-col">
                            <a class="action" href="{{ route('backend/post/edit', ['id' => $post->id]) }}">
                                <span class="icon icon-mode_edit icon-colored" title="Edit post"></span>
                            </a>
                            <a class="action" href="{{ route('post/show', ['id' => $post->id]) }}">
                                <span class="icon icon-pageview icon-colored" title="View post"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mdl-cell mdl-cell--12-col">
        <span class="mdl-layout__title">
            <h3>Security:</h3>
        </span>

        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
            <thead>
            <tr>
                <th>User</th>
                <th>Login date</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
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
