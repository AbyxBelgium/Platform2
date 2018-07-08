<?php
/**
 * Sample application / extension for the Platform2 CMS.
 *
 * @author Pieter Verschaffelt
 */

namespace App\Catalogue\Sample;


use App\Catalogue\App;
use App\System\Page\Element;
use Illuminate\Support\Facades\View;

class Main extends App
{
    public function getName(): string
    {
        return "Sample";
    }

    public function getElements(): array
    {
        $output = [];
        array_push($output, new Element('Sample paragraph', View::make('Sample.sample-paragraph'), $this));
        return $output;
    }
}
