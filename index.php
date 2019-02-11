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

//Carrega uma lista de usuários pelo login
//$search = usuario::search("jo");
//echo json_encode($search);

//Carregando usuário usando o login e a senha
$usuario = new Usuario();
$usuario->login("root","$#$%&@");

echo $usuario;

?>