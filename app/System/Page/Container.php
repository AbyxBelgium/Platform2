<?php
/**
 * @author Pieter Verschaffelt
 */

namespace App\System\Page;


class Container
{
    private $elements;

    public function __construct($elements)
    {
        $this->elements = $elements;
    }
}
