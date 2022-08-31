<?php
    include "layouts/floara_script.php";
    if(!$_GET['comment_id']) {
        header("Location:error.php");
    }
    $comment_id = $_GET['comment_id'];
    $query = "select * from comments where comment_id= $comment_id";
    $result = mysqli_query($connection,$query);
    if($row = mysqli_fetch_array($result)) {
        $comment = $row;
        $query_post= "select * from posts";
        $result_post = mysqli_query($connection, $query_post);
    } else {
        header("Location:error.php");
    }
    edit_comment();
?>
<div class="card mb-4">
    <?php include "layouts/alert.php" ?>
    <h5 class="card-header">Edit Comment</h5>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="html5-text-input" class="col-form-label">Comment Author</label>
                    <input class="form-control" type="hidden" name="comment_id" value="<?= $comment['comment_id']?>"/>
                    <input class="form-control" type="text" name="comment_author" value="<?= $comment['comment_author']?>" id="html5-text-input" placeholder="Author Name" required />
                </div>
                <div class="col-md-6">
                    <label for="html5-text-input" class="col-form-label">Comment Author Email</label>
                    <input class="form-control" type="email" name="comment_author_email" value="<?= $comment['comment_author_email']?>" id="html5-text-input" placeholder="Author Name" required />
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Post</label>
                    <select class="form-select form-select-lg" name="comment_post_id" id="exampleFormControlSelect1" aria-label="Default select example" disabled required>
                        <option selected disabled>select post</option>
                        <?php
                        while ($row_post = mysqli_fetch_assoc($result_post)) {
                        ?>
                            <option value="<?= $row_post['post_id'] ?>" <?= $row_post['post_id'] == $comment['comment_post_id'] ? 'selected':'' ?>><?= $row_post['post_title'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Status</label>
                    <select class="form-select form-select-lg" name="comment_status" id="exampleFormControlSelect1" aria-label="Default select example" required>
                        <option selected disabled>select status</option>
                        <option value="approved" <?= $comment['comment_status'] == "approved"? 'selected':'' ?>>Approve</option>
                        <option value="unapproved" <?= $comment['comment_status'] == "unapproved" ? 'selected':'' ?>>Unapprove</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-12">
                    <label for="exampleFormControlTextarea1" class="form-label">Content</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="comment_content" rows="3" required>
                        <?= $comment['comment_content']?>
                    </textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-12">
                    <input type="submit" class="btn btn-outline-secondary btn-lg" name="update" value="Edit Comment">
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    var editor = new FroalaEditor('#exampleFormControlTextarea1');
</script>