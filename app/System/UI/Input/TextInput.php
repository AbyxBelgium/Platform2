<?php
/**
 * Represents an input box for a very simple text element.
 *
 * @author Pieter Verschaffelt
 */


namespace App\System\UI\Input;


class TextInput extends Input {
    private $value;

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }
}
