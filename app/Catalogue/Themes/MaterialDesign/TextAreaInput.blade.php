<div class="mdl-textfield mdl-js-textfield">
    <textarea class="mdl-textfield__input" type="text" rows= "{{ $element->getRows() }}" id="{{ $element->getName() }}" ></textarea>
    <label class="mdl-textfield__label" for="{{ $element->getName() }}">{{ $element->getValue() }}</label>
</div>
