<?php
namespace Controllers;

use Core\Controller;
use Models\Farmacia;
use Models\Suporte;

class ResetController extends Controller
{
    public function index()
    {
        header("Location: ".BASE_URL);
        exit;
    }

    public function esqueci()
    {
        $data = array('alerta' => '');

        if(isset($_POST['email']) && !empty($_POST['email'])) {

            $farmacia = new Farmacia();
            $suporte = new Suporte();

            $email = addslashes(trim(filter_input(INPUT_POST,'email')));

            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if($farmacia->confirmarEmail($email)) {

                    //gerando cod. confirm
                    $cod = rand(0,99999);

                    while(strlen($cod) < 5) {
                        $cod = rand(0,99999);
                    }

                    $access = password_hash($email, PASSWORD_BCRYPT);

                    //salvando cod gerado no banco.
                    if($farmacia->setFarmaciaReset($email, $cod, $access)) {

                        //enviando email
                        $head = "Remédio Fácil - Esqueci a senha";
                        $body = "Seu código é ".$cod."<br/>".BASE_URL.'reset/confirmar-codigo/?acesso='.$access;

                        $suporte->adicionar($head, $body, $email)->send();
                        header("Location: ".BASE_URL.'reset/esqueci-a-senha');
                        exit;
                    }

                } else {
                    $data['alerta'] = 'Tente novamente mais tarde';
                }

            } else {
                $data['alerta'] = 'Insira um email válido';
            }
        }
        $this->loadView('esqueci', $data);
    }

    public function confirm()
    {
        $data = array('alerta' =>  '');

        $farmacia = new Farmacia();

        if(!isset($_GET['acesso']) && empty($_GET['acesso'])) {
            header("Location: ".BASE_URL);
            exit;
        }

        $acesso = addslashes(trim(filter_input(INPUT_GET, 'acesso')));

        if(isset($_POST['confirmar']) && !empty($_POST['confirmar'])) {

            $code = addslashes(trim(filter_input(INPUT_POST, 'confirmar')));

            if(strlen($acesso) == strlen($_GET['acesso']) && $acesso == $_GET['acesso']) {
                if($farmacia->confirmarCode($code, $acesso)) {
                    header("Location: ".BASE_URL.'reset/alterar-senha/?acesso='.$acesso);
                    exit;
                } else {
                    //echo "código errado";
                }
            } else {
                $data['alerta'] = "Tente novamente mais tarde";
            }

        }
        $this->loadView('confirmar', $data);
    }

    public function nova_senha()
    {
        $data = array();

        $farmacia = new Farmacia();

        if(!isset($_GET['acesso']) && empty($_GET['acesso'])) {
            header("Location: ".BASE_URL);
            exit;
        }

        $acesso = addslashes(trim(filter_input(INPUT_GET, 'acesso')));

        if(isset($_POST['senha']) && !empty($_POST['confirmar'])) {

            $senha = addslashes(trim(filter_input(INPUT_POST, 'senha')));
            $confirmar = addslashes(trim(filter_input(INPUT_POST, 'confirmar')));

            if($senha == $confirmar) {

                $hash = password_hash($senha, PASSWORD_BCRYPT);

                if($farmacia->alterarSenha($hash, $acesso)) {
                    header("Location: ".BASE_URL);
                    exit;
                }
            } else {
                echo "Senhas não são iguais";
            }
        }

        $this->loadView('alterarSenha', $data);
    }
}