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
    private $backendContent;

    public function __construct($identifier, $content, $app, $backendContent = "")
    {
        $this->identifier = $identifier;
        $this->content = $content;
        $this->app = $app;
        $this->backendContent = $backendContent;
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

    public function getBackendContent()
    {
        return $this->backendContent;
    }
}
