<?php
    // URL sanitization function
    function get_absolute_url()
    {
        $array = explode('/', $_SERVER['REQUEST_URI']);
        $get_abs_url = explode('.php', $array[count($array) - 1])[0];
        return $get_abs_url;
    }
    // error checking in query and set the value in session
    function check_query($query, $param)
    {
        global $connection;
        $response = mysqli_query($connection, $query);
        if (!$response) {
            $_SESSION['message'] = "Query error. Please see the error " . mysqli_error($connection);
            $_SESSION['alert'] = "danger";
            return false;
        } else {
            $_SESSION['message'] = $param;
            $_SESSION['alert'] = "success";
            return true;
        }
    }

    // comment section here
    function insert_comment()
    {
        if (isset($_POST['submit'])) {
            $comment_post_id = $_POST['comment_post_id'];
            $comment_author = $_POST['comment_author'];
            $comment_author_email = $_POST['comment_author_email'];
            $comment_content = $_POST['comment_content'];
            $insert = "insert into comments(comment_post_id, comment_author, comment_author_email, comment_content, comment_status, comment_date) ";
            $insert .= "value('{$comment_post_id}','{$comment_author}','{$comment_author_email}','{$comment_content}','unapproved',now())";
            if (check_query($insert, "comment successfully submitted!")) {
                $update_comment_count = "update posts set post_comment_count = post_comment_count +1 where post_id= '{$comment_post_id}'";
                if (check_query($update_comment_count, "comment submitted!")) {
                    header("Location:post.php?id=$comment_post_id");
                }
            } else {
                header("Location:post.php?id=$comment_post_id");
            }
        } else {
            session_destroy();
        }
    }