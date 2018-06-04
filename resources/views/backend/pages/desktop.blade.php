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
        <div title="Memory usage" class="material-icons mdl-badge mdl-badge--overlap statistic-badge" id="mem-badge" data-badge="52%">memory</div>
        <div title="Storage usage" class="material-icons mdl-badge mdl-badge--overlap statistic-badge" id="storage-badge" data-badge="75%">storage</div>
        <div title="Current CPU load" class="material-icons mdl-badge mdl-badge--overlap statistic-badge" id="cpu-badge" data-badge="10%">settings_applications</div>
    </div>

    <div class="mdl-cell mdl-cell--12-col">
                <span class="mdl-layout__title">
                    <h3>Recent posts:</h3>
                </span>
        <div>
            <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp" id="post-list" data-upgraded=",MaterialDataTable">
                <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">Title</th>
                        <th class="mdl-data-table__cell--non-numeric action-col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div class="center nav-buttons">
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect small-button" id="post-previous-btn" data-upgraded=",MaterialButton">
                <span class="icon icon-keyboard_arrow_left"></span>
                <span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>
            <a class="no-link" id="post-start">000</a>
            <a class="no-link"> - </a>
            <a class="no-link" id="post-end">015</a>
            <a class="no-link"> from </a>
            <a class="no-link" id="post-total">017</a>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect small-button" id="post-next-btn" data-upgraded=",MaterialButton">
                <span class="icon icon-keyboard_arrow_right"></span>
                <span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>
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
