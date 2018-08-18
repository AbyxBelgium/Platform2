<form method="POST" action="{{ $element->getRoute() }}">
    @foreach($element->getInputs() as $inp)
        {!! $inp->render() !!}
    @endforeach
    <div class="center">
        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" id="publish-button" type="submit">
            {{ $element->getSubmitText() }}
        </button>
    </div>
</form>
