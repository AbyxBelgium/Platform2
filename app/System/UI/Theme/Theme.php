<?php
/**
 * @author Pieter Verschaffelt
 */


namespace App\System\UI\Theme;


use App\System\UI\Form;
use App\System\UI\Input\Input;

interface Theme
{
    public function renderInput(string $elementType, Input $element): string;
    public function renderForm(string $type, Form $form): string;
}
