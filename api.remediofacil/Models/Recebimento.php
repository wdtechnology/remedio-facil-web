<?php
namespace Models;

use Core\Model;

class Recebimento extends Model
{
	//doações em andamento
	public function getRecebimentos(string $uf)
	{
		$dados = array();

		$sql = "SELECT e.envio_remedio as remedio, u.usuario_nome as doador, f.farmacia_nome as farmacia,
				f.farmacia_cep as cep
				FROM recebimento as rec
				INNER JOIN envio as e
				ON rec.recebimento_envio = e.envio_id
				INNER JOIN usuario as u
				ON e.envio_usuario = u.usuario_id
				INNER JOIN posto as p
				ON e.envio_posto = p.posto_id
				INNER JOIN farmacia as f
				ON p.posto_farmacia = f.farmacia_id
				WHERE f.farmacia_uf = :uf AND rec.recebimento_status = 1";
		$conect = $this->db->prepare($sql);
		$conect->bindValue(':uf', $uf);
		$conect->execute();

		if($conect->rowCount() > 0) {
			$dados = $conect->fetchAll();
		}

		return $dados;
	}
}