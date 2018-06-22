<?php
/**
 * @author Pieter Verschaffelt
 */

namespace App\System\Page;


use App\Catalogue\Sample\Main;
use Illuminate\Support\Facades\View;

class Page
{
    private $title;
    private $containers = [];

    public function __construct(string $title, array $containers)
    {
        $this->title = $title;
        $this->containers = $containers;
    }

    public function createView(): string
    {
        $temp = new Main();
        return $temp->getElements()[0]->getContent();
        //return View::make('frontend.pages.page', ['title' => $this->title]);
    }
}
