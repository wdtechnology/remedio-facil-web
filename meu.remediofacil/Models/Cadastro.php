<?php
namespace Models;

use Core\Model;

class Cadastro extends Model
{
    //pega todos os cadastros existentes
    public function getCadastros()
    {
        $dados = array();

        $sql = "SELECT cadastro_id, cadastro_email, cadastro_cnpj, cadastro_create 
				FROM cadastro WHERE cadastro_status = 1 AND cadastro_id != 1 AND cadastro_confirm = 0";
        $conect = $this->db->query($sql);

        if($conect->rowCount() > 0) {
            $dados = $conect->fetchAll();
        }

        return $dados;
    }

    //editando cadastro após dados serem corretos
    public function setCadastro(int $id)
    {
        $sql = "UPDATE cadastro SET cadastro_confirm = 1, cadastro_update = NOW()
				WHERE cadastro_id = :id";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':id', $id);
        $conect->execute();

        return true;
    }

    //pega o cnpj de acordo com o id
    public function getCnpj(int $id)
    {
        $dados = array();

        $sql = "SELECT cadastro_id, cadastro_cnpj FROM cadastro WHERE cadastro_id = :id";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':id', $id);
        $conect->execute();

        if($conect->rowCount() > 0) {
            $dados = $conect->fetch();
        }

        return $dados;
    }

    //pegando dados para adicionar a outra tabela.
    public function successCadastro(int $id)
    {
        $dados = array();

        $sql = "SELECT cadastro_id, cadastro_email, cadastro_cnpj FROM cadastro
				WHERE cadastro_id = :id";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':id', $id);
        $conect->execute();

        if($conect->rowCount() > 0) {
            $dados = $conect->fetch();
        }

        return $dados;
    }

    //deletar cadastros inavlidos
    public function delete(int $id)
    {
        $sql = "DELETE FROM cadastro WHERE cadastro_id = :id";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':id', $id);
        $conect->execute();

        return true;
    }
}