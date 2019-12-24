<?php
namespace Controllers;

use Core\Controller;
use Models\Servico;

class ServicoController extends Controller
{
	public function index(){}

	public function get_servico()
	{
		$array = array('error' => '');

		$method = $this->getMethod();
		$data = $this->getRequestData();

		if($method == 'GET') {

			$servico = new Servico();

			$array['error'] = $servico->getServico();

		} else {
			$array['error'] = 'Método de requisição incompatível';
		}

		$this->returnJson($array);
	}


	public function busca()
	{
		$array = array('error' => '', 'info' => '');

		$method = $this->getMethod();
		$data = $this->getRequestData();

		if($method == 'POST') {

			if(!empty($data['remedio']) && !empty($data['uf'])) {
				
				$servico = new Servico();
				$array['info'] = $servico->searchServico($data['remedio'], $data['uf']);

			} else {

				$array['error'] = 'Prencha todos os campos';
			}

		} else {
			$array['error'] = 'Método de requisição incompatível';
		}

		$this->returnJson($array);
	}

}