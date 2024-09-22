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

    public function search()
    {
        if (isset($_GET['query'])) {
            $query = $_GET['query'];

            $movies = $this->movieRepository->search($query);

            header('Content-Type: application/json');
            echo json_encode($movies);
        } else {
            header('Content-Type: application/json');
            echo json_encode([]);
        }
    }

    public function searchByTitle(): void
    {
        $title = $_GET['title'] ?? '';
        if (!empty($title)) {
            $movies = $this->movieRepository->searchByTitle($title);
        } else {
            $movies = [];
        }

        $view = new View('Search/results', 'front');
        $view->assign('movies', $movies);
    }

}
