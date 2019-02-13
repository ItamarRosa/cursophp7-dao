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

			$this->setData($results[0]);;

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

			$this->setData($results[0]);

		} else {
			throw new Exception("Login e/ou senha inválidos.");
			
		}

	}


	public function setData($data){

			$this->setIdusuario($data['idusuario']);
			$this->setDeslogin($data['deslogin']);
			$this->setDessenha($data['dessenha']);
			$this->setDtcadastro(new DateTime($data['dtcadastro']));

	}


	//metodo insert para criar uma usuario novo apartir da nossa classe de usuario (foi criado uma procedure para inserir novo usa)
	public function insert(){
		
		$sql = new sql();
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha()

		));

		if(count($results)>0){

			$this->setData($results[0]);
		}	

	}


//metodo criado abaixo para realizar update (alteração) dos usuarios. Os parametros são passados no própio método chamado update para serem preenchidos no detro da query. Outra coisa, como está sendo colocado denntro da query  a partir  do getDeslogin e o do getDessenha e então vamos definílas dentro do Objeto.
public function update($login, $password){

	$this->setDeslogin($login);
	$this->setDessenha($password);	
	
	$sql = new sql();
	
	$sql->query("UPDATE tb_usuarios set deslogin = :LOGIN, desenha = :PASSWORD WHERE idusuario = :ID", array(
		':LOGIN'=>$this->getDeslogin(),
		'PASSWORD'=>$this->getDessenha(),
		':ID'=>$this->getIdusuario()
	));
}



//metodo criado para que seja passado os valores no momento em que o objeto for instanciado (para facilitar insert). Toda vez que chamar a classe usuario teríamos que passar o usuario e  a senha, para nã ose torna obrigatoriedade =e so colocar = "". Ou seja se voce chamar beza se não chamar ele ja vai alimentar eles com vazio dessa forma não dando erro.
	public function __construct($login = "" ,$password = ""){ 
		$this->setDeslogin($login);
		$this->setDessenha($password);	
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