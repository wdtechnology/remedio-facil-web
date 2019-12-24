<?php
namespace Models;

use Core\Model;

class Recebimento extends Model
{

    public function create(int $envio)
    {
        if(!$this->recebimentoExiste($envio)) {
            $sql = "INSERT INTO recebimento (recebimento_envio, recebimento_create)
                VALUES (:envio, NOW())";
            $conect = $this->db->prepare($sql);
            $conect->bindValue(':envio', $envio);
            $conect->execute();

            return true;
        }

        return false;
    }
    

    private function recebimentoExiste(int $envio)
    {
        $sql = "SELECT recebimento_id FROM recebimento
                WHERE recebimento_envio = :id";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':id', $envio);
        $conect->execute();

        if($conect->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function setRecebimento(int $id)
    {
        $sql = "UPDATE recebimento SET recebimento_status = 2, recebimento_update = NOW()
                WHERE recebimento_id = :id";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':id', $id);
        $conect->execute();

        return true;
    }

    
    public function getRecebimentos(int $posto)
    {
        $dados = array();

        $sql = "SELECT r.recebimento_id, e.envio_remedio as remedio, r.recebimento_create
                FROM recebimento as r
                INNER JOIN envio as e
                ON r.recebimento_envio = e.envio_id
                INNER JOIN posto as p
                ON e.envio_posto = p.posto_id
                INNER JOIN farmacia as f
                ON p.posto_farmacia = f.farmacia_id
                WHERE e.envio_posto = :id AND r.recebimento_status = '1'";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':id', $posto);
        $conect->execute();

        if($conect->rowCount() > 0) {
            $dados = $conect->fetchAll();
        }

        return $dados;
    }

    public function confirmRecebimento(int $id)
    {
        $sql = "UPDATE recebimento SET recebimento_status = 1, recebimento_update = NOW()
                WHERE recebimento_id = :id";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':id', $id);
        $conect->execute();

        return true;
    }


    public function deleteRecebimento(int $id)
    {
        $sql = "DELETE FROM recebimento WHERE recebimento_id = :id";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':id', $id);
        $conect->execute();

        return true;
    }
}