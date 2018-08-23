<?php
/**
 * @author Pieter Verschaffelt
 */

namespace App\Catalogue;

abstract class AppController {
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }
}
