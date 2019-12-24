<?php
namespace Controllers;

use Core\Controller;
use Models\Farmacia;

class LoginController extends Controller
{

    public function index()
    {
        $data = array('alerta' => '');

        $farmacia = new Farmacia();

        if(isset($_POST['email']) && !empty($_POST['senha'])) {

            $email = addslashes(trim(filter_input(INPUT_POST, 'email')));
            $senha = addslashes(trim(filter_input(INPUT_POST, 'senha')));

            if($farmacia->logarFarmacia($email, $senha)) {

                $token = $farmacia->criarToken($email);

                $_SESSION['token'] = $token;

                header("Location: ".BASE_URL);
                exit;

            } else {
                $data['alerta'] = "E-mail e/ou senha errados";
            }
        }

        $this->loadView('login', $data);
    }
}