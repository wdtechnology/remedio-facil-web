<?php
namespace Models;

use Core\Model;

class Posto extends Model
{
	public function getPostos(String $uf)
	{
		$dados = array();
		
		$sql = "SELECT p.posto_id as identificador, f.farmacia_nome as farmacia
				FROM posto as p
				INNER JOIN farmacia as f
				ON p.posto_farmacia = f.farmacia_id
				WHERE f.farmacia_uf = :uf";
		$conect = $this->db->prepare($sql);
		$conect->bindValue(':uf', $uf);
		$conect->execute();

		if($conect->rowCount() > 0) {
			$dados = $conect->fetchAll();
		}

		return $dados;
	}
}