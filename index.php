<?php

require_once('config.php');

//$sql = new Sql();
//echo "teste";
//$usuarios = $sql->select('SELECT * FROM tb_usuarios');
//echo json_encode($usuarios);

// Carrega um usuário
//$user = new Usuario();
//$user->loadById(1);
//echo $user;

// Carrega uma lista de usuários
//$lista = Usuario::getList();
//echo json_encode($lista);

// Carrega uma lista de usuários buscando pelo login
//$lista = Usuario::search("user2");
//echo json_encode($lista);

// Carrega um usuário usando o login e a senha
//$user = new Usuario();
//$user->login('user1', '1234');
//echo $user;

// Inserir um usuário
//$user = new Usuario("user5", "666");
//$user->insert();
//echo $user;

// Alterar um usuário
$user = new Usuario();
$user->loadById('5');
$user->setTxtLogin('user5');
$user->setTxtSenha('42');
$user->update();
echo $user;