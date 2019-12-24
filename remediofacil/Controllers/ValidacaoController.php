<?php
namespace Controllers;

use Core\Controller;
use Models\Cadastro;

class ValidacaoController extends Controller
{
    public function index()
    {
        header("Location: ".BASE_URL);
        exit;
    }

    public function validar()
    {
        if(!empty($_GET['token']) && !empty($_GET['email'])) {

            $token = addslashes(trim(filter_input(INPUT_GET, 'token')));
            $email = addslashes(trim(filter_input(INPUT_GET, 'email')));

            $cadastro = new Cadastro();

            $cadastro->validar($token, $email);
        }

        header("Location:".BASE_URL);
        exit;
    }
    
}