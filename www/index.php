<?php

namespace App;

require __DIR__ . '/../vendor/autoload.php';

session_start();



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

$routeFound = false;

foreach ($listOfRoutes as $route => $params) {
    // Convertir la route dynamique en expression régulière (ex: /user/{id})
    $routePattern = preg_replace('/\{[a-z]+\}/', '([a-zA-Z0-9_\-]+)', $route);
    $routePattern = str_replace('/', '\/', $routePattern);

    if (preg_match('/^' . $routePattern . '$/', $uri, $matches)) {
        array_shift($matches); // Retirer le premier match qui est l'URL entière

        if (!empty($params["controller"]) && !empty($params["action"])) {
            $controller = $params["controller"];
            $action = $params["action"];

            if (file_exists("Controllers/" . $controller . ".php")) {
                include "Controllers/" . $controller . ".php";
                $controller = "App\\Controllers\\" . $controller;
                
                if (class_exists($controller)) {
                    $object = new $controller();
                    
                    if (method_exists($object, $action)) {
                        // Appel de l'action avec les paramètres dynamiques
                        call_user_func_array([$object, $action], $matches);
                    } else {
                        die("L'action " . $action . " n'existe pas");
                    }
                } else {
                    die("Le class controller " . $controller . " n'existe pas");
                }
            } else {
                die("Le fichier controller " . $controller . " n'existe pas");
            }
        } else {
            die("La route " . $route . " ne possède pas de controller ou d'action");
        }

        $routeFound = true;
        break;
    }
}

if (!$routeFound) {
    include "Controllers/Error.php";
    $object = new \App\Controllers\Error();
    $object->page404();
}
