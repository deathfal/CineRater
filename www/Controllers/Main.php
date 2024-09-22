<?php
namespace App\Controllers;

use App\Core\View;
use App\Repository\MovieRepository;

class Main
{

    public function home(): void
    {
        $movieRepository = new MovieRepository();
        $movies = $movieRepository->findAll();

        $view = new \App\Core\View('home', 'front');
        $view->assign('movies', $movies);
    }
    public function aboutUs(): void
    {
        echo "ceci est la page a propos";
    }

    public function designGuide(): void
    {
        $view = new View("designGuide", "front");
    }

}