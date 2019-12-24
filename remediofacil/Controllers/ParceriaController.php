<?php
namespace Controllers;

use Core\Controller;
use Models\Cadastro;
use Models\Suporte;

class ParceriaController extends Controller
{
    public function index()
    {
        $data = array('alert' => '', 'sucesso' => '');

        $suporte = new Suporte();
        $cadastro = new Cadastro();

        if(isset($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['cnpj'])) {

            $nome = addslashes(trim(filter_input(INPUT_POST, 'nome')));
            $email = addslashes(trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)));
            $cnpj = addslashes(trim(filter_input(INPUT_POST, 'cnpj')));

            $remover = array("/",",",".","-","(",")"," ");
            //removendo carateres
            $cnpj = str_replace($remover,"", $cnpj);

            //gerando access
            $access = MD5(rand(0,9999).$nome.$email);

            //enviando email
            $head = "Confirmação de cadastro - Remédio Fácil";
            //corpo da msg
            $body = "Olá, ".$nome." acesse o link abaixo e confirme seu cadastro.<br/>"
                .BASE_URL.'validacao/validar/?token='
                .$access."&&email=".$email;

            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

                //cadastrando usuário
                if($cadastro->create($nome, $email,$cnpj, $access)) {
                    //enviando email
                    $suporte->adicionar($head, $body, $nome, $email)->send();
                    $data['sucesso'] = "Acesse o link enviado em seu email. Após acessar, aguarde nosso email de confirmação, entraremos em contato nos próximos dias.";
                } else {
                    $data['alert'] = "Tente novamente mais tarde";
                }

            } else {
                $data['alert'] = 'E-mail inválido';
            }
        }

        $this->loadTemplate('parceria', $data);
    }
}