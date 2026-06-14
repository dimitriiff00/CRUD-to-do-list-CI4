<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;

class Usuarios extends BaseController
{
    private $modelUsuario;

    public function __construct(){
        $this->modelUsuario = new UsuariosModel();    
    }
    
    public function index()
    {
        //
    }
}
