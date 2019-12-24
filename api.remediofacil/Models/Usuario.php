<?php
namespace Models;

use Core\Model;

class Usuario extends Model
{
    //crinado usuario
    public function create_user(string $nome, string $email, string $senha, string $uf)
    {
        if(!$this->existeUsuario($email)) {

            //criptografando senha
            $hash = password_hash($senha, PASSWORD_BCRYPT);

            $sql = "INSERT INTO usuario (usuario_nome, usuario_email, usuario_senha,usuario_uf, usuario_create)
                    VALUES (:nome, :email, :senha,:uf, NOW())";
            $conect = $this->db->prepare($sql);
            $conect->bindValue(':nome', $nome);
            $conect->bindValue(':email', $email);
            $conect->bindValue(':senha', $hash);
            $conect->bindValue(':uf', $uf);
            $conect->execute();

            return true;
        }

        return false;
    }

    //salvando codigo de confirmação
    public function saveCode(string $email, string $code)
    {
        $sql = "UPDATE usuario SET usuario_code = :code, usuario_update = NOW()
                WHERE usuario_email = :email";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':code', $code);
        $conect->bindValue(':email', $email);
        $conect->execute();

        return true;
    }

    //confirmando código de confirmação
    public function confirmCode(string $code)
    {
        $sql = "SELECT usuario_id FROM usuario
                WHERE usuario_code = :code";
        $conect= $this->db->prepare($sql);
        $conect->bindValue(':code', $code);
        $conect->execute();

        if($conect->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //limpando código de confirmação
    public function clearCode(string $code)
    {
        $sql = "UPDATE usuario SET usuario_code = NULL, usuario_update = NOW(), usuario_status = '1'
                WHERE usuario_code = :code";
        $conect= $this->db->prepare($sql);
        $conect->bindValue(':code', $code);
        $conect->execute();

        return true;
    }

    //logando usuário
    public function logUsuario(string $email, string $senha)
    {
        $dados = array();

        $sql = "SELECT usuario_id, usuario_senha FROM usuario
                WHERE usuario_email = :email AND usuario_status = 1";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':email', $email);
        $conect->execute();

        if($conect->rowCount() > 0) {
            $dados = $conect->fetch();

            if(password_verify($senha, $dados['usuario_senha'])) {
                return true;
            } else {
                return false;
            }
        }
    }


    public function getId(string $email, string $senha)
    {
        $dados = array();

        $sql = "SELECT usuario_id, usuario_senha FROM usuario
                WHERE usuario_email = :email";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':email', $email);
        $conect->execute();

        if($conect->rowCount() > 0) {
            $info = $conect->fetch();

            if(password_verify($senha, $info['usuario_senha'])) {
                $dados = $info['usuario_id'];
                return $dados;
            } else {
                return false;
            }
        }
    }

    //pegando informações do usuário
    public function getUsuario(int $id)
    {
        $dados = array();

        $sql = "SELECT usuario_id, usuario_nome, usuario_email, usuario_uf 
                FROM usuario WHERE usuario_id = :id";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':id', $id);
        $conect->execute();

        if($conect->rowCount() > 0) {
            $dados = $conect->fetch();
        }

        return $dados;
    }


    //editando usuário
    public function setUsuarioName(string $nome, string $id)
    {
        $sql = "UPDATE usuario SET usuario_nome = :nome,usuario_update = NOW() 
                WHERE usuario_id = :id";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':nome', $nome);
        $conect->bindValue(':id', $id);
        $conect->execute();

        return true;
    }

    //editando senha
    public function setUsuarioPass(string $senha, string $id)
    {

        //criptografando senha
        $hash = password_hash($senha, PASSWORD_BCRYPT);

        $sql = "UPDATE usuario SET usuario_senha = :senha, usuario_update = NOW() 
                WHERE usuario_id = :id";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':senha', $hash);
        $conect->bindValue(':id', $id);
        $conect->execute();

        return true;
    }


    public function addAccess(string $email, string $access)
    {
        $sql = "UPDATE usuario SET usuario_access = :access, usuario_update = NOW() 
                WHERE usuario_email = :email";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':access', $access);
        $conect->bindValue(':email', $email);
        $conect->execute();

        return true;
    }


    //função auxiliar, auxilia na criação do usuário
    //1 email por usuário
    private function existeUsuario(string $email)
    {
        $sql = "SELECT usuario_id FROM usuario
                WHERE usuario_email = :email";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':email', $email);
        $conect->execute();

        if($conect->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}