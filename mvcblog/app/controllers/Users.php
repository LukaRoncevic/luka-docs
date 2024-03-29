<?php

class Users extends Controller{
public function __construct(){

$this->userModel = $this->model('User');

}






public function register(){

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

$data = [

'name' => trim($_POST['name']),
'email' => trim($_POST['email']),
'password' =>trim($_POST['password']),
'confirm_password' =>trim($_POST['confirm_password']),
'role'=>trim($_POST['role']),
'name_err' =>'',
'email_err' =>'',
'password_err' =>'',
'confirm_password_err' =>'',
'role_err'=>''
];

if(empty($data['name'])){
	$data['name_err'] = 'Please enter name';
}

if(empty($data['email'])){
	$data['email_err'] = 'Please enter email';
}else{
if($this->userModel->findUserByEmail($data['email'])){
	$data['email_err'] = 'Email is already taken';
}	
}

if(empty($data['password'])){
	$data['password_err'] = 'Please enter password';
}elseif
	(strlen($data['password']) < 6){
$data['password_err'] = 'Password must be at least 6 characters long';
}

if(empty($data['confirm_password'])){
	$data['confirm_password_err'] = 'Please confirm password';
}else{
if($data['password'] != $data['confirm_password']){
	$data['confirm_password_err'] = 'Passwords do not match';
}
}
if (empty($data['role'])) {
	$data['role_err'] = 'Please select role';
}
if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['role_err']) ){
	
 $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT, array('cost'=>13));

if($this->userModel->register($data)){

redirect('users/login');

}else{
	die('Something went wrong');
}


}else{
$this->view('users/register', $data);

}


}else{

$data = [

'name' => '',
'email' => '',
'password' =>'',
'confirm_password' =>'',
'role'=>'',
'name_err' =>'',
'email_err' =>'',
'password_err' =>'',
'confirm_password_err' =>'',
'role_err'=>''

];

$this->view('users/register', $data);
	
}	
}

public function login(){

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

$data = [
'email' => trim($_POST['email']),
'password' =>trim($_POST['password']),
'role'=>trim($_POST['role']),
'email_err' =>'',
'password_err' =>'',
'role_err'=>''
];

if(empty($data['email'])){
	$data['email_err'] = 'Please enter email';
}

if(empty($data['password'])){
	$data['password_err'] = 'Please enter password';
}

if(empty($data['role'])){
	$data['role_err'] = 'Please select role';
}
if($this->userModel->findUserByEmail($data['email'])){

}else{
	$data['email_err'] = 'No user found';
}

if(empty($data['email_err']) && empty($data['password_err']) && empty($data['role_err'])){

$loggedInUser = $this->userModel->login($data['email'], $data['password'],$data['role']);

if($loggedInUser){
 
 $this->createUserSession($loggedInUser);
}else{
	$data['password_err'] = 'Password incorrect or You are not allowed to this role';
}
$this->view('users/login', $data);

}else{
$this->view('users/login', $data);

}

}else{

$data = [
	
'email' => '',
'password' =>'',
'role'=>'',
'email_err' =>'',
'password_err' =>'',
'role_err'=>''


];

$this->view('users/login', $data);
	
}	
}



public function createUserSession($user){

$_SESSION['user_id'] = $user->id;
$_SESSION['user_email'] = $user->email;
$_SESSION['user_name'] = $user->name;
$_SESSION['user_role'] = $user->role;
$_SESSION['user_password'] = $user->password;
if (isset($_SESSION['user_id']) && $_SESSION['user_role']=='admin'){
redirect('pages/dashindex');	
}else{
redirect('pages');	
}
}


public function logout(){
unset($_SESSION['user_id']);
unset($_SESSION['user_email']);
unset($_SESSION['user_name']);
unset($_SESSION['user_role']);
session_destroy();
redirect('users/login');	
}







}






?>