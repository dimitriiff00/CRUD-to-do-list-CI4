<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    public function run()
{
    $data = [
        'nome'      => 'Admin',
        'sobrenome' => 'Sistema',
        'usuario'   => 'admin',
        'email'     => 'admin@todolist.com',
        'senha'     => password_hash('123456', PASSWORD_DEFAULT),
        'tipo'      => 'administrador',
        'ativo'     => 1,
    ];

    $this->db->table('usuarios')->insert($data);
}
}
