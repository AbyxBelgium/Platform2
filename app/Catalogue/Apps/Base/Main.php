<?php
/**
 * Base app that's available in every installation of Platform.
 *
 * @author Pieter Verschaffelt
 */

namespace App\Catalogue\Apps\Base;


use App\Catalogue\App;
use App\Catalogue\Route\PostRoute;
use App\System\Page\Element;
use App\System\UI\ExtensionForm;
use App\System\UI\Form;
use App\System\UI\Input\TextInput;
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
        $htmlContentForm = new ExtensionForm('Save', appRoute("Base", "backend/html-content/create"));
        $htmlContentForm->addInput(new TextInput('Content'));
        array_push($output, new Element('Any HTML content', View::make('Base.any-html-content'), $this, $htmlContentForm));
        return $output;
    }

    public function getRoutes(): array
    {
        return [
            new PostRoute('/html-content/create', 'HTMLContentController@create', 'backend/html-content/create')
        ];
    }
}
