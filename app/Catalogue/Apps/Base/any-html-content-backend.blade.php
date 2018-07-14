<p>
    <form action="{{ appRoute("Base", "/html-content/create") }}" method="POST">
        @csrf
        <label for="content">Content</label>
        <input type="text" name="content" id="content" />
        <input type="submit" value="Send!" />
    </form>
</p>
