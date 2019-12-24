<?php
namespace Controllers;

use Core\Controller;
use Models\Posto;

class PostoController extends Controller
{
	public function index(){}

	public function get_postos()
	{
		$array = array('error' => '', 'info' => '');

        $method = $this->getMethod();
        $data = $this->getRequestData();

        if($method == 'POST') {

        	$posto = new Posto();

            if(!empty($data['uf'])) {
                $array['info'] = $posto->getPostos($data['uf']);
            } else {
                $array['error'] = 'Seu estado não foi encontrado em sua conta, altere no menu alterar conta';
            }

        	
        	            
        } else {
            $array['error'] = 'Método de requisição incompatível';
        }
        
        $this->returnJson($array);
	}

}