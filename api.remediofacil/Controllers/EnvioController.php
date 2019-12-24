<?php
namespace Controllers;

use Core\Controller;
use Models\Envio;

class EnvioController extends Controller
{
	public function index(){}

	public function create_envio()
	{
		$array = array('error' => '');

		$method = $this->getMethod();
		$data = $this->getRequestData();

		if($method == 'POST') {

			$envio = new Envio();

			if(!empty($data['envio_usuario']) && !empty($data['envio_remedio']) && 
				!empty($data['envio_posto']) && !empty($data['envio_estimada'])) {

				if($envio->create($data['envio_usuario'], $data['envio_remedio'], $data['envio_posto'], $data['envio_estimada'])) {
					
					$array['error'] = 'Doação adicionada';

				} else {
					$array['error'] = 'Tente novamente mais tarde';
				}

			} else {
				$array['error'] = 'Preencha todos os campos';
			}

		} else {
			$array['error'] = 'Método de requisição incompatível';
		}

		$this->returnJson($array);
	}
}