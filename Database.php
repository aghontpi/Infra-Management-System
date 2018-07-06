<?php
class DB
{
	private $hostname = 'localhost:3306';
	private $username = 'root';
	private $password = 'fighting?';
	private $dbName = 'management'; 
	public $dbh = NULL;

	public function __construct() {
		try{
			$this->dbh = new PDO("mysql:host=$this->hostname;dbname=$this->dbName", $this->username, $this->password);		
		}
		catch(PDOException $e){
			echo __LINE__.$e->getMessage();
		}
	}
	public function __destruct(){
		$this->dbh = NULL;
	}
	public function runQuery($sql){
		try{
			$count = $this->dbh->exec($sql) or print_r($this->dbh->errorInfo());
		}
		catch(PDOException $e){
			echo __LINE__.$e->getMessage();
		}
	}
	public function getQuery($sql){
		$stmt = $this->dbh->query($sql);
	    $stmt->setFetchMode(PDO::FETCH_ASSOC);
		return $stmt; 
	}
	public function getNumberPendingAccounts(){
			$sql ="SELECT COUNT(verified) FROM users WHERE verified = 0";
			$stmt = $this->dbh->query($sql);
  			$fetchres = $stmt->fetch();
  			$result = $fetchres["COUNT(verified)"];
  			return $result;
	}

	public function grantPermission($todo, $user){
		$sql  = "UPDATE users SET verified =:todo WHERE user_name=:user";
		$query = $this->dbh->prepare($sql);
		$query->bindValue(":todo",$todo);
		$query->bindValue(":user",$user);
		try{
			$res= $query->execute();
		}
		catch (PDOException $e){
			echo $e;
		}
		return $res;
	}
	public function deleteUser($user){
		$sql = "DELETE FROM users WHERE user_name =:user";
		$query = $this->dbh->prepare($sql);
		$query -> bindValue(":user",$user);
		try{
			$result= $query->execute();
		}
		catch (PDOException $e){
			echo $e;
		}
		return $result;
	}
}
?>