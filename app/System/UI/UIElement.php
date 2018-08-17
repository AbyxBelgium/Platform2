<?php
/**
 * @author Pieter Verschaffelt
 */


namespace App\System\UI;


use App\Managers\ThemeManager;
use App\System\UI\Theme\Theme;

abstract class UIElement
{
    /* @var Theme */
    protected $theme;

    public function __construct() {
        $themeManager = new ThemeManager();
        $this->theme = $themeManager->getCurrentTheme();
    }

    public abstract function render(): string;
}
