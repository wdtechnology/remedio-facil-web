<?php
namespace Models;

use Core\Model;

class Servico extends Model
{
    //irá contar a quantidade de remédios há na conta do usuário
    public function countServicos(int $id)
    {
        $dados = array();

        $sql = "SELECT count(servico_id) as t FROM servico 
				WHERE servico_farmacia = :id AND servico_status = 1";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':id', $id);
        $conect->execute();

        if($conect->rowCount() > 0) {
            $dados['t'] = $conect->fetch();
        }

        return $dados['t'];
    }

    //conta todos os remédios com qtd em baixa de cada usuário
    public function countBaixas(int $farmacia)
    {
        $dados = array();

        $sql = "SELECT count(*) as t FROM servico 
				WHERE servico_farmacia = :farmacia AND servico_qtd = 3";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':farmacia', $farmacia);
        $conect->execute();

        if($conect->rowCount() > 0) {
            $dados = $conect->fetch();
        }

        return $dados['t'];
    }

    //função responsável por adicionar o servico
    public function addServico(int $farmacia, int $remedio)
    {
        if(!$this->existeServico($farmacia, $remedio)) {
            $sql = "INSERT INTO servico
				(servico_farmacia, servico_remedio, servico_create)
				VALUES 
				(:farmacia, :remedio, NOW())";
            $conect = $this->db->prepare($sql);
            $conect->bindValue(':farmacia', $farmacia);
            $conect->bindValue(':remedio', $remedio);
            $conect->execute();

            return true;
        }
        return false;
    }

    public function getServico(int $id)
    {
        $dados = array();

        $sql = "SELECT s.servico_id, s.servico_create as data, 
				q.qtd_nome as qtd, r.remedio_nome as remedio, 
				f.farmacia_nome as farmacia, s.servico_remedio as teste
				FROM servico s
				INNER JOIN remedio r on s.servico_remedio = r.remedio_id
				INNER JOIN farmacia f on s.servico_farmacia = f.farmacia_id
				INNER JOIN qtd q on s.servico_qtd = q.qtd_id
				WHERE f.farmacia_id = :id";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':id', $id);
        $conect->execute();

        if($conect->rowCount() > 0) {
            $dados = $conect->fetchAll();
        }

        return $dados;
    }

    //conta todos os remédios adicionados pela farmácia
    public function countAll(int $farmacia)
    {
        $dados = array();

        $sql = "SELECT count(*) as t FROM servico
				WHERE servico_farmacia = :farmacia";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':farmacia', $farmacia);
        $conect->execute();

        if($conect->rowCount() > 0) {
            $dados = $conect->fetch();
        }

        return $dados['t'];
    }

    private function existeServico(int $farmacia, int $remedio)
    {
        $sql = "SELECT servico_id FROM servico
				WHERE servico_farmacia = :farmacia AND servico_remedio = :remedio";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':farmacia', $farmacia);
        $conect->bindValue(':remedio', $remedio);
        $conect->execute();

        if($conect->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}