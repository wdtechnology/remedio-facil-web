<?php
namespace Models;

use Core\Model;

class Posto extends Model
{
    public function create(int $id)
    {
        if(!$this->existePosto($id)) {

            $sql = "INSERT INTO posto (posto_farmacia, posto_create) VALUES (:id, NOW())";
            $conect = $this->db->prepare($sql);
            $conect->bindValue(':id', $id);
            $conect->execute();

            return true;
        }
        return false;
    }
    
    public function gerandoSessao(int $posto_farmacia)
    {
        $dados = array();

        $sql = "SELECT posto_id FROM posto
                WHERE posto_farmacia = :farmacia";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':farmacia', $posto_farmacia);
        $conect->execute();

        if($conect->rowCount() > 0) {
            $dados = $conect->fetch();
            $_SESSION['posto'] = $dados['posto_id'];
        }

        return $dados;
    }

    public function confirmarPosto(int $id)
    {
        $dados = array();

        $sql = "SELECT posto_id FROM posto WHERE posto_farmacia = :id";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':id', $id);
        $conect->execute();

        if($conect->rowCount() > 0 ) {
            $dados = $conect->fetch();
        }

        return $dados;
    }

    private function existePosto(int $id)
    {
        $sql = "SELECT posto_id FROM posto WHERE posto_farmacia = :id";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':id', $id);
        $conect->execute();

        if($conect->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function postoChecked(int $id)
    {
        $sql = "SELECT posto_id FROM posto WHERE posto_farmacia = :id";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':id', $id);
        $conect->execute();

        if($conect->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
