
<?php require APPROOT . '/views/inc/header.php' ?>
<a href="<?php echo URLROOT;?>/pages/blog" class="btn btn-block"><i class="fa fa-backward"></i>Back</a>
<div class="card card-body bg-light mt-5">

<h2>Add Comment</h2>
<p>Create a comment with this form</p>
<form action="<?php echo URLROOT;?>/comments/addComments" method="post"> 

<div class="form-group">
<label for="title">Title: <sup>*</sup></label>
<input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ?
'is-invalid' : '';?>" value = "<?php echo $data['title']; ?>">
<span class="invalid-feedback"><?php echo $data['title_err'];?></span>
</div>

<div class="form-group">
<label for="body">Body:<sup>*</sup></label>
<textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ?
'is-invalid' : '';?>"><?php echo $data['body']; ?></textarea>
<span class="invalid-feedback"><?php echo $data['body_err'];?></span>
</div>
<input type="submit" class="btn btn-success" value="Submit">
</form>

</div>



<?php require APPROOT . '/views/inc/footer.php' ?>