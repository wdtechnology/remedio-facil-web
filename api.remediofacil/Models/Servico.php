<?php
namespace Models;

use Core\Model;

class Servico extends Model
{
	public function getServico()
	{
		$dados = array();

		$sql = "SELECT s.servico_id, s.servico_create as data, 
				q.qtd_nome as qtd, r.remedio_nome as remedio, 
				f.farmacia_nome as farmacia 
				FROM servico s
				INNER JOIN remedio r on s.servico_remedio = r.remedio_id
				INNER JOIN farmacia f on s.servico_farmacia = f.farmacia_id
				INNER JOIN qtd q on s.servico_qtd = q.qtd_id";
		$conect = $this->db->query($sql);

		if($conect->rowCount() > 0) {
			$dados = $conect->fetchAll();
		}

		return $dados;
	}

	public function searchServico($nome,$uf)
	{
		$dados = array();

		$sql = "SELECT s.servico_id, r.remedio_nome as remedio,
				f.farmacia_cep as cep, f.farmacia_uf as uf, f.farmacia_cidade as cidade,
				f.farmacia_nome as farmacia 
				FROM servico s
				INNER JOIN remedio r on s.servico_remedio = r.remedio_id
				INNER JOIN farmacia f on s.servico_farmacia = f.farmacia_id
				WHERE r.remedio_nome LIKE :nome AND f.farmacia_uf = :uf";
		$conect = $this->db->prepare($sql);
		$conect->bindValue(':nome', '%'.$nome.'%');
		$conect->bindValue(':uf', $uf);
		$conect->execute();

		if($conect->rowCount() > 0) {
			$dados = $conect->fetchAll();
		}

		return $dados;
	}

}