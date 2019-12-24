<?php
namespace Models;

use Core\Model;

class Qtd extends Model
{
    public function getQuantidade()
    {
        $dados = array();

        $sql = "SELECT * FROM qtd";
        $conect = $this->db->query($sql);

        if($conect->rowCount() > 0) {
            $dados = $conect->fetchAll();
        }

        return $dados;
    }
}