<?php
namespace App\Controllers;

use App\Core\View;

class Error {
    public function page404(): void
    {
        new View('Error/error', 'error');
        http_response_code(404);
    }

}

