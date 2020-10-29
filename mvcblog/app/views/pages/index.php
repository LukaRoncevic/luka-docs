<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="jumbotron jumbotron-fluid text-center">
<div class="container">
<h1 class="display-3"><?php echo $data['title'];?></h1>
</div>
</div>
<div class="container-fluid">
 <img src="<?php echo URLROOT; ?>/img/osijek1.jpeg"; class="mx-auto d-block" style="width:100%">
</div>
<p class="height"><?php echo $data['body'];?></p>
<p class="lead text-center"><?php echo $data['information'];?> </p>
<?php foreach($data['posts'] as $post) : ?>
<div class="col-md-12">
<div class="card card-body mb-3">
<h4 class="card-title"><?php echo $post->title;?> </h4>
<div class="bg-light p-2 mb-3">
Written by<i class="fa fa-pencil"></i><?php echo $post->name;?> on <i class="fa fa-clock-o"></i> <?php echo $post->postCreated;?>
</div>
<p class="card-text"><?php echo $post->body;?></p>
<a href="<?php echo URLROOT;?>/posts/show/<?php echo $post->postId;?>" class="btn btn-dark">More</a>
</div>
</div>	
<?php endforeach; ?>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>