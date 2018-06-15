<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" id="post-list">
    <thead>
    <tr>
        <th class="mdl-data-table__cell--non-numeric">Title</th>
        <th class="mdl-data-table__cell--non-numeric">Category</th>
        <th class="mdl-data-table__cell--non-numeric action-col">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
        <tr>
            <td class="resizable-col">{{ $post->title }}</td>
            <td class="resizable-col">{{ \App\Category::find($post->category_id)->name }}</td>
            <td class="action-col">
                <form method="POST" class="delete-form" action="{{ route('backend/post/destroy', ['id' => $post->id]) }}">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button type="submit"><span class="icon icon-delete icon-colored" title="Delete post"></span></button>
                </form>
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
