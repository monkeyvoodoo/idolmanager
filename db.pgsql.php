<?php
class db {
	private $db;
	private $sql = '';
	private $qry;
	private $rows = array();
	private $row = array();
	private $nullValue = null; // wtf really

	public function __construct() {
		$connectString = "host=".file_get_contents('./dbhost')." dbname=idol user=idol password=".file_get_contents('./dbpass');
		// message($connectString, true);
		$this->db = pg_connect($connectString);
		if(false === $this->db) message("Database connection failed");
	}

	// public function prepare(string $sql, $name = 'untitled_query') {
	// 	try {
	// 		pg_prepare($this->db, $sql);
	// 		// $this->qry->bindParam(':null', $this->nullValue, PDO::PARAM_INT);
	// 	} catch(PDOException $e) {
	// 		exit("Error running query: {$e->getMessage()}");
	// 	}
	// }

	public function execute(array $fieldMaps = array()) {
		if(count($fieldMaps) > 0) {
			foreach($fieldMaps as $k => $v) {
				if(is_null($v)) $fieldMaps[$k] = 'NULL';
				else $fieldMaps[$k] = "'".pg_escape_string($this->db, $v)."'";
			}
		}

		$this->sql = strtr($this->sql, $fieldMaps);
		$this->qry = pg_query($this->db, $this->sql);
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

	public function query(string $sql, array $fieldMaps = array(), $dumpSql = false): array
	{
		$this->sql = $sql;
		$this->execute($fieldMaps);
		if($dumpSql) message($this->sql, true);
		if(false === $this->qry) message("Query failed: ".pg_last_error($this->db)."\n\nSQL was:\n{$this->sql}", true);
		$this->rows = pg_fetch_all($this->qry);
		if(false === $this->rows) $this->rows = array();
		return($this->rows);
	}
}
?>