<?php
namespace Models;

use Core\Model;

class Envio extends Model
{
	public function create( $usuario, $remedio, $posto, $estimada)
	{
		if(!$this->existeEnvio($usuario, $remedio, $posto)) {
			$sql = "INSERT INTO envio (envio_usuario, envio_remedio, envio_posto, envio_estimada, envio_create)
				VALUES (:usuario, :remedio, :posto, :estimada, NOW())";
			$conect = $this->db->prepare($sql);
			$conect->bindValue(':usuario', $usuario);
			$conect->bindValue(':remedio', $remedio);
			$conect->bindValue(':posto', $posto);
			$conect->bindValue(':estimada', $estimada);
			$conect->execute();

			return true;
		}
		return false;
	}


	public function getId(int $usuario, int $remedio, int $posto)
	{
		$dados = array();

		$sql = "SELECT envio_id FROM envio
				WHERE envio_usuario = :usuario AND envio_remedio = :remedio AND envio_posto = :posto";
		$conect = $this->db->prepare($sql);
		$conect->bindValue(':usuario', $usuario);
		$conect->bindValue(':remedio', $remedio);
		$conect->bindValue(':posto', $posto);
		$conect->execute();

		if($conect->rowCount() > 0 ) {
			$dados = $conect->fetch();
		}

		return $dados;
	}


	//pegando envios
	public function getEnvios()
	{

		$dados = array();

		$sql = "SELECT e.envio_estimada as estimada, e.envio_create as criado, u.usuario_nome as usuario,
				r.remedio_nome as remedio, f.farmacia_nome as posto
				FROM envio as e
				INNER JOIN usuario as u
				ON e.envio_usuario = u.usuario_id
				INNER JOIN remedio as r
				ON e.envio_remedio = r.remedio_id
				INNER JOIN posto as p
				ON e.envio_posto = p.posto_id
				INNER JOIN farmacia as f
				ON p.posto_id = f.farmacia_id";
		$conect = $this->db->query();

		if($conect->rowCount() > 0) {
			$dados = $conect->fetchAll();
		}

		return $dados;
	}

	//editando envio
	public function setEnvio(int $id)
	{
		$sql = "UPDATE envio SET envio_entrega = NOW(), envio_update = NOW(), envio_status = '1' 
				WHERE envio_id = :id";
		$conect = $this->db->prepare($sql);
		$conect->bindValue(':id', $id);
		$conect->execute();

		return true;
	}

	public function deleteEnvio(int $id)
	{
		$sql = "DELETE envio WHERE envio_id = :id";
		$conect = $this->db->prepare($sql);
		$conect->bindValue(':id', $id);
		$conect->execute();

		return true;
	}


	private function existeEnvio($usuario, $remedio, $posto)
	{
		$sql = "SELECT envio_id FROM envio
				WHERE envio_usuario = :usuario AND envio_remedio = :remedio AND envio_posto = :posto";
		$conect = $this->db->prepare($sql);
		$conect->bindValue(':usuario', $usuario);
		$conect->bindValue(':remedio', $remedio);
		$conect->bindValue(':posto', $posto);
		$conect->execute();	

		if($conect->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}
}