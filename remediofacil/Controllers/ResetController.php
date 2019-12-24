<?php
namespace Controllers;

use Core\Controller;
use Models\Usuario;
use Models\Suporte;

class ResetController extends Controller
{
	public function index()
	{
		header("Location: ".BASE_URL);
		exit;
	}

	public function esqueci_senha()
	{
		$data = array('alerta' => '');

		$usuario = new Usuario();
		$suporte = new Suporte();

		if(isset($_GET['access']) && !empty($_GET['email'])) {

			$access = addslashes(trim(filter_input(INPUT_GET, 'access')));
			$email = addslashes(trim(filter_input(INPUT_GET, 'email')));

			if(isset($_POST['senha']) && !empty($_POST['confirmar'])) {

				$senha = addslashes(trim(filter_input(INPUT_POST, 'senha')));
				$confirmar = addslashes(trim(filter_input(INPUT_POST, 'confirmar')));

				if($senha == $confirmar) {
					if($usuario->setUsuarioPassWemail($senha, $email, $access)) {

						//limapando o access gerado
						$usuario->cleanAccess($email, $access);

						//envio de msg
						$head = "Alteração de senha";
						$body = "Senha alterada com sucesso";

						$suporte->reset($head, $body, $email)->send();
					}

					header("Location: ".BASE_URL);
					exit;

				} else {
					$data['alerta'] = 'Senhas não são iguais';
				}
				
			}

			$this->loadView('esqueci', $data);

		} else {
			header("Location: ".BASE_URL);
			exit;
		}
	}


}