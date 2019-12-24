<?php
namespace Models;

use Core\Model;

class Doacao extends Model
{
	public function create(int $recebimento)
	{
		if(!$this->doacaoExiste($recebimento)) {

			$sql = "INSERT INTO doacao (doacao_recebimento, doacao_create)
				VALUES (:recebimento, NOW())";
			$conect = $this->db->prepare($sql);
			$conect->bindValue(':recebimento', $recebimento);
			$conect->execute();

			return true;
		}
		
		return false;
	}


	public function setDoacao(int $id)
	{
		$sql = "UPDATE doacao SET doacao_status = 0, doacao_update = NOW()
				WHERE doacao_recebimento = :id";
		$conect = $this->db->prepare($sql);
		$conect->bindValue(':id', $id);
		$conect->execute();

		return true;
	}


	public function getDoacoes(int $id)
	{
		$dados = array();

		$sql = "SELECT e.envio_remedio as remedio, d.doacao_update, u.usuario_nome as doador
				FROM doacao as d
				INNER JOIN recebimento as rec
				ON d.doacao_recebimento = rec.recebimento_id
				INNER JOIN envio as e
				ON rec.recebimento_envio = e.envio_id
				INNER JOIN usuario as u
				ON e.envio_usuario = u.usuario_id
				INNER JOIN posto as p
				ON e.envio_posto = p.posto_id
				INNER JOIN farmacia as f
				ON p.posto_farmacia = f.farmacia_id
				WHERE e.envio_posto = :id AND d.doacao_status = 0";
		$conect = $this->db->prepare($sql);
		$conect->bindValue(':id', $id);
		$conect->execute();

		if($conect->rowCount() > 0) {
			$dados = $conect->fetchAll();
		}

		return $dados;
	}





	private function doacaoExiste(int $recebimento)
	{
		$sql = "SELECT doacao_id FROM doacao WHERE doacao_recebimento = :recebimento";
		$conect = $this->db->prepare($sql);
		$conect->bindValue(':recebimento', $recebimento);
		$conect->execute();

		if($conect->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}
}