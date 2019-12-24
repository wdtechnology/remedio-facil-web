<?php
namespace Models;

use Core\Model;

class Usuario extends Model
{


	//dados referentes ao mobile

	//editando senha
    public function setUsuarioPassWemail(string $senha, string $email, string $access)
    {

        //criptografando senha
        $hash = password_hash($senha, PASSWORD_BCRYPT);

        $sql = "UPDATE usuario SET usuario_senha = :senha, usuario_update = NOW() 
                WHERE usuario_email = :email AND usuario_access = :access";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':email', $email);
        $conect->bindValue(':access', $access);
        $conect->bindValue(':senha', $hash);
        $conect->execute();

        return true;
    }

    //limpando o access gerado
    public function cleanAccess(string $email, string $access)
    {

        $sql = "UPDATE usuario SET usuario_access = NULL, usuario_update = NOW()
                WHERE usuario_email = :email AND usuario_access = :access";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':email', $email);
        $conect->bindValue(':access', $access);
        $conect->execute();

        return true;
    }
}