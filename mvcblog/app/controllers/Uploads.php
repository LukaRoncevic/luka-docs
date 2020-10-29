<?php

class Uploads extends Controller{
public function __construct(){
$this->uploadModel = $this->model('Upload');

}

public function upload(){

if($_SERVER['REQUEST_METHOD'] == 'POST'){

if (isset($_REQUEST['btn_insert'])) {
 
$data = [
 'name'=>$_REQUEST['txt_name'],	
 'image' =>$_FILES["txt_file"] ["name"],
 'user_id' =>$_SESSION['user_id'],
 'type' =>$_FILES["txt_file"] ["type"],
 'size' =>$_FILES["txt_file"] ["size"],
 'temp' =>addslashes(file_get_contents($_FILES["txt_file"] ["tmp_name"])),
 'name_err'=>'',
 'image_err'=>''
];	
$path = '../public/upload/' . $data['image'];
}
}
if(empty($data['name'])){
	$data['name_err'] = 'Please enter name';
}
if(empty($data['image'])){
	$data['image_err'] = 'Please select image';
}




if(empty($data['name_err']) && empty($data['image_err'])){

if($this->uploadModel->uploadPhoto($data) ){
move_uploaded_file($data['temp'], '../public/upload/' . $data['image']);
redirect('pages/blog');
}else{
	die("Something went wrong");
}

}else{

$this->view('uploads/display', $data);

}




}
}
?>