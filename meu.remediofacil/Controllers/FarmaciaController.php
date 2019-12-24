<?php
namespace Controllers;

use Core\Controller;
use Models\Farmacia;
use Models\Posto;
use Models\Qtd;
use Models\Remedio;
use Models\Servico;

class FarmaciaController extends Controller
{
    private $farmacia;

    public function __construct()
    {
        parent::__construct();

        $this->farmacia = new Farmacia();
        if(!$this->farmacia->checarLogin()) {
            header("Location: ".BASE_URL.'login');
            exit;
        }
    }

    public function index()
    {
        header("Location: ".BASE_URL);
        exit;
    }

    public function adicionar()
    {
        $data = array(
            'alert' => '',
            'success' => ''
        );

        $farmacia = new Farmacia();
        $remedio = new Remedio();
        $servico = new Servico();
        $posto = new Posto();

        $data['existe'] = $posto->confirmarPosto($_SESSION['user_farmacia']);
        $data['info'] = $farmacia->getFarmacia($_SESSION['user_farmacia']);

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

        $data['compare'] = $servico->getServico($_SESSION['user_farmacia']);
        $data['all'] = $remedio->getRemedios($offset, $limite);

        $this->loadTemplate('adicionar', $data);
    }


    public function buscar_remedios()
    {
        $data = array();

        $farmacia = new Farmacia();
        $remedio = new Remedio();
        $servico = new Servico();
        $posto = new Posto();

        $data['existe'] = $posto->confirmarPosto($_SESSION['user_farmacia']);
        $data['info'] = $farmacia->getFarmacia($_SESSION['user_farmacia']);

        //método para resolver erro de busca ao não achar o "q" enviado;
        $url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI']: '';

        if ($url != '') {

            $urls  = explode('/', $url);
            $param = str_replace('?','', end($urls));
            $param = explode('&', $param);
            $params = array();

            foreach($param as $pa){
                $vp = explode('=', $pa);
                $params[$vp[0]] = sizeof($vp)==2?$vp[1]:NULL;
            }

            $_GET['pesquisa'] = addslashes($params[$vp[0]]);

            $busca = addslashes($_GET['pesquisa']);
        }

        if(isset($_GET['pesquisa']) && !empty($_GET['pesquisa'])) {

            $offset = 1;
            $limite = 20;
            $total = $remedio->countBusca($busca);

            $data['paginas'] = ceil($total/$limite);

            $data['atual'] = 1;

            $offset = ($data['atual'] * $limite) - $limite;

            $data['busca'] = $busca;
            $data['compare'] = $servico->getServico($_SESSION['user_farmacia']);
            $data['all'] = $remedio->getBusca($busca);

            $this->loadTemplate('busca', $data);

        } else {
            header("Location: ".BASE_URL.'farmacia/adicionar-remedios');
            exit;
        }

    }

    //inserindo remedio na conta
    public function new_insert($remedio)
    {
        $data = array(
            'alert' => '',
            'success' => ''
        );

        if(isset($remedio) && !empty($remedio)) {

            $servico = new Servico();

            $farmacia = $_SESSION['user_farmacia'];

            $servico->addServico($farmacia, $remedio);
        }

        header("Location: ".BASE_URL.'farmacia/adicionar-remedio');
        exit;
    }

    public function minha_conta()
    {
        $data = array('sucesso' => '', 'alerta' => '');

        $farmacia = new Farmacia();
        $posto = new Posto();

        $data['existe'] = $posto->confirmarPosto($_SESSION['user_farmacia']);
        $data['info'] = $farmacia->getFarmacia($_SESSION['user_farmacia']);

        //alterando a senha
        if(isset($_POST['senha']) && !empty($_POST['confirmar'])) {

            $senha = addslashes(trim(filter_input(INPUT_POST, 'senha')));
            $confirmar = addslashes(trim(filter_input(INPUT_POST, 'confirmar')));

            if($senha == $confirmar) {
                $hash = password_hash($senha, PASSWORD_BCRYPT);

                if($farmacia->setFarmacia($hash, $_SESSION['user_farmacia'])) {
                    $data['sucesso'] = "Senha alterada com sucesso";
                }
            } else {
                $data['alerta'] = 'As senhas não são iguais';
            }
        }

        $this->loadTemplate('conta', $data);
    }
    
    //adicionados
    public function remedios_adicionados()
    {
        $data = array();

        $farmacia = new Farmacia();
        $servico = new Servico();
        $qtd = new Qtd();
        $posto = new Posto();

        $data['existe'] = $posto->confirmarPosto($_SESSION['user_farmacia']);
        $data['info'] = $farmacia->getFarmacia($_SESSION['user_farmacia']);
        $data['servico'] = $servico->getServico($_SESSION['user_farmacia']);
        $data['qtds'] = $qtd->getQuantidade();

        $this->loadTemplate('adicionados', $data);
    }


    //encerrando a sessão
    public function sair()
    {
        $this->loadTemplate('sair', array());
    }
}