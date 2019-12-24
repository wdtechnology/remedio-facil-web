<?php
namespace Models;

use Core\Model;

class Envio extends Model
{
    public function getEnvio(int $id)
    {
        $dados = array();

        $sql = "SELECT e.envio_id, u.usuario_nome as usuario, e.envio_remedio as remedio,
                e.envio_estimada as estimada 
                FROM envio as e 
                JOIN usuario as u
                ON e.envio_usuario = u.usuario_id
                WHERE e.envio_posto = :posto AND e.envio_status = 0";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':posto', $id);
        $conect->execute();

        if($conect->rowCount() > 0) {
            $dados = $conect->fetchAll();
        }

        return $dados;
    }


    public function setStatusEnvio(int $id)
    {
        $sql = "UPDATE envio SET envio_status = 1, envio_update = NOW()
                WHERE envio_id = :id";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':id', $id);
        $conect->execute();

        return true;
    }
}