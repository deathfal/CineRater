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

        $view = new View('home', 'front');
        $view->assign('movies', $movies);
    }
    public function aboutUs(): void
    {

        $view = new View("about", "front");
    }

    public function designGuide(): void
    {
        $view = new View("designGuide", "front");
    }

}