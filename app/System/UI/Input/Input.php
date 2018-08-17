<?php
/**
 * @author Pieter Verschaffelt
 */

namespace App\System\UI\Input;


use App\System\UI\Theme\Theme;

abstract class Input
{
    private $name;
    private $theme;

    public function __construct($name, Theme $theme)
    {
        $this->name = $name;
        $this->theme = $theme;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function render(): string
    {
        return $this->theme->render(get_class($this));
    }
}
