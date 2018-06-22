<?php
/**
 * @author Pieter Verschaffelt
 */

namespace App\System\Page;


class Column
{
    private $elements;
    private $width;

    public function __construct($elements)
    {
        $this->elements = $elements;
    }

    public function getElements()
    {
        return $this->elements;
    }
}
