<?php 
class Paginations extends Controller{
public function __construct(){
$this->paginationModel = $this->model('Pagination');
}


public function index(){


$total_results = $this->paginationModel->countAll();


$data = [

 
 'total_results'=>$total_results,	
 
];
 private $total_pages;
 public $limit=is_int(2);
if (!isset($_GET['page'])) {
    $page = 1;
} else{
    $page = $_GET['page'];
} 
$total_pages=ceil($this->total_results / $this->limit);
 
$this->view('paginations/paginate', $data);









}
}

//$starting_limit = ($page-1)*$limit;
//$show  = "SELECT * FROM kategori ORDER BY id DESC LIMIT ?,?";

//$r = $db->prepare($show);
//$r->execute([$starting_limit, $limit]);