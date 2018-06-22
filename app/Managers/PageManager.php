<?php
/**
 * @author Pieter Verschaffelt
 */

namespace App\Managers;


use App\Page;
use App\System\Page\Column;
use App\System\Page\Element;
use App\System\Page\PageRepresentation;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Output\ConsoleOutput;

class PageManager
{
    public function parsePageConfiguration(Page $page): PageRepresentation
    {
        // Every page has a corresponding filename (if it exists!)
        $filename = 'pages/' . $page->name . '.json';
        $contents = Storage::get($filename);
        $parsed = json_decode($contents, true);
        $columns = [];
        foreach ($parsed["columns"] as $column) {
            $elements = [];
            foreach ($column["elements"] as $element) {
                $id = $element["identifier"];
                $app = $element["app"];

                // Lookup the correct identifier by name belonging to the indicated application.
                // This means that we first have to instantiate the main class of this app. We'll use reflection for
                // this purpose.
                $mainClass = 'App\\Catalogue\\' .$app . '\\Main';
                $main = new $mainClass();

                $el = $main->getElementByIdentifier($id);
                array_push($elements, $el);
            }

            $title = "";

            if ($column["title"]) {
                $title = $column["title"];
            }

            $col = new Column($elements, $title, $column["width"]);
            array_push($columns, $col);
        }
        return new PageRepresentation($page->name, $columns);
    }
}
