<h2><?= $title ?></h2>
<?php
    echo $this->session->flashdata('pesan');
    $valerror = validation_errors();
    if (!empty($valerror)) {
        echo '<div class=\'alert alert-danger\'>'.$valerror.'</div>';
    }
?>

<?php echo form_open_multipart('posts/update/'.$post['slug'].'/'.$post['post_image']); ?>
    <input type="hidden" name="id" value="<?php echo $post['id']?>">
    <div class="form-group">
        <label>Title</label>
        <input type="text" class="form-control" placeholder="Add title" name="title" value="<?php echo $post['title']?>" required="">
    </div>
    <div class="form-group">
        <label>Body</label>
        <textarea class="form-control" placeholder="Add body" name="body" id="textarea-post" required><?php echo $post['body'] ?></textarea>
    </div>
    <div class="form-group">
        <label>Categories</label>
        <select class="form-control" name="category_id">
            <?php
            foreach ($categories as $category) {
                ?>
                <option value="<?php echo $category['id'] ?>" <?php if($category['id'] == $post['category_id']){echo "selected";} ?>><?php echo $category['name'] ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Upload Image</label>
        <input type="file" name="gambar" size="20">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
