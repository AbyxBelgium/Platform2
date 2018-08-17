<?php
/**
 * @author Pieter Verschaffelt
 */

namespace App\System\UI\Input;


use App\System\UI\Theme\Theme;
use App\System\UI\UIElement;
use ReflectionClass;

abstract class Input extends UIElement
{
    private $name;

    public function __construct($name)
    {
        parent::__construct();
        $this->name = $name;
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
        $reflected = new ReflectionClass($this);
        return $this->theme->renderInput($reflected->getShortName(), $this);
    }
}
