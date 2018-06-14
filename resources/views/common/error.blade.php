@if($errors->count())
    <div class="error">
        <p>Following errors occurred while processing your request:</p>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
