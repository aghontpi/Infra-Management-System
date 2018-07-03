<?php
class DB
{
	private $hostname = 'localhost:3306';
	private $username = 'root';
	private $password = 'fighting?';
	private $dbName = 'management'; 
	public $dbh = NULL;

	public function __construct() {
		try
		{
			$this->dbh = new PDO("mysql:host=$this->hostname;dbname=$this->dbName", $this->username, $this->password);		
		}
		catch(PDOException $e)
		{
			echo __LINE__.$e->getMessage();
		}
	}
	public function __destruct(){
		$this->dbh = NULL;
	}
	public function runQuery($sql){
		try
		{
			$count = $this->dbh->exec($sql) or print_r($this->dbh->errorInfo());
		}
		catch(PDOException $e)
		{
			echo __LINE__.$e->getMessage();
		}
	}
	public function getQuery($sql){
		$stmt = $this->dbh->query($sql);
	    $stmt->setFetchMode(PDO::FETCH_ASSOC);
		return $stmt; 
	}
}
?>