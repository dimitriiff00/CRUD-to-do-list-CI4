<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsuariosTable extends Migration
{
    public function up()
{
    $this->forge->addField([
        'id' => [
            'type'           => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'auto_increment' => true,
        ],
        'nome' => [
            'type'       => 'VARCHAR',
            'constraint' => 100,
        ],
        'sobrenome' => [
            'type'       => 'VARCHAR',
            'constraint' => 100,
        ],
        'usuario' => [
            'type'       => 'VARCHAR',
            'constraint' => 50,
        ],
        'email' => [
            'type'       => 'VARCHAR',
            'constraint' => 150,
        ],
        'senha' => [
            'type'       => 'VARCHAR',
            'constraint' => 255,
        ],
        'ativo' => [
            'type'       => 'TINYINT',
            'constraint' => 1,
            'default'    => 1,
        ],
        'criado_em' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'atualizado_em' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'tipo' => [
            'type'       => 'ENUM',
            'constraint' => ['padrao', 'administrador'],
            'default'    => 'padrao',
        ],
    ]);

    $this->forge->addPrimaryKey('id');
    $this->forge->createTable('usuarios');
}

    public function down()
    {
        $this->forge->dropTable('usuarios');
    }
}
