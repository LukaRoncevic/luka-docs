<?php
class Page{

private $db;

public function __construct(){

$this->db = new Database;	
}

public function updateHome($data){

$this->db->query('UPDATE pagehome SET title = :title, body =:body');
$this->db->bind(':title', $data['title']);
$this->db->bind(':body', $data['body']);


if ($this->db->execute()) {
return true;
}else{
return false;
}

}

public function getHomeById(){

$this->db->query('SELECT * FROM pagehome WHERE id=1');


$row = $this->db->single();

return $row;
}

public function updateAbout($data){

$this->db->query('UPDATE pageabout SET title = :title, body =:body');
$this->db->bind(':title', $data['title']);
$this->db->bind(':body', $data['body']);


if ($this->db->execute()) {
return true;
}else{
return false;
}

}

public function getAboutById(){

$this->db->query('SELECT * FROM pageabout WHERE id=1');


$row = $this->db->single();

return $row;
}
}


?>