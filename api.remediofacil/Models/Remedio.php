<?php
namespace Models;

use Core\Model;

class Remedio extends Model
{

    public function getRemedio(string $remedio)
    {
        $dados = array();

        $sql = "SELECT remedio_id as identificador, remedio_nome as nome FROM remedio 
                WHERE remedio_nome like :nome";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':nome', $remedio.'%');
        $conect->execute();

        if($conect->rowCount() > 0) {
            $dados = $conect->fetchAll();
        }

        return $dados;
    }
}