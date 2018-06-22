<?php
/**
 * @author Pieter Verschaffelt
 */

namespace App\Catalogue;


use App\System\Page\Element;

abstract class App
{
    public abstract function getName(): string;
    public abstract function getElements(): array;

    public function getElementByIdentifier(string $identifier): Element
    {
        foreach ($this->getElements() as $element) {
            if ($element->getIdentifier() == $identifier) {
                return $element;
            }
        }
        return null;
    }
}
