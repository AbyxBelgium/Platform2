<?php
/**
 * @author Pieter Verschaffelt
 */

namespace App\Managers;


class AppManager
{
    public function getAllElements(): array
    {
        $subdirs = array_filter(glob('../app/Catalogue/*'), 'is_dir');
        $elements = [];
        foreach($subdirs as $dir) {
            $dir = basename($dir);
            $mainClass = 'App\\Catalogue\\' .$dir . '\\Main';
            $instance = new $mainClass();
            $elements[$dir] = $instance->getElements();
        }
        return $elements;
    }
}
