# CRUD To-Do List - CodeIgniter 4

Projeto de lista de tarefas desenvolvido com CodeIgniter 4.

## Requisitos

- PHP 8.1+
- MySQL
- Composer

## Instalação

1. Clone o repositório:
`ash
git clone https://github.com/dimitriiff00/CRUD-to-do-list-CI4.git
cd CRUD-to-do-list-CI4
`

2. Instale as dependências:
`ash
composer install
`

3. Configure o ambiente — copie o arquivo de exemplo e edite com suas credenciais:
`ash
cp env .env
`

4. No .env, configure o banco de dados:
database.default.hostname = localhost

database.default.database = todolist

database.default.username = root

database.default.password =

5. Rode as migrations:
`ash
php spark migrate
`

6. Rode o seeder para criar o usuário administrador:
`ash
php spark db:seed UsuarioSeeder
`

7. Inicie o servidor:
`ash
php spark serve
`

8. Acesse no navegador:
http://localhost:8080/auth/login

## Acesso inicial

- **Usuário:** admin
- **Senha:** 123456
