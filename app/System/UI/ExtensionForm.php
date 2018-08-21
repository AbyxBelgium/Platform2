<?php
/**
 * @author Pieter Verschaffelt
 */


namespace App\System\UI;


class ExtensionForm extends Form {
    private $uuid;

    public function __construct(string $submitText, string $route)
    {
        parent::__construct($submitText, $route);
        $this->uuid = uniqid();
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }
}
