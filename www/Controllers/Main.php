<?php
namespace App\Controllers;

use App\Core\View;

class Main{

    public function home(): void
    {
       $view = new View("home", "front");
    }

    public function aboutUs(): void
    {
        echo "ceci est la page a propos";
    }

}