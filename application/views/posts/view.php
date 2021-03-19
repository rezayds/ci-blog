<h2><?php echo $post['title'] ?></h2>
<span class="post-info">Posted on: <u><?php echo $post['created_at']; ?></u> in <u><?php echo $post['name'] ?></u></span>
<div class="text-center">
	<img src="<?php echo site_url();?>assets/images/posts/<?php echo $post['post_image']?>" alt="" class="post-img-detail center-block">
</div>
<div class="post-body">
	<?php echo $post['body']; ?>
</div>

<hr>

<?php
if ($id_user == $id_login) {
	?>
	<a href="<?php echo base_url();?>posts/edit/<?php echo $post['slug']?>" class="btn btn-default pull-left" style="margin-right:20px">Edit</a>
	<?php echo form_open('/posts/delete/'.$post['slug'].'/'.$post['post_image']) ?>
    <input type="submit" name="" value="Delete" class="btn btn-danger">
	<?php
}

?>

</form>

<hr>

<h3>Comments : </h3>
<?php
if ($comments) {
	foreach ($comments as $comment) {
		?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h5 class="panel-title"><?php echo $comment['name']; ?></h5>
				<small><?php echo $comment['email'] ?></small>
			</div>
			<div class="panel-body">
				<div class="comment-content">
					<?php echo $comment['body']; ?>
				</div>				
			</div>
		</div>

		<?php
	}
}else{
	echo "<p>No Comments to Display</p>";
}
?>

<hr>

<h3>Add Comment</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('comments/create/'.$post['id']); ?>
	<div class="form-group">
		<label>Name</label>
		<input type="text" name="name" class="form-control">
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email" class="form-control">
	</div>
	<div class="form-group">
		<label>Body</label>
		<textarea name="body" class="form-control"></textarea>
	</div>
	<input type="hidden" name="slug" value="<?php echo $post['slug']; ?>">
	<button type="submit" class="btn btn-primary">Submit</button>
</form>
