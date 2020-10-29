<?php require APPROOT . '/views/inc/header.php'; ?>
<h1><?php echo $data['title'];?></h1>
<p><strong><?php echo $data['description'];?> </strong> </p>
<div class="row mb-3">
<div class="col-md-6">
<h1>Posts</h1>
</div>	
<div class="col-md-6">
<a href="<?php echo URLROOT;?>/posts/add" class="btn btn-primary pull-right">
<i class="fa fa-pencil"></i>Add Post	
</a>
</div>
</div>

<div class="row">
<div class="col-md-4">
  <?php  
  	foreach ($data['photos'] as $photo ) {
  	 	echo  '<img src="data:image/jpeg;base64,'.base64_encode ($photo->image) .'"/>';
  	 } 
  	
  
  
  

   


?>


</div>



	<!-- post loop -->
	<div class="col-md-5">
<?php foreach($data['posts'] as $post) : ?>	
	
<div class="card card-body mb-3">
<h4 class="card-title"><?php echo $post->title;?> </h4>
<div class="bg-light p-2 mb-3">
Written by<i class="fa fa-pencil"></i><?php echo $post->name;?> on <i class="fa fa-clock-o"></i> <?php echo $post->postCreated;?>
</div>
<p class="card-text"><?php echo $post->body;?></p>
		

	
<a href="<?php echo URLROOT;?>/posts/show/<?php echo $post->postId;?>" class="btn btn-dark">More</a>	
</div>

<a href="<?php echo URLROOT;?>/comments/addComments" class="btn btn-primary">Add a comment</a>


	
<a href="<?php echo URLROOT;?>/pages/displayComments" class="btn btn-primary pull-right">display comment</a>

<?php endforeach; ?>



<!-- end post loop -->
</div>
<!-- aside -->
<!-- <div class="col-md-3">
<?php //foreach ($data['posts'] as $post) : ?>
<li><a href="<?php //echo URLROOT;?>/pages/blog/<?php //echo $post->postId;?>"><?php //echo $post->title;?></a></li>
 <?php //endforeach; ?> 
	 end of aside -->
<!--</div>-->

<div class="col-md-3">
<?php foreach($data['posts'] as $post): ?>
<form method="post" action="<?php echo URLROOT;?>/uploads/upload" class="form-horizontal" enctype="multipart/form-data">
<li><a href="<?php echo URLROOT;?>/pages/blog/<?php echo $post->postId;?>"><?php echo $post->title;?></a></li>	
<div class="form-group">	
<label class="col-sm-3 control-label">Name</label>
<div class="col-sm-12">
<input type="text" name="txt_name" class="form-control form-control-lg" placeholder="Enter Name">
</div>
</div>

<div class="form-group">	
<label class="col-sm-3 control-label">File</label>
<div class="col-sm-11">
<input type="file" name="txt_file" class="form-control form-control-lg">
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-3 col-sm-9 ">
<input type="submit" name="btn_insert" class="btn btn-success" value="Insert">
<a href="blog" class="btn btn-danger pull-right">Cancel</a>
</div>

</form>


</div>
<?php endforeach; ?>
<!-- end of row -->
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>