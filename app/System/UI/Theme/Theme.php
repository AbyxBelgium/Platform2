<?php
/**
 * @author Pieter Verschaffelt
 */


namespace App\System\UI\Theme;


interface Theme
{
    public function render(string $elementType): string;
}
