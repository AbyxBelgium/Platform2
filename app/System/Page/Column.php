<?php
/**
 * @author Pieter Verschaffelt
 */

namespace App\System\Page;


class Column
{
    private $elements;
    private $width;
    private $title;

    public function __construct($elements, $title, $width)
    {
        $this->elements = $elements;
        $this->title = $title;
        $this->width = $width;
    }

    public function getElements(): array
    {
        return $this->elements;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
