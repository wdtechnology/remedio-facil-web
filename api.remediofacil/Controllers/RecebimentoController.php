<?php
namespace Controllers;

use Core\Controller;
use Models\Recebimento;

class RecebimentoController extends Controller
{
	public function get_recebimentos()
	{
		$array = array('error' => '', 'info' => '');

		$method = $this->getMethod();
		$data = $this->getRequestData();

		if($method == 'POST') {

			if(!empty($data['uf'])) {

				$recebimento = new Recebimento();

				$array['info'] = $recebimento->getRecebimentos($data['uf']);

			} else {
				$array['error'] = 'Preencha todos os campos';
			}

		} else {
			$array['error'] = 'Método de requisição incompatível';
		}

		$this->returnJson($array);
	}
}