<?php
/**
 * @author Pieter Verschaffelt
 */

namespace App\Managers;


class AppManager
{
    public function getAllExtensions(): array
    {
        $subdirs = array_filter(glob('*'), 'is_dir');
        $elements = [];
        foreach($subdirs as $dir) {
            $mainClass = 'App\\Catalogue\\' .$dir . '\\Main';
            $instance = new $mainClass();
            $elements = array_merge($elements, $instance->getElements());
        }
        return $elements;
    }
}
