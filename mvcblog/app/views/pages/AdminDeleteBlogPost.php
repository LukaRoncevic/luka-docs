
<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="col-md-3">
<?php foreach ($data['posts'] as $post) : ?>
<li><a href="<?php echo URLROOT;?>/pages/blog/<?php echo $post->postId;?>"><?php echo $post->title;?></a></li>
 

<form  action="<?php echo URLROOT;?>/posts/deleteByAdmin/<?php echo $post->postId?>" method="post">
<input type="submit" value="Delete" class="btn btn-danger">
</form>
<?php endforeach; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>
