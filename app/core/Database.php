<?php

namespace App\Core;
use PDO;
use PDOexception;

class Database {
	
	private $server = ":)";
	private $user = ":)";
	private $password = ":)";
	private $dbname = ":)";

	private $pdo;
	private $stmt;

	public function __construct() {
		$dsn = 'mysql:host=' . $this->server . ';dbname=' . $this->dbname . ';charset=utf8';

		$options = [
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION
		];

		try {
			$this->pdo = new PDO($dsn, $this->user, $this->password, $options);

		} catch(PDOexception $e) {
			echo $e->getMessage();
			die;
		}
	}

	public function query($query) {
		$this->stmt = $this->pdo->prepare($query);
	}

	public function bind($param, $value, $type = null) {
		if(is_null($type)) {
			switch(true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}

	public function execute() {
		return $this->stmt->execute();
	}

	public function resultSet() {
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}