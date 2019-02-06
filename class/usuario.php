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

	public function loadById($id){

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