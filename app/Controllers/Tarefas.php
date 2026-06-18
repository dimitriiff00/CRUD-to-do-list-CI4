<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TarefasModel;

class Tarefas extends BaseController
{
    private $modelTarefas;

    public function __construct()
    {
        $this->modelTarefas = new TarefasModel();
    }


    public function index()
    {
        $dados['tarefas'] = $this->modelTarefas->pesquisarTarefas();
            var_dump($dados['tarefas']);

        return view('tarefas/index', $dados);
    }

    public function cadastraTarefa()
    {
        $dados = $this->request->getJSON(true);

        if (!$dados) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'erro',
                    'mensagem' => 'Dados não enviados'
                ]);
        }

        $response = $this->modelTarefas->inserirTarefa($dados);

        if (!$response['status']) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON([
                    'status' => 'erro',
                    'mensagem' => $response['mensagem'] ?? 'Erro ao cadastrar tarefa'
                ]);
        }

        return $this->response
            ->setStatusCode(201)
            ->setJSON([
                'status' => 'sucesso',
                'id' => $response['id']
            ]);
    }
}
