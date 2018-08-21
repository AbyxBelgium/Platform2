<?php
/**
 * @author Pieter Verschaffelt
 */


namespace App\Catalogue\Themes\MaterialDesign;


use App\System\UI\Form;
use App\System\UI\Input\Input;
use App\System\UI\Theme\Theme;
use Illuminate\Support\Facades\View;

class ThemeMain implements Theme
{
    public function renderInput(string $elementType, Input $element): string
    {
        return View::make("MaterialDesign.$elementType", ['element' => $element]);
    }

    public function renderForm(string $type, Form $form): string
    {
        return View::make("MaterialDesign.$type", ['element' => $form]);
    }
}
