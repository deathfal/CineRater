<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Repository\MovieRepository;

class MovieController extends Controller
{
    private $movieRepository;

    public function __construct()
    {
        parent::__construct();
        $this->movieRepository = new MovieRepository();
    }

    public function showMovie($id): void
    {
        $movie = $this->movieRepository->findById($id);

        if (!$movie) {
            include "Controllers/Error.php";
            $object = new \App\Controllers\Error();
            $object->page404();
            return;
        }

        $view = new View('Movie/show', "front");
        $view->assign('movie', $movie);
    }
}
