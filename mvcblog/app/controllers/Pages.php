<?php
class Pages extends Controller{
 public function __construct(){
if(!isLoggedIn()){
redirect('users/login');	
}
 	
$this->postModel = $this->model('Post');
$this->pagesModel = $this->model('Page');
$this->commentModel = $this->model('Comment');
$this->userModel = $this->model('User');
$this->uploadModel = $this->model('Upload');
 }

public function dashindex(){

$data =[

];

$this->view('pages/dashindex', $data);	
}

public function index(){

$posts =$this->postModel->getLastPosts();
$pages =$this->pagesModel->getHomeById();
$data = [
'posts'=>$posts,	
'title'=>$pages->title,
'body'=>$pages->body,
'information'=>'Here you can read newest posts' 
];

$this->view('pages/index', $data);

}


public function editHome(){

$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if($_SERVER['REQUEST_METHOD'] == 'POST'){


$data = [
'body' =>trim($_POST['body']),
'title' =>trim($_POST['title']),
'body_err'=>'',
'title_err' =>''
];

if(empty($data['body'])){
$data['body_err'] = 'Please enter body text';
}

if(empty($data['title'])){
$data['title_err'] = 'Please enter title';
}

if (empty($data['body_err']) && empty($data['title_err']))  {
$this->pagesModel->updateHome($data);
redirect('pages');
$this->view('pages/editHome',$data);
}else{
die("Something went wrong");	
}


}else{
$data=[
'id'=>'',
'body' =>'',
'title' =>'',
'body_err'=>'',
'title_err' =>''
];	
$this->view('pages/editHome',$data);
}
	
}	

public function editAbout(){

$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if($_SERVER['REQUEST_METHOD'] == 'POST'){


$data = [
'body' =>trim($_POST['body']),
'title' =>trim($_POST['title']),
'body_err'=>'',
'title_err' =>''
];

if(empty($data['body'])){
$data['body_err'] = 'Please enter body text';
}

if(empty($data['title'])){
$data['title_err'] = 'Please enter title';
}

if (empty($data['body_err']) && empty($data['title_err']))  {
$this->pagesModel->updateAbout($data);
redirect('pages');
$this->view('pages/editAbout',$data);
}else{
die("Something went wrong");	
}


}else{
$data=[
'id'=>'',
'body' =>'',
'title' =>'',
'body_err'=>'',
'title_err' =>''
];	
$this->view('pages/editAbout',$data);
}
	
}	
public function about(){
$pages =$this->pagesModel->getAboutById();	
$data = [	
'title'=>$pages->title,
'body'=>$pages->body,
];


$this->view('pages/about' , $data);
 }


public function blog(){
$photos = $this->uploadModel->getPhotos();	
$posts =$this->postModel->getPosts();
$comments =$this->commentModel->getComments();
$data = [
'comments'=>$comments,	
'posts'	=>$posts,
'photos'=>$photos,
'title' => 'This is a blog about Osijek',
'description'=>'Here you can read ours blog posts and ADD your own posts' 
];


$this->view('pages/blog',$data);
 }

public function AdminDeleteBlogPost(){
$posts =$this->postModel->getPosts();
$data =[
'posts'	=>$posts
];
$this->view('pages/AdminDeleteBlogPost',$data);
}

//public function displayComments(){

//$comment = $this->commentModel->getCommentById($id);
//$user = $this->userModel->getUserById($comment->user_id);
//$data =[
//'comment'=>$comment,
 //'user'=>$user
//];
//$this->view('pages/displayComments',$data);

//}

public function displayComments(){
$comments =$this->commentModel->getComments();
$data = [
'comments'=>$comments
];
	$this->view('pages/displayComments',$data);
}


public function contact(){
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


$data = [
'name'=>trim($_POST['name']),
'email'=>trim($_POST['email']),
'message'=>trim($_POST['message']),
'subject'=>trim($_POST['subject']),

];


$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$subject = $_POST['subject'];
header('Content-Type: application/json');
if ($name === ''){
print json_encode(array('message' => 'Name cannot be empty', 'code' => 0));
exit();
}
if ($email === ''){
print json_encode(array('message' => 'Email cannot be empty', 'code' => 0));
exit();
} else {
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
print json_encode(array('message' => 'Email format invalid.', 'code' => 0));
exit();
}
}
if ($subject === ''){
print json_encode(array('message' => 'Subject cannot be empty', 'code' => 0));
exit();
}
if ($message === ''){
print json_encode(array('message' => 'Message cannot be empty', 'code' => 0));
exit();
}
$content="From: $name \nEmail: $email \nMessage: $message";
$recipient = "youremail@here.com";
$mailheader = "From: $email \r\n";
mail($recipient, $subject, $content, $mailheader) or die("Error!");
print json_encode(array('message' => 'Email successfully sent!', 'code' => 1));
exit();

$this->view('pages/contact' , $data);

}else{
$data = [
'name'=>'',
'email'=>'',
'message'=>'',
'subject'=>''
];
$this->view('pages/contact' , $data);
}

}
}
?>