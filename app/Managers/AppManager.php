<?php
/**
 * @author Pieter Verschaffelt
 */

namespace App\Managers;


use App\Catalogue\App;
use App\Http\Controllers\App\AppController;

class AppManager
{
    public function getApp(string $name): App
    {
        $mainClass = 'App\\Catalogue\\' . $name . '\\Main';
        return new $mainClass();
    }

    public function getController(App $app, string $controllerName): AppController
    {
        $controller = 'App\\Catalogue\\' . $app . '\\' . $controllerName;
        return new $controller();
    }

    public function getAllElements(): array
    {
        $subdirs = array_filter(glob('../app/Catalogue/*'), 'is_dir');
        $elements = [];
        foreach($subdirs as $dir) {
            $dir = basename($dir);
            $instance = $this->getApp($dir);
            $elements[$dir] = $instance->getElements();
        }
        return $elements;
    }
}
