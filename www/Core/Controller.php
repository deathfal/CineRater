<?php

namespace App\Core;

class Controller
{
    protected $verificator;

    public function __construct()
    {
        $this->verificator = new FormVerificator();
    }

    /**
     * Redirect to a different URL
     */
    protected function redirect(string $url)
    {
        header("Location: $url");
        exit();
    }
}
