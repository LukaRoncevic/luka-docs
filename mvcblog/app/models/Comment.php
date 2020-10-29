<?php
class Comment{

private $db;

public function __construct(){

$this->db = new Database;	
}

public function getComments(){

$this->db->query('SELECT *,
                  comments.id as commentId,
                  users.id as userId,
                  users.name as userName,
                  comments.created_at as commentCreated,
                  users.created_at as userCreated
                  FROM comments
                  INNER JOIN users
                  ON comments.user_id = users.id
                  ORDER BY comments.created_at DESC
	              ');

$results = $this->db->resultSet();

return $results;

}
public function getCommentsAndPosts(){

$this->db->query('SELECT *,
                  comments.id as commentId,
                  posts.id as postId,
                  comments.created_at as commentCreated,
                  posts.created_at as postCreated
                  FROM comments
                  INNER JOIN posts
                  ON comments.user_id = posts.id
                  ORDER BY comments.created_at DESC
	              ');

$results = $this->db->resultSet();

return $results;

}

public function addComment($data){
$this->db->query("INSERT INTO comments (title, user_id, body) VALUES(:title, :user_id, :body)");

$this->db->bind(':title', $data['title']);
$this->db->bind(':user_id', $data['user_id']);
$this->db->bind(':body', $data['body']);

if($this->db->execute()){
return true;      
}else{
return false;     
}

}
public function getCommentById($id){

$this->db->query('SELECT * FROM comments WHERE id = :id');
$this->db->bind(':id', $id);

$row = $this->db->single();

return $row;
}

}