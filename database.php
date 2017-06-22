<?php
class db {
	private $db;
	private $sql = '';
	private $qry;
	private $rows = array();
	private $row = array();
	private $nullValue = null; // wtf really

	public function __construct() {
		try {
				$this->db = new PDO("pgsql:host=/var/run/postgresql dbname=idol user=idol password=".file_get_contents('./dbpass'));
		} catch(PDOException $e) {
				exit("Database connection failed: {$e->getMessage()}");
		}
	}

	// public function sql(string $sql): void
	// {
	// 	$this->sql = $sql;
	// }

	public function prepare(string $sql) {
		try {
			$this->qry = $this->db->prepare($sql);
			// $this->qry->bindParam(':null', $this->nullValue, PDO::PARAM_INT);
		} catch(PDOException $e) {
			exit("Error running query: {$e->getMessage()}");
		}
	}

	public function execute(array $fieldMaps = array()) {
		if(count($fieldMaps) == 0) $fieldMaps = null;
		try {
			$result = $this->qry->execute($fieldMaps);
			$err = $this->db->errorInfo();
			if(false === $result) {
				$s = $this->sql;
				foreach($fieldMaps as $k => $v) $s = strtr($s, array($k => "'".strtr($v, array("'" => "''"))."'"));
				exit("Execution failed: ".print_r($err, true)."\n\nSQL was: {$s}");
			}
		} catch(PDOException $e) {
			exit("Execution failed: {$e->getMessage()}");
		}
	}

	public function fetchAll(): array
	{
		try {
			$rows = $this->qry->fetchAll(PDO::FETCH_ASSOC);
			if(false === $rows) $rows = array();
		} catch(PDOException $e) {
			exit("Fetch failed: {$e->getMessage()}");
		}
		return($rows);
	}

	public function query(string $sql, array $fieldMaps = array()): array
	{
		try {
			// if(count($fieldMaps) > 0) exit(print_r($fieldMaps, true));
			$this->sql = $sql;
			$this->prepare($sql);
			$this->execute($fieldMaps);
		} catch(PDOException $e) {
			exit("Full query failed: {$e->getMessage()}");
		}
		return($this->fetchAll());
	}
}
?>