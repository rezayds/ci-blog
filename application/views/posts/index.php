<h2><?= $title ?></h2>
<?php 
foreach ($posts as $post) {
    ?>
    <h3><?php echo $post['title'] ?></h3>

    <div class="row">
        <div class="col-md-3">
            <img src="<?php echo site_url();?>assets/images/posts/<?php echo $post['post_image']?>" alt="" class="post-img-thumbnail">
        </div>
        <div class="col-md-9">
            <span class="post-info">Posted on: <u><?php echo $post['created_at']; ?></u> in <u><?php echo $post['name'] ?></u></span>
            <div class="post-short-content">
                <?php echo word_limiter($post['body'], 60); ?>
            </div>
            <a href="<?php echo site_url('/posts/'.$post['slug'])?>" class="btn btn-default">Read More...</a>
        </div>
    </div>
<?php } ?>
<?php echo $this->pagination->create_links(); ?>      
    


