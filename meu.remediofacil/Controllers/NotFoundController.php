<?php
namespace Controllers;

use Core\Controller;
use Models\Farmacia;
use Models\Posto;

class NotFoundController extends Controller
{
    public function index()
    {
        $data = array();

        $farmacia = new Farmacia();
        $posto = new Posto();

        $data['existe'] = $posto->confirmarPosto($_SESSION['user_farmacia']);
        $data['info'] = $farmacia->getFarmacia($_SESSION['user_farmacia']);


        $this->loadTemplate('404', $data);
    }
}