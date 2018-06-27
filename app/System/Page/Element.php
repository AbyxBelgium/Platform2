<?php
/**
 * @author Pieter Verschaffelt
 */

namespace App\System\Page;


use App\Catalogue\App;

class Element
{
    private $content;
    private $identifier;
    private $app;

    public function __construct($identifier, $content, $app)
    {
        $this->identifier = $identifier;
        $this->content = $content;
        $this->app = $app;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getApp(): App
    {
        return $this->app;
    }
}
