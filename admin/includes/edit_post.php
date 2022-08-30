<?php
    include "layouts/floara_script.php";
    if(!$_GET['post_id']) {
        header("Location:error.php");
    }
    $post_id = $_GET['post_id'];
    $query = "select * from posts where post_id= $post_id";
    $result = mysqli_query($connection,$query);
    if($row = mysqli_fetch_array($result)) {
        $post = $row;
        $query_category = "select * from categories";
        $result_category = mysqli_query($connection,$query_category);
    } else {
        header("Location:error.php");
    }
    edit_post();
?>
<div class="card mb-4">
    <?php include "layouts/alert.php" ?>   
    <h5 class="card-header">Edit Post</h5>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="html5-text-input" class="col-form-label">Title</label>
                    <input class="form-control" type="hidden" name="post_id" value="<?= $post['post_id'] ?>"/>
                    <input class="form-control" type="text" name="post_title" value="<?= $post['post_title'] ?>" id="html5-text-input" placeholder="Title" required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Category</label>
                    <select class="form-select form-select-lg" name="post_category_id" id="exampleFormControlSelect1" aria-label="Default select example" required>
                        <option selected disabled>select category</option>
                        <?php 
                            while($row_category = mysqli_fetch_assoc($result_category)) {
                        ?>
                            <option value="<?= $row_category['cat_id'] ?>" <?= $row_category['cat_id'] == $post['post_category_id'] ? 'selected':'' ?>><?= $row_category['cat_title'] ?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="html5-text-input" class="col-form-label">Post Author</label>
                    <input class="form-control" type="text" name="post_author" value="<?= $post['post_author'] ?>" id="html5-text-input" placeholder="Author Name" required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Status</label>
                    <select class="form-select form-select-lg" name="post_status" id="exampleFormControlSelect1" aria-label="Default select example" required>
                        <option selected disabled>select status</option>
                        <option value="draft" <?= $post['post_status'] == "draft" ? 'selected':'' ?>>Draft</option>
                        <option value="pending for approval" <?= $post['post_status'] == "pending for approval" ? 'selected':'' ?>>Pending for approval</option>
                        <option value="reviewd" <?= $post['post_status'] == "reviewd" ? 'selected':'' ?>>Reviewd</option>
                        <option value="published" <?= $post['post_status'] == "published" ? 'selected':'' ?>>Published</option>
                        <option value="banned" <?= $post['post_status'] == "banned" ? 'selected':'' ?>>Banned</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="html5-text-input" class="col-form-label">Post Tags</label>
                    <input class="form-control" type="select" name="post_tags" value="<?= $post['post_tags'] ?>" id="html5-text-input" placeholder="Author Name" required/>
                    <div id="defaultFormControlHelp" class="form-text">
                        Use comma to separate tags ex. php, laravel, python
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="formFile" class="form-label">Upload Post Banner</label>
                    <input class="form-control form-control-lg" type="file" name="post_image" id="formFile"/>
                    <img src="<?= $post['post_image'] ?>" alt="user-avatar" class="d-block rounded" height="100" width="200" id="uploadedAvatar">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-12">
                    <label for="exampleFormControlTextarea1" class="form-label">Content</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="post_content" rows="3" required>
                        <?= $post['post_content'] ?>
                    </textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-12">
                    <input type="submit" class="btn btn-outline-secondary btn-lg" name="update" value="Update Post">
                    <!-- <input type="submit" class="btn btn-outline-secondary btn-lg" name="submit" value="Update and Add Another"> -->
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    var editor = new FroalaEditor('#exampleFormControlTextarea1');
</script>