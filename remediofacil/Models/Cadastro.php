<?php
namespace Models;

use Core\Model;

class Cadastro extends Model
{
    public function create(string $nome, string $email, string $cnpj, string $access)
    {
        if(!$this->existeEmail($email)) {

            $sql = "INSERT INTO cadastro (cadastro_nome, cadastro_email, cadastro_cnpj, cadastro_access,
                    cadastro_create)
                    VALUES (:nome, :email, :cnpj, :access, NOW())";
            $conect = $this->db->prepare($sql);
            $conect->bindValue(':nome', $nome);
            $conect->bindValue(':email', $email);
            $conect->bindValue(':cnpj', $cnpj);
            $conect->bindValue(':access', $access);
            $conect->execute();
            return true;
        }

        return false;
    }

    private function existeEmail(string $email)
    {
        $sql = "SELECT cadastro_id FROM cadastro WHERE cadastro_email = :email";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':email', $email);
        $conect->execute();

        if($conect->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function validar(string $token, string $email)
    {
        $sql = "UPDATE cadastro SET cadastro_status = 1, cadastro_update = NOW()
                WHERE cadastro_access = :token AND cadastro_email = :email";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':token', $token);
        $conect->bindValue(':email', $email);
        $conect->execute();

        return true;
    }
}