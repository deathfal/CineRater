<?php

namespace App\Core;

use PDO;
use PDOException;

class DB
{
    private static ?DB $instance = null;
    private PDO $connection;

    private function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        try {
            $dsn = 'pgsql:host=postgres;port=5432;dbname=cinerater-db';
            $username = 'adam';
            $password = 'el-reverso';
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection error: " . $e->getMessage());
        }
    }

    public static function getInstance(): DB
    {
        if (self::$instance === null) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        if ($this->connection === null) {
            $this->connect();
        }
        return $this->connection;
    }

    public function create(string $table, array $data): bool
    {
        try {
            $fields = implode(', ', array_keys($data));
            $values = implode(', ', array_map(fn($value) => ":$value", array_keys($data)));
            
            $sql = "INSERT INTO $table ($fields) VALUES ($values)";
            $stmt = $this->getConnection()->prepare($sql);

            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error creating record: " . $e->getMessage();
            return false;
        }
    }

    public function update(string $table, array $data, array $conditions): bool
    {
        try {
            $setFields = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));
            $whereClause = implode(' AND ', array_map(fn($key) => "$key = :cond_$key", array_keys($conditions)));

            $sql = "UPDATE $table SET $setFields WHERE $whereClause";
            $stmt = $this->connection->prepare($sql);

            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            foreach ($conditions as $key => $value) {
                $stmt->bindValue(":cond_$key", $value);
            }

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error updating record: " . $e->getMessage();
            return false;
        }
    }

    public function delete(string $table, array $conditions): bool
    {
        try {
            $whereClause = implode(' AND ', array_map(fn($key) => "$key = :$key", array_keys($conditions)));
            
            $sql = "DELETE FROM $table WHERE $whereClause";
            $stmt = $this->connection->prepare($sql);

            foreach ($conditions as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error deleting record: " . $e->getMessage();
            return false;
        }
    }

    public function find(string $table, array $conditions): ?array
    {
        try {
            $whereClause = implode(' AND ', array_map(fn($key) => "$key = :$key", array_keys($conditions)));
    
            $sql = "SELECT * FROM $table WHERE $whereClause";
            $stmt = $this->connection->prepare($sql);
    
            foreach ($conditions as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
    
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Check if fetch returned false (meaning no records were found)
            return $result !== false ? $result : null;
        } catch (PDOException $e) {
            echo "Error finding record: " . $e->getMessage();
            return null;
        }
    }
    
    public function count(string $table): int
    {
        try {
            $stmt = $this->connection->query("SELECT COUNT(*) FROM $table");
            return (int) $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo "Error counting records: " . $e->getMessage();
            return 0;
        }
    }

    public function findAll(string $table): array
    {
        try {
            $stmt = $this->connection->query("SELECT * FROM $table");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error finding all records: " . $e->getMessage();
            return [];
        }
    }
}
