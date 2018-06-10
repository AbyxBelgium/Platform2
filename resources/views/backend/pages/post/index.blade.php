@extends('backend.layouts.default')

@section('title')
    All posts
@stop()

@section('content')
    <div class="mdl-cell mdl-cell--12-col">
        <span class="mdl-layout__title">
            <h3>Posts:</h3>
        </span>

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
        {{ $posts->links('backend.includes.pagination') }}
    </div>
@stop()
