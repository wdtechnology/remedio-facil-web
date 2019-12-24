<?php
namespace Controllers;

use Core\Controller;
use Models\Envio;
use Models\Farmacia;
use Models\Posto;
use Models\Recebimento;
use Models\Doacao;

class PostoController extends Controller
{
    private $farmacia;
    private $posto;

    public function __construct()
    {
        parent::__construct();

        $this->farmacia = new Farmacia();
        $this->posto = new Posto();

        if(!$this->farmacia->checarLogin()) {
            header("Location: ".BASE_URL.'login');
            exit;
        }
    }

    public function index()
    {
        $data = array();

        $posto = new Posto();
        $farmacia = new Farmacia();

        $data['info'] = $farmacia->getFarmacia($_SESSION['user_farmacia']);
        $data['existe'] = $posto->confirmarPosto($_SESSION['user_farmacia']);

        $this->loadTemplate('gerenciarPosto', $data);
    }

    public function add_novo_posto(int $id)
    {
        if(!empty($id)) {

            $posto = new Posto();

            if($id != 1) {
                if($posto->create($id)) {
                    $posto->gerandoSessao($id);
                }
                header("Location: ".BASE_URL.'posto');
                exit;
            }            
        }

        header("Location: ".BASE_URL);
        exit;
    }

    public function get_recebimentos()
    {
        $data = array();

        $farmacia = new Farmacia();
        $envio = new Envio();
        $posto = new Posto();

        $data['info'] = $farmacia->getFarmacia($_SESSION['user_farmacia']);
        $data['envio'] = $envio->getEnvio($_SESSION['posto']);
        $data['existe'] = $posto->confirmarPosto($_SESSION['user_farmacia']);

        $this->loadTemplate('posto_envio', $data);
    }

    public function add_recebimento(int $id)
    {
        if(!empty($id)) {

            $recebimento = new Recebimento();
            $doacao = new Doacao();
            $envio = new Envio();

            
            $envio->setStatusEnvio($id);
            $recebimento->create($id);
            $doacao->create($id);
        }

        header("Location: ".BASE_URL.'posto/doacoes-para-receber');
        exit;
    }


    public function set_recebimento(int $id)
    {
        if(!empty($id)) {

            $recebimento = new Recebimento();
            $doacao = new Doacao();

            $recebimento->setRecebimento($id);
            $doacao->setDoacao($id);
        }

        header("Location: ".BASE_URL.'posto/doacoes-em-andamento');
        exit;
    }

    public function delete_recebimento(int $id)
    {
        if(!empty($id)) {

            $recebimento = new Recebimento();

            $recebimento->deleteRecebimento($id);
        }

        header("Location: ".BASE_URL.'posto/doacoes-para-receber');
        exit;
    }


    public function get_andamentos()
    {
        $data = array();

        $farmacia = new Farmacia();
        $recebimento = new Recebimento();
        $posto = new Posto();

        $data['info'] = $farmacia->getFarmacia($_SESSION['user_farmacia']);
        $data['recebimento'] = $recebimento->getRecebimentos($_SESSION['posto']);
        $data['existe'] = $posto->confirmarPosto($_SESSION['user_farmacia']);

        $this->loadTemplate("andamento", $data);
    }

    public function get_success()
    {
        $data = array();

        $farmacia = new Farmacia();
        $doacao = new Doacao();
        $posto = new Posto();

        $data['info'] = $farmacia->getFarmacia($_SESSION['user_farmacia']);
        $data['doacao'] = $doacao->getDoacoes($_SESSION['posto']);
        $data['existe'] = $posto->confirmarPosto($_SESSION['user_farmacia']);

        $this->loadTemplate('concluidas', $data);
    }
}
