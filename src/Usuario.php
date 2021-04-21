<?php

class Usuario
{
    private $id_usuario;
    private $txt_login;
    private $txt_senha;
    private $dt_cadastro;

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
            $reg = $resultados[0];
            $this->setIdUsuario($reg['id_usuario']);
            $this->setTxtLogin($reg['txt_login']);
            $this->setTxtSenha($reg['txt_senha']);
            $this->setDtCadastro(new DateTime($reg['dt_cadastro']));
        }
    }

    public function __toString() {
        return json_encode(array(
            "id_usuario" => $this->getIdUsuario(),
            "txt_login" => $this->getTxtLogin(),
            "txt_senha" => $this->getTxtSenha(),
            "dt_cadastro" => $this->getDtCadastro()->format("d/m/Y H:i:s")
        ));
    }
}