<?php
namespace Controllers;

use Core\Controller;
use Models\Cadastro;
use Models\Farmacia;
use Models\Posto;
use Models\Remedio;
use Models\Suporte;

class AdminController extends Controller
{
    private $admin;

    public function __construct()
    {
        parent::__construct();

        $this->admin = new Farmacia();
        if(!$this->admin->checarLogin()) {
            header("Location: ".BASE_URL.'login');
            exit;
        }

        if(!$this->admin->checarPermission($_SESSION['user_farmacia'])) {
            header("Location: ".BASE_URL);
            exit;
        }
    }

    public function index()
    {
        $data = array();

        $farmacia = new Farmacia();
        $posto = new Posto();

        $data['info'] = $farmacia->getFarmacia($_SESSION['user_farmacia']);
        $data['existe'] = $posto->confirmarPosto($_SESSION['user_farmacia']);

        $this->loadTemplate('administrador', $data);
    }

    public function ver_cadastros()
    {
        $data = array();

        $farmacia = new Farmacia();
        $cadastro = new Cadastro();
        $posto = new Posto();

        $data['info'] = $farmacia->getFarmacia($_SESSION['user_farmacia']);
        $data['all'] = $cadastro->getCadastros();
        $data['existe'] = $posto->confirmarPosto($_SESSION['user_farmacia']);

        $this->loadTemplate('cadastros', $data);
    }

    //testar cadastro
    public function test_cadastro($id)
    {
        $data = array();

        $farmacia = new Farmacia();
        $cadastro = new Cadastro();
        $posto = new Posto();

        $data['info'] = $farmacia->getFarmacia($_SESSION['user_farmacia']);
        $data['existe'] = $posto->confirmarPosto($_SESSION['user_farmacia']);

        if(!isset($id) && empty($id)) {
            header("Location: ".BASE_URL.'administrador');
            exit;
        }

        $data['all'] = $cadastro->getCnpj($id);

        if(isset($_POST['cnpj']) && !empty($_POST['cnpj'])) {

            $cnpj = addslashes(trim(filter_input(INPUT_POST, 'cnpj')));

            $remover = array('(',')','-','/','.');
            $cnpj = str_replace($remover,"", $cnpj);

            function pegar_conteudo($cnpj)
            {
                $ci = curl_init();
                $time = 5;
                curl_setopt($ci, CURLOPT_URL, $cnpj);
                curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, $time);
                ob_start();
                curl_exec($ci);
                curl_close($ci);
                $conteudo = ob_get_contents();
                ob_end_clean();
                return $conteudo;
            }

            $json = pegar_conteudo("http://receitaws.com.br/v1/cnpj/{$cnpj}");
            $resultado = json_decode($json);

            if(is_null($resultado)) {
                $data['r'] = 'Sistema inacessível';
            } else {
                $data['r'] = $resultado;
            }
        }
        $this->loadTemplate('testar', $data);
    }


    public function new_farmacia($id)
    {
        if(!empty($id)) {
            $farmacia = new Farmacia();
            $cadastro = new Cadastro();
            $suporte = new Suporte();

            //pegando os dados;
            $info = $cadastro->successCadastro($id);

            $cnpj = $info['cadastro_cnpj'];

            //replace
            $remover = array('(',')','-','/','.');

            $cnpj = str_replace($remover,"", $cnpj);

            function pegar_conteudo($cnpj)
            {
                $ci = curl_init();
                $time = 5;
                curl_setopt($ci, CURLOPT_URL, $cnpj);
                curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, $time);
                ob_start();
                curl_exec($ci);
                curl_close($ci);
                $conteudo = ob_get_contents();
                ob_end_clean();
                return $conteudo;
            }

            $json = pegar_conteudo("http://receitaws.com.br/v1/cnpj/{$cnpj}");
            $resultado = json_decode($json);

            //o email será o login e a senha inicial do usuário
            $login = $info['cadastro_email'];

            //dados para adicionar ao banco;
            $senha = $login;
            $cnpj_fk = $id;
            //criptografando a senha;
            $senha = password_hash($senha, PASSWORD_BCRYPT);

            //recebendo dados do webservice
            $nome = $resultado->nome;
            $cep = $resultado->cep;
            //removendo caracteres
            $cep = str_replace($remover, "", $cep);
            $cidade = $resultado->municipio;
            $bairro = $resultado->bairro;
            $rua = $resultado->logradouro;
            $uf = $resultado->uf;

            $cadastro->setCadastro($id);

            $farmacia->createFarmacia($nome, $login, $senha, $cnpj_fk, $cep, $cidade, $bairro, $rua, $uf);

            //envio de mensagem
            $head = "Confirmação de CNPJ";
            $body = "Seu cnpj foi confirmado com sucesso. Confira seus dados de acesso <br/>
                     Seu email: ".$login."<br/>
                     Sua senha: ".$login."<br/>
                     Altere sua senha na página minha conta";
            $suporte->adicionar($head, $body, $login)->send();
        }

        header("Location: ".BASE_URL.'administrador/visualizar-cadastros');
        exit;
    }

    //deletar cadastros invalidos
    public function delete_cadastro($id)
    {
        $cadastro = new Cadastro();
        $cadastro->delete($id);
        header("Location: ".BASE_URL.'administrador/visualizar-cadastros');
        exit;
    }
    
    //adicionar remedio
    public function add_remedios()
    {
        $data = array('alert' => '', 'success' => '');

        $farmacia = new Farmacia();
        $remedio = new Remedio();
        $posto = new Posto();

        $data['info'] = $farmacia->getFarmacia($_SESSION['user_farmacia']);
        $data['existe'] = $posto->confirmarPosto($_SESSION['user_farmacia']);

        if(isset($_POST['nome']) && !empty($_POST['nome'])) {

            $nome = addslashes(trim(filter_input(INPUT_POST, 'nome')));

            if($remedio->addRemedio($nome)) {
                $data['success'] = "Adicionado com sucesso";
            } else {
                $data['alert'] = "Esse remédio já foi adicionado ao sistema";
            }
        }

        $this->loadTemplate('add_remedio', $data);
    }

    public function remedios_edit()
    {
        $data = array();

        $farmacia = new Farmacia();
        $remedio = new Remedio();
        $posto = new Posto();

        $data['info'] = $farmacia->getFarmacia($_SESSION['user_farmacia']);
        $data['existe'] = $posto->confirmarPosto($_SESSION['user_farmacia']);

        $offset = 1;
        $limite = 20;
        $total = $remedio->countRemedios();
        $data['paginas'] = ceil($total/$limite);
        $data['atual'] = 1;

        //método para resolver erro de busca ao não achar o "p" enviado;
        $url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI']: '';
        if ($url != ''){
            $urls  = explode('/', $url);
            $param = str_replace('?','', end($urls));
            $param = explode('&', $param);
            $params = array();
            foreach($param as $pa){
                $vp = explode('=', $pa);
                $params[$vp[0]] = sizeof($vp)==2?$vp[1]:NULL;
            }

            $_GET['p'] = $params[$vp[0]];

            if(!empty($_GET['p'])) {
                $data['atual'] = intval($_GET['p']);
            }
        }

        $offset = ($data['atual'] * $limite) - $limite;
        $data['all'] = $remedio->getRemedios($offset, $limite);

        $this->loadTemplate('listar_remedios', $data);
    }

    public function set_remedio($id)
    {
        $data = array();

        $farmacia = new Farmacia();
        $posto = new Posto();

        $data['info'] = $farmacia->getFarmacia($_SESSION['user_farmacia']);
        $data['existe'] = $posto->confirmarPosto($_SESSION['user_farmacia']);

        if(isset($id) && !empty($id)) {

            $remedio = new Remedio();
            $data['get'] = $remedio->getRemedio($id);
        }

        if(isset($_POST['nome']) && !empty($_POST['nome'])) {
            $nome = addslashes(trim(filter_input(INPUT_POST,'nome')));

            if($remedio->setRemedio($nome, $id)) {
                header("Location: ".BASE_URL.'administrador/editar-remedios');
                exit;
            }
        }

        $this->loadTemplate('editar_remedio', $data);
    }
}