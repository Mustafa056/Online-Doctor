<?php 
class Connection
{
	public $conn;
	public function __construct()
	{
		$this->conn=new PDO('mysql:host=localhost;dbname=webtec_19','root','');
	}
	//insert Task in Dashboard
	public function insertTaskList($productTitle,$description,$weight)
	{
		try{
			$statement=$this->conn->prepare(
				"INSERT INTO task_list (productTitle,description,weight) VALUES (:productTitle,:description,:weight)"
			);
			$statement->execute(
				array(
					':productTitle'=>$productTitle,
					':description'=>$description,
					':weight'=>$weight
				)
			);
			//echo "Inserted";
		}catch(\Exception $e){
			echo "error: ".$e->getMessage();
		}
	}

	//insert Done Task in Dashboard
	public function insertDoneTaskList($productId,$productTitle,$description,$weight)
	{
		try{
			$statement=$this->conn->prepare(
				"INSERT INTO task_list_done (productId,productTitle,description,weight) VALUES (:productId,:productTitle,:description,:weight)"
			);
			$statement->execute(
				array(
					':productId'=>$productId,
					':productTitle'=>$productTitle,
					':description'=>$description,
					':weight'=>$weight
				)
			);
		}catch(\Exception $e){
			echo "error: ".$e->getMessage();
		}
	}

	//Showing DashBoard Details
	public function getAll($query)
	{
		$statement=$this->conn->prepare($query);
		$statement->execute();
		return $statement->fetchAll();//seect query user korle fetchAll() lage
	}

	public function login($query)
	{
		try{
			$statement=$this->conn->prepare($query);
			$statement->execute();
			return $statement->fetchAll();
		}catch(\Exception $e){
			echo "Id or Password Worng".$e->getMessage();
		}	
	}

	//Registration
	public function registration($query,$array)
	{
		$statement=$this->conn->prepare($query);
		$statement->execute($array);
	}

	//update
	public function update($query,$array)
	{
		$statement=$this->conn->prepare($query);
		$statement->execute($array);
		echo "Updateed";
	}
}
 ?>
