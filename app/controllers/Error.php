<?php

namespace ppe4\controllers;

class Error
{
    public function fausse_url(): void
    {
        require_once ROOT . "app/views/404.php";
    }
}