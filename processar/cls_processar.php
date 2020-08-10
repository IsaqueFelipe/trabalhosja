<?php
//====Processamento==Teste====//
/**
 * 
 */
class Conexao	{

	private $servidor;
	private $usuario;
	private $senha;
	private $banco;
	private static $pdo;


	public function __construct()	{
		$this->servidor ="localhost";
		$this->usuario = "root";
		$this->senha = "";
		$this->"trabalhosja";
	}


	public function Conectar()	{
		try {
			if (is_null(self::$pdo)) {
				self::$pdo = new PDO("mysql:host=".$this->servidor.";dbname=".$this->banco, $this->usuario, $this->senha);
			}
			return self::$pdo;
		} catch (PDOException $e) {
			echo 'Erro: ' . $e->getMessage();
		}
	}
}


?>

