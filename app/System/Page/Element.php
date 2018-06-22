<?php
/**
 * @author Pieter Verschaffelt
 */

namespace App\System\Page;


class Element
{
    private $content;
    private $identifier;

    public function __construct($identifier, $content)
    {
        $this->identifier = $identifier;
        $this->content = $content;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function getContent()
    {
        return $this->content;
    }
}
