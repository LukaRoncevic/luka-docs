<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT;?>/pages/blog" class="btn btn-light"><i class="fa fa-backward"></i>Back</a>
<br>
<?php foreach($data['comments'] as $comment) : ?>
	
<a href="<?php echo URLROOT;?>/pages/blog"></a>
<h1><?php echo $comment->title;?></h1>
<div class="bg-secondary text-white p-2 mb-3">
Written by  <?php echo $comment->userName;?> on <?php echo $comment->created_at;?>
<p><?php echo $comment->body;?></p>

<?php endforeach; ?>

</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>