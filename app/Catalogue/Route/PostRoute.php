<?php


namespace App\Catalogue\Route;


use App\Catalogue\AppRoute;

class PostRoute extends AppRoute
{
    public function getType(): string
    {
        return "POST";
    }
}
