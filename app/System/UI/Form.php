<?php
/**
 * @author Pieter Verschaffelt
 */

namespace App\System\UI;


use App\System\UI\Input\Input;
use ReflectionClass;

class Form extends UIElement
{
    private $submitText;
    private $inputs = [];
    private $route;

    /**
     * @param string $submitText Text that's displayed for the submit-button of this form.
     * @param string $route The route to which all data is submitted.
     */
    public function __construct(string $submitText, string $route)
    {
        parent::__construct();
        $this->submitText = $submitText;
        $this->route = $route;
    }

    public function addInput(Input $input) {
        array_push($this->inputs, $input);
    }

    /**
     * @return Input[]
     */
    public function getInputs() {
        return $this->inputs;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @return string
     */
    public function getSubmitText(): string
    {
        return $this->submitText;
    }

    public function render(): string
    {
        $reflected = new ReflectionClass($this);
        return $this->theme->renderForm($reflected->getShortName(), $this);
    }
}
