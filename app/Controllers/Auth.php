<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsuariosModel;

class Auth extends BaseController
{
    private $modelUsuario;

    public function __construct()
    {
        $this->modelUsuario = new UsuariosModel();
    }

    public function login()
    {
        return view('auth/login');
    }


    public function autenticar(){
        $usuario = $this->request->getPost('usuario');
        $senha_digitada = $this->request->getPost('senha');

        $valor = $this->modelUsuario->buscarUsuario($usuario);

        if($valor === null)
        {
            session()->setFlashdata('erro', 'Usuário ou senha incorretos.');
            return redirect()->to('auth/login');
            
        }

        $validaPassword = password_verify($senha_digitada, $valor['senha']);

        if(!$validaPassword)
        {
            session()->setFlashdata('erro', 'Usuário ou senha incorretos.');
            return redirect()->to('auth/login');
        } else 
        {
            session()->set([
                'id'     => $valor['id'],
                'nome'   => $valor['nome'],
                'tipo'   => $valor['tipo'],
                'logado' => true
            ]);

            return redirect()->to('tarefas');
        }

    }

    public function index()
    {
        //
    }
}
