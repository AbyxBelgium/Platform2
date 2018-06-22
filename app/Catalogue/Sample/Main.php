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

class Main implements App
{
    public function getName(): string
    {
        return "Sample";
    }

    public function getElements(): array
    {
        $output = [];
        array_push($output, new Element('main-content', View::make('Sample.main-content')));
        return $output;
    }
}
