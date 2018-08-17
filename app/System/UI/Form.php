<?php
/**
 * @author Pieter Verschaffelt
 */

namespace App\System\UI;


use App\Catalogue\AppRoute;
use App\System\UI\Input\Input;

class Form
{
    private $submitText;
    private $inputs = [];
    private $route;

    /**
     * @param string $submitText Text that's displayed for the submit-button of this form.
     * @param AppRoute $route The route to which all data is submitted.
     */
    public function __construct(string $submitText, AppRoute $route)
    {
        $this->submitText = $submitText;
        $this->route = $route;
    }

    public function addInput(Input $input) {
        array_push($this->inputs, $input);
    }

    /**
     * @return Input[]
     */
    public function getAllInputs() {
        return $this->inputs;
    }
}
