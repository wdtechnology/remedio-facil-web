<?php
namespace Controllers;

use Core\Controller;
use Models\Remedio;

class RemedioController extends Controller
{
    public function index() {}

    public function getRemedio()
    {
        $array = array('error' => '', 'info' => '');

        $method = $this->getMethod();
        $data = $this->getRequestData();

        if($method == 'POST') {

            if(!empty($data['remedio'])) {
                $remedio = new Remedio();
                $array['info'] = $remedio->getRemedio($data['remedio']);
            } else {
                $array['error'] = 'Preencha todos os campos';
            }
        } else {
            $array['error'] = 'Método de requisição incompatível';
        }
        $this->returnJson($array);
    }
}
