<div class="mdl-textfield mdl-js-textfield">
    <label class="mdl-textfield__label" for="{{ $element->getName() }}">{{ $element->getValue() }}</label>
    <textarea class="mdl-textfield__input" rows= "{{ $element->getRows() }}" id="{{ $element->getName() }}" ></textarea>
</div>
