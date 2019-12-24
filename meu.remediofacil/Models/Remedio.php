<?php
namespace Models;

use Core\Model;

class Remedio extends Model
{
    //adiciona remédios ao banco de dados
    public function addRemedio(string $nome)
    {
        if($this->existeRemedio($nome) == false) {

            $sql = "INSERT INTO remedio
				(remedio_nome, remedio_create)
				VALUES
				(:nome, NOW())";
            $conect = $this->db->prepare($sql);
            $conect->bindValue(':nome', $nome);
            $conect->execute();

            return true;
        }

        return false;
    }

    //pega todos os remédios
    public function getRemedios(int $offset,int $limite)
    {
        $dados = array();

        $sql = "SELECT * FROM remedio LIMIT $offset, $limite";
        $conect = $this->db->query($sql);

        if($conect->rowCount() > 0) {
            $dados = $conect->fetchAll();
        }

        return $dados;
    }

    public function getRemedio(int $id)
    {
        $dados = array();

        $sql = "SELECT remedio_id, remedio_nome FROM remedio WHERE remedio_id = :id";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':id', $id);
        $conect->execute();

        if($conect->rowCount() > 0) {
            $dados = $conect->fetch();
        }

        return $dados;
    }

    //função exclusiva para o admin do sistema
    //edita algum remédio
    public function setRemedio(string $nome, int $id)
    {
        $sql = "UPDATE remedio SET remedio_nome = :nome, remedio_update = NOW()
				WHERE remedio_id = :id";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':nome', $nome);
        $conect->bindValue(':id', $id);
        $conect->execute();

        return true;
    }

    //pega o total de resultados da pesquisa
    public function countBusca(string $busca)
    {
        $sql = "SELECT COUNT(*) as c 
				FROM remedio WHERE remedio_nome LIKE :busca";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':busca', '%'.$busca.'%');
        $conect->execute();

        $row = $conect->fetch();

        return $row['c'];
    }

    //pesquisa
    public function getBusca(string $busca)
    {
        $data = array();

        $sql = "SELECT * FROM remedio WHERE remedio_nome LIKE :busca";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':busca', '%'.$busca.'%');
        $conect->execute();

        if($conect->rowCount() > 0) {
            $data = $conect->fetchAll();
        }

        return $data;
    }



    //conta todos os remédios
    public function countRemedios()
    {
        $dados = array();

        $sql = "SELECT count(*) as t FROM remedio";
        $conect = $this->db->query($sql);

        $dados = $conect->fetch();

        return $dados['t'];
    }

    //função que irá verificar se existe remédio com o msm nome no banco
    //retornará true se existir
    //false senão existir
    private function existeRemedio(string $nome)
    {
        $sql = "SELECT remedio_id FROM remedio WHERE remedio_nome = :nome";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':nome', $nome);
        $conect->execute();

        if($conect->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

}