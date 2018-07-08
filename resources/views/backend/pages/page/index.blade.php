@extends('backend.layouts.default')

@section('title', 'All pages')

@section('content')
    <div class="mdl-cell mdl-cell--12-col">
        <span class="mdl-layout__title">
            <h3>Pages:</h3>
        </span>

        <a class="mdl-button mdl-js-button mdl-js-ripple-effect create-button" href="{{ route('backend/page/create') }}">
            <span class="icon icon-add icon-fix-position"></span> Add page
        </a>

        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp addable-table-list" id="page-list">
            <thead>
            <tr>
                <th class="mdl-data-table__cell--non-numeric">Name</th>
                <th class="mdl-data-table__cell--non-numeric action-col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pages as $page)
                <tr>
                    <td class="resizable-col">
                        {{ $page->name }}
                    </td>
                    <td class="action-col">
                        <form method="POST" class="delete-form" action="{{ route('backend/page/destroy', ['id' => $page->id]) }}">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit"><span class="icon icon-delete icon-colored" title="Delete page"></span></button>
                        </form>
                        <a class="action" href="{{ route('backend/page/edit', ['id' => $page->id]) }}">
                            <span class="icon icon-mode_edit icon-colored" title="Edit category"></span>
                        </a>
                        <a class="action" href="{{ route('page/show', ['id' => $page->id]) }}">
                            <span class="icon icon-pageview icon-colored" title="View page"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $pages->links('backend.includes.pagination') }}
    </div>
@stop()
