<?php
/**
 * @author Pieter Verschaffelt
 */


namespace App\Managers;


use App\Catalogue\Themes\MaterialDesign\ThemeMain;
use App\System\UI\Theme\Theme;

class ThemeManager
{
    public function getCurrentTheme(): Theme
    {
        return new ThemeMain();
    }
}
