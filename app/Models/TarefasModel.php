<?php

namespace App\Models;

use CodeIgniter\Model;
use PhpParser\Node\Stmt\TryCatch;

class TarefasModel extends Model
{
    protected $table            = 'tarefas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'titulo',
        'detalhes',
        'status',
        'prazo'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'titulo' => 'required|min_length[1]|max_length[200]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function pesquisarTarefas()
    {
        try {
            return $this->findAll();
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            echo $e->getMessage();
            return null;

        }
    }

    public function inserirTarefa($dados)
    {
        try {
            $id = $this->insert($dados);

            if ($id === false) {
                return $this->errors();
            }

            return [
                'status' => true,
                'id' => $id
            ];
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());

            return [
                'status' => false,
                'mensagem' => $e->getMessage()
            ];
        }
    }
}
