<?php
global $routes;
$routes = array();

//reset
$routes['/reset/esqueci-a-senha'] = '/reset/esqueci';
$routes['/reset/confirmar-codigo/'] = '/reset/confirm/';
$routes['/reset/alterar-senha/'] = '/reset/nova_senha/';

//farmacia
$routes['/farmacia/adicionar-remedio'] = '/farmacia/adicionar';
$routes['/farmacia/adicionar-remedio/'] = '/farmacia/adicionar';
$routes['/farmacia/adicionar-remedio/buscar'] = '/farmacia/buscar_remedios';
$routes['/farmacia/adicionar-remedio/{id}'] = '/farmacia/new_insert/:id';
$routes['/farmacia/remedios-adicionados'] = '/farmacia/remedios_adicionados';
$routes['/farmacia/minha-conta'] = '/farmacia/minha_conta';
$routes['/farmacia/encerrar-sessao'] = '/farmacia/sair';


//posto
$routes['/posto/doacoes-para-receber'] = '/posto/get_recebimentos';
$routes['/posto/doacoes-concluidas'] = '/posto/get_success';
$routes['/posto/doacoes-em-andamento'] = '/posto/get_andamentos';
$routes['/posto/posto-entrega/{id}'] = '/posto/add_novo_posto/:id';
$routes['/posto/confirmar-recebimento/{id}'] = '/posto/add_recebimento/:id';
$routes['/posto/deletar-recebimento/{id}'] = '/posto/delete_recebimento/:id';
$routes['/posto/confirmar-doacao/{id}'] = '/posto/set_recebimento/:id';


//administrador
$routes['/administrador'] = '/admin';
$routes['/administrador/visualizar-cadastros'] = '/admin/ver_cadastros';
$routes['/administrador/visualizar-cadastros/testar/{id}'] = '/admin/test_cadastro/:id';
$routes['/administrador/visualizar-cadastros/adicionar/{id}'] = '/admin/new_farmacia/:id';
$routes['/administrador/visualizar-cadastros/excluir/{id}'] = '/admin/delete_cadastro/:id';
$routes['/administrador/adicionar-remedios'] = '/admin/add_remedios';
$routes['/administrador/editar-remedios'] = '/admin/remedios_edit';
$routes['/administrador/editar-remedios/'] = '/admin/remedios_edit';
$routes['/administrador/editar-remedios/{id}'] = '/admin/set_remedio/:id';

