<?php
class Posts extends Controller{
public function __construct(){

	
$this->postModel = $this->model('Post');
$this->userModel = $this->model('User');

}

public function index(){
	
}
public function edit($id){
if($_SERVER['REQUEST_METHOD'] == 'POST'){

$_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

$data = [
 'id'=>$id,	
 'title' =>trim($_POST['title']),
 'body' =>trim($_POST['body']),
 'user_id' =>$_SESSION['user_id'],
 'title_err' =>'',
 'body_err' =>''
];

if(empty($data['title'])){
$data['title_err'] = "Please enter title";
}

if(empty($data['body'])){
$data['body_err'] = "Please enter body text";
}

if(empty($data['title_err']) && empty($data['body_err'])){

if($this->postModel->updatePost($data)){
redirect('pages/blog');	
}else{
	die("Something went wrong");
}

}else{

$this->view('posts/edit', $data);


}

}else{
$post = $this->postModel->getPostById($id);

if($post->user_id != $_SESSION['user_id']){
redirect('posts');	
}
	
$data = [
 'id' =>$id,	
 'title' =>$post->title,
 'body' =>$post->body

];
$this->view('posts/edit', $data);
}
}

public function show($id){

$post = $this->postModel->getPostById($id);
$user = $this->userModel->getUserById($post->user_id);
$data =[
'post'=>$post,
 'user'=>$user
];
$this->view('posts/show',$data);

}


public function add(){
if($_SERVER['REQUEST_METHOD'] == 'POST'){
 
$_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

$data = [
 'title' =>trim($_POST['title']),
 'body' =>trim($_POST['body']),
 'user_id' =>$_SESSION['user_id'],
 'user_role'=>$_SESSION['user_role'],
 'title_err' =>'',
 'body_err' =>''
];

if(empty($data['title'])){
$data['title_err'] = "Please enter title";
}

if(empty($data['body'])){
$data['body_err'] = "Please enter body text";
}

if(empty($data['title_err']) && empty($data['body_err']) && $_SESSION['user_role'] !=='guest'){

if($this->postModel->addPost($data) ){
redirect('pages/blog');	
}else{
	die("Something went wrong");
}

}else{

$this->view('posts/add', $data);


}

}else{
	
$data = [
 'title' =>'',
 'body' =>''

];
$this->view('posts/add', $data);
}
}
public function delete($id){

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$post = $this->postModel->getPostById($id);

if($post->user_id != $_SESSION['user_id']){
redirect('pages/blog');}


if($this->postModel->deletePost($id)){
redirect('pages/blog');	
}else{
die('Something went wrong');	
}


}else{
redirect('pages/blog');	
}

}

public function deleteByAdmin($id){

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$post = $this->postModel->getPostById($id);


if($this->postModel->deletePost($id)){
redirect('pages/dashindex');	
}else{
die('Something went wrong');	
}


}else{
redirect('pages/dashindex');	
}

}


}
?>