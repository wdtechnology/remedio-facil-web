<?php
namespace Controllers;

use Core\Controller;
use Models\Farmacia;
use Models\Posto;
use Models\Remedio;
use Models\Servico;

class HomeController extends Controller
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
        $data = array();

        $farmacia = new Farmacia();
        $remedio = new Remedio();
        $servico = new Servico();
        $posto = new Posto();

        $data['info'] = $farmacia->getNome($_SESSION['user_farmacia']);
        $data['total'] = $servico->countAll($_SESSION['user_farmacia']);
        $data['baixas'] = $servico->countBaixas($_SESSION['user_farmacia']);
        $data['count'] = $remedio->countRemedios($_SESSION['user_farmacia']);
        $data['existe'] = $posto->confirmarPosto($_SESSION['user_farmacia']);

        $this->loadTemplate('home', $data);
    }
}