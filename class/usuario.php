<?php

class Usuario {

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdusuario(){
		return $this->idusuario;
	}
	public function setIdusuario($vusr){
		$this->idusuario = $vusr;
	}

	public function getDeslogin(){
		return $this->deslogin;
	}
	public function setDeslogin($vdeslogin){
		$this->deslogin = $vdeslogin;
	}

	public function getDessenha(){
		return $this->dessenha;
	}
	public function setDessenha($vdessenha){
		$this->dessenha = $vdessenha;
	}

		public function getDtcadastro(){
		return $this->dtcadastro;
	}
	public function setDtcadastro($vcad){
		$this->dtcadastro = $vcad;
	}

	public function loadById($id){ //vai trazer um usuario da lista

		$sql = new sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID"=>$id));

		if(count($results)> 0){

			$row = $results[0];

			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));

		}
	}

	//Logo abaixo foi adicionado mais um metodo simples que vai ser trazido todos os usuarios que estão na tabela (O getList vai trazer uma lista de usuario)

	public static function getList(){

		$sql = new sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");

	}

	public static function search($login){

		$sql = new sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			':SEARCH'=>"%".$login."%"
		));
	}


	public function login($login,$password){

		$sql = new sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
			":LOGIN"=>$login,
			":PASSWORD"=>$password
			));

		if(count($results)> 0){

			$row = $results[0];

			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));

		} else {
			throw new Exception("Login e/ou senha inválidos.");
			

		}


	}


	public function __toString(){

		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/y H:i:s")
		));
	}


}

?>