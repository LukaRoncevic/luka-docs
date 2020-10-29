<?php
class Upload{

private $db;

public function __construct(){

$this->db = new Database;	
}


public function uploadPhoto($data){
$this->db->query("INSERT INTO uploads (name,user_id,image) VALUES(:name,:user_id,:image)");

$this->db->bind(':name', $data['name']);
$this->db->bind(':user_id', $data['user_id']);
$this->db->bind(':image', $data['image']);

if($this->db->execute()){
return true;      
}else{
return false;     
}

}

public function getPhotos(){

$this->db->query("SELECT * FROM uploads");


$results = $this->db->resultSet();

return $results;

}

}