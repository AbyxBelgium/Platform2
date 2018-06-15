<?php
/**
 * @author Pieter Verschaffelt
 */

namespace App\System;


use Parsedown;

class MarkdownConverter
{
    public function convertToHtml(string $markdown) {
        $parseDown = new Parsedown();
        return $parseDown->text($markdown);
    }
}
