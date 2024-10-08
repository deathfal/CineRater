<?php

namespace App\Repository;

use App\Core\DB;
use App\Models\Movie;

class MovieRepository
{
    protected $db;

    public function __construct()
    {
        $this->db = DB::getInstance();

    }

    public function findById(string $id): ?Movie
    {
        $data = $this->db->find('movies', ['id' => $id]);

        if ($data) {
            $movie = new Movie();
            $movie->setId($data['id']);
            $movie->setTitle($data['title']);
            $movie->setDescription($data['description']);
            $movie->setImage($data['image']);
            return $movie;
        }

        return null;
    }

    public function searchByTitle(string $title): array
    {
        $stmt = $this->db->prepare("SELECT * FROM movies WHERE title ILIKE :title");
        $stmt->bindValue(':title', "%$title%");
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findAll(): array
    {
        $movies = [];
        $data = $this->db->findAll('movies');

        foreach ($data as $row) {
            $movie = new Movie();
            $movie->setId($row['id']);
            $movie->setTitle($row['title']);
            $movie->setDescription($row['description']);
            $movie->setImage($row['image']);
            $movies[] = $movie;
        }

        return $movies;
    }

    public function save(Movie $movie): bool
    {
        $existingMovie = $this->findById($movie->getId());

        if ($existingMovie) {
            return $this->db->update('movies', [
                'title' => $movie->getTitle(),
                'description' => $movie->getDescription(),
                'image' => $movie->getImage()
            ], ['id' => $movie->getId()]);
        } else {
            return $this->db->create('movies', [
                'id' => $movie->getId(),
                'title' => $movie->getTitle(),
                'description' => $movie->getDescription(),
                'image' => $movie->getImage()
            ]);
        }
    }

    public function delete(string $id): bool
    {
        return $this->db->delete('movies', ['id' => $id]);
    }

    public function search(string $query): array
    {
        $sql = "SELECT id, title, description, image FROM movies WHERE title ILIKE :query";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':query', "%$query%");
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
