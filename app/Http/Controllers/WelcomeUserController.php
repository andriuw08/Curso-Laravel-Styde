<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeUserController extends Controller
{
    public function index($name, $nickname = null) {
        $name = ucfirst($name); // Con este metodo colocamos el name en mayusculas
    
        if($nickname) {
            return "Bienvenido {$name}, tu apodo es {$nickname}";
        } else {
            return "Bienvenido {$name}";
        }
    }
}
