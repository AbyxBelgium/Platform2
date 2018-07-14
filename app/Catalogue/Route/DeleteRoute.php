<?php


namespace App\Catalogue\Route;


use App\Catalogue\AppRoute;

class DeleteRoute extends AppRoute
{
    public function getType(): string
    {
        return "DELETE";
    }
}
