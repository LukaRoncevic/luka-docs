<?php
class Comments extends Controller{

public function __construct(){
$this->commentModel = $this->model('Comment');
$this->userModel = $this->model('User');
}

public function index(){

}


public function addComments(){
if($_SERVER['REQUEST_METHOD'] == 'POST'){
 
$_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

$data = [
 'title' =>trim($_POST['title']),
 'body' =>trim($_POST['body']),
 'user_id' =>$_SESSION['user_id'],
 'user_role'=>$_SESSION['user_role'],
 'id'=>$_SESSION['id'],
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

if($this->commentModel->addComment($data) ){
redirect('pages/blog');	
}else{
	die("Something went wrong");
}

}else{

$this->view('comments/add', $data);


}

}else{
	
$data = [
 'title' =>'',
 'body' =>'',
 'user_id' =>'',
 'user_role'=>'',
 'id'=>''
];
$this->view('comments/add', $data);
}
}


}
