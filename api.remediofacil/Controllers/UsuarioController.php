<?php
namespace Controllers;

use Core\Controller;
use Models\Usuario;
use Models\Suporte;


class UsuarioController extends Controller
{
    public function index(){}

    public function usuario_login()
    {
        $array = array('error' => '', 'check' => false);

        $method = $this->getMethod();
        $data = $this->getRequestData();

        if($method == 'POST') {

            if(!empty($data['usuario_email']) && !empty($data['usuario_senha'])) {

                $usuario = new Usuario();

                if($usuario->logUsuario($data['usuario_email'], $data['usuario_senha'])) {
                    $id = $usuario->getId($data['usuario_email'], $data['usuario_senha']);
                    $array['user'] = $usuario->getUsuario($id);
                    $array['check'] = true;
                } else {
                    $array['error'] = 'Email e/ou senha inválidos';
                }
            } else {
                $array['error'] = 'Preencha todos os campos';
            }
        } else {
            $array['error'] = 'Método de requisição incompátivel';
        }

        $this->returnJson($array);
    }


    //criando usuário
    public function usuario_create()
    {
        $array = array('error' => '', 'check' => false);

        $method = $this->getMethod();
        $data = $this->getRequestData();

        if($method == 'POST') {

            if(!empty($data['usuario_nome']) && !empty($data['usuario_email']) 
                && !empty($data['usuario_senha']) && !empty($data['usuario_uf'])) {

                $usuario = new Usuario();
                $suporte = new Suporte();

                if($usuario->create_user($data['usuario_nome'], $data['usuario_email'], $data['usuario_senha'], $data['usuario_uf'])) {
                    $array['error'] = 'Aguardando confirmação';
                    $array['check'] = true;

                    //gerando código
                    $code = rand(0,99999);

                    while(strlen($code) < 5) {
                        $code = rand(0,99999);
                    }

                    //parametros para envio de confirmação
                    $head = "Confirmação de cadastro";
                    $body = "Olá ".$data['usuario_nome'].", seu código de confirmação é: ".$code;

                    $suporte->adicionar($head, $body, $data['usuario_nome'], $data['usuario_email'])->send();
                    $usuario->saveCode($data['usuario_email'], $code);

                } else {
                    $array['error'] = 'Tente novamente mais tarde';
                }

            }  else {
                $array['error'] = 'Preencha todos os campos';
            } 
                
        } else {
            $array['error'] = 'Método de requisição incompátivel';
        }

        $this->returnJson($array);
    }


    //confirmando codigo
    public function confirmar_code()
    {
        $array = array('error' => '', 'check' => false);

        $method = $this->getMethod();
        $data = $this->getRequestData();

        if($method == 'POST') {

            $usuario = new Usuario();

            if(!empty($data['usuario_code'])) {

                if($usuario->confirmCode($data['usuario_code'])) {
                    $array['error'] = 'Código confirmado com sucesso';
                    $array['check'] = true;
                    $usuario->clearCode($data['usuario_code']);
                } else {
                    $array['error'] = 'Código inválido tente novamente';
                }

            } else {
                $array['error'] = 'Preencha todos os campos';
            }
     
        } else {
            $array['error'] = 'Método de requisição incompátivel';
        }

        $this->returnJson($array);
    }

    public function usuario_setName()
    {
        $array = array('error' => '', 'user' => '','check' => false);

        $method = $this->getMethod();
        $data = $this->getRequestData();

        if($method == 'POST') {

            $usuario = new Usuario();

            if(!empty($data['usuario_id']) && !empty($data['usuario_nome'])) {

                if($usuario->setUsuarioName($data['usuario_nome'], $data['usuario_id'])) {

                    $array['error'] = 'Nome alterado com sucesso';
                    $array['check'] = true;
                    $array['user'] = $usuario->getUsuario($data['usuario_id']);

                } else {
                    $array['error'] = 'Tente novamente mais tarde';
                }
                    
            } else {
                $array['error'] = 'Preencha todos os campos';
            }
     
        } else {
            $array['error'] = 'Método de requisição incompátivel';
        }

        $this->returnJson($array);
    }

    public function usuario_setSenha()
    {
        $array = array('error' => '');

        $method = $this->getMethod();
        $data = $this->getRequestData();

        if($method == 'POST') {

            $usuario = new Usuario();

            if(!empty($data['usuario_id']) && !empty($data['usuario_senha'])) {

                if($usuario->setUsuarioPass($data['usuario_senha'], $data['usuario_id'])) {

                    $array['error'] = 'Senha alterada com sucesso';

                } else {
                    $array['error'] = 'Tente novamente mais tarde';
                }
                    
            } else {
                $array['error'] = 'Preencha todos os campos';
            }
     
        } else {
            $array['error'] = 'Método de requisição incompátivel';
        }

        $this->returnJson($array);
    }

    public function esqueci_senha()
    {
        $array = array('error' => '', 'check' => false);

        $method = $this->getMethod();
        $data = $this->getRequestData();

        if($method == 'POST') {

            $suporte = new Suporte();
            $usuario = new Usuario();

            if(!empty($data['usuario_email'])) {

                $access = password_hash($data['usuario_email'], PASSWORD_BCRYPT);

                //parametros para envio de confirmação
                $head = "Esqueceu a senha?";
                $body = "Acesse o link abaixo e altere sua senha http://localhost/source/remediofacil/reset/esqueci-a-senha/?access=".$access."&email=".$data['usuario_email'];

                if($suporte->reset($head, $body,$data['usuario_email'])->send()) {

                    $array['error'] = 'E-mail enviado com sucesso';
                    $array['check'] = true;
                    $usuario->addAccess($data['usuario_email'], $access);

                } else {
                    $array['error'] = 'Tente novamente mais tarde';
                }

            } else {
                $array['error'] = 'Preencha todos os campos';
            }
     
        } else {
            $array['error'] = 'Método de requisição incompátivel';
        }

        $this->returnJson($array);
    }
}