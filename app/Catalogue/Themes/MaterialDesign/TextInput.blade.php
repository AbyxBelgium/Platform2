<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <label class="mdl-textfield__label" for="{{ $element->getName() }}">{{ $element->getName()}}:</label>
    <input class="mdl-textfield__input" type="text" id="{{ $element->getName() }}" name="{{ $element->getName() }}" value="{{ $element->getValue() }}">
</div>
