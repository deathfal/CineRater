<?php

namespace App;

require __DIR__ . '/../vendor/autoload.php';

session_start();


var_dump($_SESSION); 

spl_autoload_register("App\myAutoloader");
function myAutoloader($class)
{
    $file = str_replace("App\\", "", $class);
    $file = str_replace("\\", "/", $file);
    $file .= ".php";
    if (file_exists($file)) {
        include $file;
    } else {
        echo "Autoloader: Could not load $file<br>";
    }
}

$uri = strtolower($_SERVER["REQUEST_URI"]);
$uri = strtok($uri, "?");
if (strlen($uri) > 1)
    $uri = rtrim($uri, "/");

$fileRoute = "routes.yaml";
if (file_exists($fileRoute)) {
    $listOfRoutes = yaml_parse_file($fileRoute);
} else {
    die("Le fichier de routing n'existe pas");
}

if (!empty($listOfRoutes[$uri])) {
    if (!empty($listOfRoutes[$uri]["controller"])) {
        if (!empty($listOfRoutes[$uri]["action"])) {

            $controller = $listOfRoutes[$uri]["controller"];
            $action = $listOfRoutes[$uri]["action"];

            if (file_exists("Controllers/" . $controller . ".php")) {
                include "Controllers/" . $controller . ".php";
                $controller = "App\\Controllers\\" . $controller;
                if (class_exists($controller)) {
                    $object = new $controller();
                    if (method_exists($object, $action)) {
                        $object->$action();
                    } else {
                        die("L'action' " . $action . " n'existe pas");
                    }
                } else {
                    die("Le class controller " . $controller . " n'existe pas");
                }
            } else {
                die("Le fichier controller " . $controller . " n'existe pas");
            }

        } else {
            die("La route " . $uri . " ne possède pas d'action dans le fichier " . $fileRoute);
        }
    } else {
        die("La route " . $uri . " ne possède pas de controller dans le fichier " . $fileRoute);
    }
} else {
    include "Controllers/Error.php";
    $object = new \App\Controllers\Error();
    $object->page404();
}

