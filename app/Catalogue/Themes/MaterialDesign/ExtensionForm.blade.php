<div id="form-{{ $element->getUuid() }}">
    @foreach($element->getInputs() as $inp)
        {!! $inp->render() !!}
    @endforeach
    <div class="center">
        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" id="button-{{ $element->getUuid() }}" type="submit" data-uuid="{{ $element->getUuid() }}" data-action="{{ $element->getRoute() }}">
            {{ $element->getSubmitText() }}
        </button>
    </div>
</div>
