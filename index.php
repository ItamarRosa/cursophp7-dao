<?php
require_once("config.php"); 
/* $sql = new sql(); $usuarios = $sql->select("SELECT * FROM tb_usuarios"); echo json_encode($usuarios); */

//Carrega um usuario ---------------------------------------
/*$root = new Usuario();
$root->loadById(3);
echo $root;
*/

// carrega uma lista de usuário
//$lista = usuario::getlist();
//echo json_encode($lista);

//Carrega uma lista de usuários pelo login----------------------------
//$search = usuario::search("jo");
//echo json_encode($search);

//Carregando usuário usando o login e a senha (FAZENDO LOGIN)------------------------
//$usuario = new Usuario();
//$usuario->login("root","$#$%&@");

//echo $usuario;

//Criando úm novo usuario------------------------------
//$aluno = new Usuario("aluno", "@lun0"); //foi craido metodo mágico para passar os valores quando o objeto for instanciado

//outra foram de forma passar o usuario e a senha.
//$aluno->setDeslogin("aluno");
//$aluno->setDessenha("@lun0");

//$aluno->insert(); outra forma

//echo $aluno;
//--------------------Alterando usuario-------------------------------
/*
$usuario = new Usuario();

$usuario->loadById(8);//informar o id a ser alterado

$usuario->update("professor","#U$$&&%");

echo $usuario;
*/

//Apagando usuario
$usuario = new Usuario();

$usuario->loadById(7);//informar o id a ser alterado

$usuario->delete();

echo $usuario;	


?>