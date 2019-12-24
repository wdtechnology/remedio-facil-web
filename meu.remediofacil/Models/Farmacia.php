<?php
namespace Models;

use Core\Model;

class Farmacia extends Model
{
    private $info;

    //create
    public function createFarmacia(string $nome, string $login, string $senha, int $cnpj, string $cep,
                                   string $cidade, string $bairro, string $rua, string $uf) {

        //verificação
        if(!$this->existeFarmacia($nome)) {

            $sql = "INSERT INTO farmacia
					(farmacia_nome, farmacia_login, 
					farmacia_senha, farmacia_cnpj, farmacia_cep, 
					farmacia_cidade, farmacia_bairro, farmacia_rua, farmacia_uf,
					farmacia_create)
					VALUES 
					(:nome, :login, :senha, :id, 
					:cep, :cidade, :bairro, :rua,:uf,  NOW())";
            $conect = $this->db->prepare($sql);
            $conect->bindValue(':nome', $nome);
            $conect->bindValue(':login', $login);
            $conect->bindValue(':senha', $senha);
            $conect->bindValue(':id', $cnpj);
            $conect->bindValue(':cep', $cep);
            $conect->bindValue(':cidade', $cidade);
            $conect->bindValue(':bairro', $bairro);
            $conect->bindValue(':rua', $rua);
            $conect->bindValue(':uf', $uf);
            $conect->execute();

            return true;
        }

        echo "hhh";
        return false;
    }

    //login
    public function logarFarmacia(string $login, string $senha)
    {
        $dados = array();

        $sql = "SELECT farmacia_id, farmacia_senha FROM farmacia WHERE farmacia_login = :login";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':login', $login);
        $conect->execute();

        if($conect->rowCount() > 0) {
            $dados = $conect->fetch();

            if(password_verify($senha, $dados['farmacia_senha'])) {
                $_SESSION['user_farmacia'] = $dados['farmacia_id'];
                return true;
            }
        }
    }

    //função responsável por pegar os dados da farmácia
    public function getFarmacia(int $id)
    {
        $dados = array();

        $sql = "SELECT f.*, c.cadastro_cnpj as cnpj
				FROM farmacia as f
				INNER JOIN cadastro as c 
				ON f.farmacia_cnpj = c.cadastro_id
				WHERE farmacia_id = :id";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':id', $id);
        $conect->execute();

        if($conect->rowCount() > 0) {
            $dados = $conect->fetch();
        }

        return $dados;
    }

    public function getNome(int $id)
    {
        $dados = array();

        $sql = "SELECT farmacia_nome, farmacia_status FROM farmacia WHERE farmacia_id = :id";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':id', $id);
        $conect->execute();

        if($conect->rowCount() > 0) {
            $dados = $conect->fetch();
        }

        return $dados;
    }

    //edita alguns dados da farmácia
    public function setFarmacia(string $nova, int $id)
    {
        $sql = "UPDATE farmacia 
				SET farmacia_senha = :nova, farmacia_update = NOW() 
				WHERE farmacia_id = :id";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':nova', $nova);
        $conect->bindValue(':id', $id);
        $conect->execute();

        return true;
    }

    //gera o token de accesso
    public function criarToken(string $login)
    {
        //criando o token;
        $token = md5(time().rand(0,9999).time().rand(0,9999));

        $sql = "UPDATE farmacia SET farmacia_token = :token WHERE farmacia_login = :login";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':token', $token);
        $conect->bindValue(':login', $login);
        $conect->execute();

        return $token;
    }

    //checa se o token existe. 2 usuários não podem estar na mesma conta ao mesmo tempo.
    public function checarLogin()
    {
        if(!empty($_SESSION['token'])) {

            $token = $_SESSION['token'];

            $sql = "SELECT * FROM farmacia WHERE farmacia_token = :token";
            $conect = $this->db->prepare($sql);
            $conect->bindValue(':token', $token);
            $conect->execute();

            if($conect->rowCount() > 0) {

                $this->info = $conect->fetch();

                return true;
            }
        }

        return false;
    }

    //checando permissão, o adm é o único que tem permissão = 1
    public function checarPermission(int $id)
    {
        $sql = "SELECT farmacia_id, farmacia_permission FROM farmacia
				WHERE farmacia_id = :id AND farmacia_permission = 1";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':id', $id);
        $conect->execute();

        if($conect->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function confirmarEmail(string $email)
    {
        $sql = "SELECT farmacia_id FROM farmacia WHERE farmacia_login = :email";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':email', $email);
        $conect->execute();

        if($conect->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function setFarmaciaReset(string $email, string $cod, string $access)
    {
        $sql = "UPDATE farmacia set farmacia_reset = :code, farmacia_access = :access, farmacia_update = NOW()
                WHERE farmacia_login = :email";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':email', $email);
        $conect->bindValue('code', $cod);
        $conect->bindValue('access', $access);
        $conect->execute();

        return true;
    }


    public function confirmarCode(string $code, string $acesso)
    {
        $sql = "SELECT farmacia_id FROM farmacia WHERE farmacia_reset = :code AND farmacia_access = :acesso";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':code', $code);
        $conect->bindValue(':acesso', $acesso);
        $conect->execute();

        if($conect->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function alterarSenha(string $senha, string $acesso)
    {
        $sql = "UPDATE farmacia SET farmacia_senha = :senha, farmacia_update = NOW()
                WHERE farmacia_access = :acesso";
        $conect = $this->db->prepare($sql);
        $conect->bindValue(':senha', $senha);
        $conect->bindValue(':acesso', $acesso);
        $conect->execute();
        return true;
    }


    //funções auxiliares
    private function existeFarmacia(string $nome) {
        $sql = "SELECT farmacia_id FROM farmacia WHERE farmacia_nome = :nome";
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