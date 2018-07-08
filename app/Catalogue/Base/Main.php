<?php
/**
 * Base app that's available in every installation of Platform.
 *
 * @author Pieter Verschaffelt
 */

namespace App\Catalogue\Base;


use App\Catalogue\App;
use App\System\Page\Element;
use Illuminate\Support\Facades\View;

class Main extends App
{
    public function getName(): string
    {
        return "Base";
    }

    public function getElements(): array
    {
        $output = [];
        array_push($output, new Element('Any HTML content', View::make('Base.any-html-content'), $this, View::make('Base.any-html-content-backend')));
        return $output;
    }
}
