<?php class Pagination{


private $db;

public function __construct(){

$this->db = new Database;	
} 

public function countAll(){
$this->db->query("SELECT count(*) FROM posts");
$total_results =$this->db->resultSet();
return $total_results;	
}



}


?>