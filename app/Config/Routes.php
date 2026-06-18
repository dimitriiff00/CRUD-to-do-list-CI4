<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/autenticar', 'Auth::autenticar');
$routes->get('tarefas', 'Tarefas::index');
$routes->post('tarefas', 'Tarefas::cadastraTarefa');