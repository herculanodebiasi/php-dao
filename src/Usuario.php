<?php

class Usuario
{
    private $id_usuario;
    private $txt_login;
    private $txt_senha;
    private $dt_cadastro;

    public function __construct($login = "", $senha = "")
    {
        $this->setTxtLogin($login);
        $this->setTxtSenha($senha);
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario): void
    {
        $this->id_usuario = $id_usuario;
    }

    public function getTxtLogin()
    {
        return $this->txt_login;
    }

    public function setTxtLogin($txt_login): void
    {
        $this->txt_login = $txt_login;
    }

    public function getTxtSenha()
    {
        return $this->txt_senha;
    }

    public function setTxtSenha($txt_senha): void
    {
        $this->txt_senha = $txt_senha;
    }

    public function getDtCadastro()
    {
        return $this->dt_cadastro;
    }

    public function setDtCadastro($dt_cadastro): void
    {
        $this->dt_cadastro = $dt_cadastro;
    }

    public function loadById($id)
    {
        $sql = new Sql();
        $resultados = $sql->select('SELECT * FROM tb_usuarios WHERE id_usuario=:ID', array(
            ":ID" => $id
        ));

        if (count($resultados) > 0) {
            $this->defineDados($resultados[0]);
        }
    }

    public static function getList()
    {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY txt_login");
    }

    public static function search($login)
    {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios WHERE txt_login LIKE :SEARCH ORDER BY txt_login", array(
            ":SEARCH" => "%$login%"
        ));
    }

    public function login($login, $senha)
    {
        $sql = new Sql();
        $resultados = $sql->select('SELECT * FROM tb_usuarios WHERE txt_login=:LOGIN AND txt_senha=:SENHA', array(
            ":LOGIN" => $login,
            ":SENHA" => $senha
        ));

        if (count($resultados) > 0) {
            $this->defineDados($resultados[0]);
        } else {
            throw new Exception("Login e/ou senha inválidos!");
        }
    }

    public function defineDados($dados)
    {
        $this->setIdUsuario($dados['id_usuario']);
        $this->setTxtLogin($dados['txt_login']);
        $this->setTxtSenha($dados['txt_senha']);
        $this->setDtCadastro(new DateTime($dados['dt_cadastro']));
    }

    public function insert()
    {
        $sql = new Sql();
        $resultados = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(
            ":LOGIN" => $this->getTxtLogin(),
            ":SENHA" => $this->getTxtSenha()
        ));

        if (count($resultados) > 0) {
            $this->defineDados($resultados[0]);
        }
    }

    public function update()
    {
        $sql = new Sql();
        $sql->query("UPDATE tb_usuarios SET txt_login=:LOGIN, txt_senha=:SENHA WHERE id_usuario=:ID", array(
            ":LOGIN" => $this->getTxtLogin(),
            ":SENHA" => $this->getTxtSenha(),
            ":ID" => $this->getIdUsuario()
        ));
    }

    public function __toString()
    {
        return json_encode(array(
            "id_usuario" => $this->getIdUsuario(),
            "txt_login" => $this->getTxtLogin(),
            "txt_senha" => $this->getTxtSenha(),
            "dt_cadastro" => $this->getDtCadastro()->format("d/m/Y H:i:s")
        ));
    }
}