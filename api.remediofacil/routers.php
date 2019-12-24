<?php
global $routes;
$routes = array();

//usuario
$routes['/usuario/cadastrar'] = '/usuario/usuario_create';
$routes['/usuario/login'] = '/usuario/usuario_login';
$routes['/usuario/confirmar-codigo'] = '/usuario/confirmar_code';
$routes['/usuario/alterar-nome'] = '/usuario/usuario_setName';
$routes['/usuario/alterar-senha'] = '/usuario/usuario_setSenha';
$routes['/usuario/esqueci-senha'] = '/usuario/esqueci_senha';

//servico
$routes['/servico/todos-servicos'] = '/servico/get_servico';
$routes['/servico/buscar-remedio'] = '/servico/busca';


//remedio
$routes['/remedio/buscar-remedios'] = '/remedio/getRemedio';

//posto
$routes['/posto/todos-postos'] = '/posto/get_postos';

//envio
$routes['/envio/adicionar-doacao'] = '/envio/create_envio';


//recebimentos
$routes['/recebimento/doacoes'] = '/recebimento/get_recebimentos';