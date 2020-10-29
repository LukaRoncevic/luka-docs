<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
<div class="col-md-6 mx-auto">
<div class="card card-body bg-light mt-5">	
<?php
if($_SESSION['user_role'] =='guest' ){
	die('You are NOT allowed to add Photos if your role is GUEST!To ADD a photo register as USER');
}
?>
<?php redirect('pages/blog') ?>
</div>
</div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>