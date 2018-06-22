<?php
/**
 * @author Pieter Verschaffelt
 */

namespace App\Catalogue;


interface App
{
    public function getName(): string;
    public function getElements(): array;
}
