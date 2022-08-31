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
            $_SESSION['message'] = "Successfully $param";
            $_SESSION['alert'] = "success";
            return true;
        }
    }

    // category section here
    function insert_categories()
    {
        global $connection;
        if (isset($_POST['submit'])) {
            $title = $_POST['cat_title'];
            $insert = "insert into categories(cat_title) ";
            $insert .= "value('{$title}')";
            $insert_query = mysqli_query($connection, $insert);
            if (!$insert_query) {
                die("Query failed with " . mysqli_error($connection));
            }
            header("Location:categories.php");
        }
    }
    function edit_category()
    {
        global $connection;
        if (isset($_POST['update'])) {
            $id = $_POST['cat_id'];
            $title = $_POST['cat_title'];
            $edit = "update categories set cat_title = '{$title}' where cat_id= '{$id}'";
            $edit_query = mysqli_query($connection, $edit);
            if (!$edit_query) {
                die("Query failed with " . mysqli_error($connection));
            }
            header("Location:categories.php");
        }
    }
    function delete_categories()
    {
        global $connection;
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $delete = "delete from categories where cat_id= '{$id}'";
            $delete_query = mysqli_query($connection, $delete);
            if (!$delete_query) {
                die("Query failed with " . mysqli_error($connection));
            }
            header("Location:categories.php");
        }
    }

    //post section here
    function insert_post()
    {
        if (isset($_POST['submit'])) {
            $post_title = $_POST['post_title'];
            $post_category_id = $_POST['post_category_id'];
            $post_author = $_POST['post_author'];
            $post_status = $_POST['post_status'];
            $post_tags = $_POST['post_tags'];
            $post_content = $_POST['post_content'];
            // File storing
            $post_image = $_FILES['post_image']['name'];
            $post_image_tmp = $_FILES['post_image']['tmp_name'];
            $post_view_count = 1456;
            if ($_POST['submit'] == "Publish and Add Another") {
                header("Location:posts.php?source=add_post");
            } else {
                header("Location:posts.php");
            }
            move_uploaded_file($post_image_tmp, "../assets/img/posts/$post_image");
            $post_image = 'http://localhost/cms/assets/img/posts/' . $post_image;

            $insert = "insert into posts(post_title, post_category_id, post_author, post_date, post_status, post_tags, post_image, post_content, post_view_count) ";
            $insert .= "value('{$post_title}', '{$post_category_id}' , '{$post_author}', now(), '{$post_status}', '{$post_tags}', '{$post_image}', '{$post_content}', '{$post_view_count}')";
            if (check_query($insert, "added")) {
                if ($_POST['submit'] == "Publish and Add Another") {
                    header("Location:posts.php?source=add_post");
                } else {
                    header("Location:posts.php");
                }
            } else {
                header("Location:posts.php?source=add_post");
            }
        } else {
            session_destroy();
        }
    }
    function edit_post()
    {
        if (isset($_POST['update'])) {
            $post_id = $_POST['post_id'];
            $post_title = $_POST['post_title'];
            $post_category_id = $_POST['post_category_id'];
            $post_author = $_POST['post_author'];
            $post_status = $_POST['post_status'];
            $post_tags = $_POST['post_tags'];
            $post_content = $_POST['post_content'];
            // File storing
            if($_FILES['post_image']['tmp_name']) {
                $post_image = $_FILES['post_image']['name'];
                $post_image_tmp = $_FILES['post_image']['tmp_name'];
                move_uploaded_file($post_image_tmp, "../assets/img/posts/$post_image");
                $post_image = 'http://localhost/cms/assets/img/posts/' . $post_image;    
            }
            $post_comment_count = 12;
            $post_view_count = 1456;

            $edit = "update posts set post_title = '{$post_title}'";
            $edit .= ", post_category_id = '{$post_category_id}'";
            $edit .= ", post_author = '{$post_author}'";
            $edit .= ", post_status = '{$post_status}'";
            $edit .= ", post_tags = '{$post_tags}'";
            $edit .= ", post_content = '{$post_content}'";
            if($_FILES['post_image']['tmp_name']) {
                $edit .= ", post_image = '{$post_image}'";
            }
            $edit .= ", post_comment_count = '{$post_comment_count}'";
            $edit .= ", post_view_count = '{$post_view_count}'";
            $edit .= "where post_id= '{$post_id}'";

            if (check_query($edit, "edited")) {
                header("Location:posts.php?source=edit_post&post_id=$post_id");
            } else {
                header("Location:posts.php?source=edit_post&post_id=$post_id");
            }
        } else {
            session_destroy();
        }
    }
    function delete_posts()
    {
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $delete = "delete from posts where post_id= '{$id}'";
            if (check_query($delete, "deleted")) {
                header("Location:posts.php");
            } else {
                header("Location:posts.php");
            }
        } else {
            session_destroy();
        }
    }
    //comment section here
    function insert_comment()
    {
        if (isset($_POST['submit'])) {
            $comment_author = $_POST['comment_author'];
            $comment_author_email = $_POST['comment_author_email'];
            $comment_post_id = $_POST['comment_post_id'];
            $comment_status = $_POST['comment_status'];
            $comment_content = $_POST['comment_content'];
            $insert = "insert into comments(comment_author, comment_author_email, comment_post_id, comment_status, comment_content, comment_date) ";
            $insert .= "value('{$comment_author}', '{$comment_author_email}' , '{$comment_post_id}', '{$comment_status}', '{$comment_content}', now())";
            if (check_query($insert, "added")) {
                $update_comment_count = "update posts set post_comment_count = post_comment_count +1 where post_id= '{$comment_post_id}'";
                if (check_query($update_comment_count, "comment successfully submitted!")) {
                    if ($_POST['submit'] == "Submit and Add Another") {
                        header("Location:comments.php?source=add_comment");
                    } else {
                        header("Location:comments.php");
                    }
                }
            } else {
                header("Location:comments.php?source=add_comment");
            }
        } else {
            session_destroy();
        }
    }
    function edit_comment()
    {
        if (isset($_POST['update'])) {

            $comment_id = $_POST['comment_id'];
            $comment_author = $_POST['comment_author'];
            $comment_author_email = $_POST['comment_author_email'];
            // $comment_post_id = $_POST['comment_post_id'];
            $comment_status = $_POST['comment_status'];
            $comment_content = $_POST['comment_content'];

            $edit = "update comments set comment_author = '{$comment_author}'";
            $edit .= ", comment_author_email = '{$comment_author_email}'";
            // $edit .= ", comment_post_id = '{$comment_post_id}'";
            $edit .= ", comment_status = '{$comment_status}'";
            $edit .= ", comment_content = '{$comment_content}'";
            $edit .= "where comment_id= '{$comment_id}'";

            if (check_query($edit, "edited")) {
                header("Location:comments.php?source=edit_comment&comment_id=$comment_id");
            } else {
                header("Location:comments.php?source=edit_comment&comment_id=$comment_id");
            }
        } else {
            session_destroy();
        }
    }
    function change_status()
    {
        if (isset($_GET['change_status'])) {
            $comment_id = $_GET['comment_id'];
            $comment_status = $_GET['change_status'];
            $edit = "update comments set comment_status = '{$comment_status}' where comment_id= '{$comment_id}'";
            if (check_query($edit, "changed")) {
                header("Location:comments.php");
            } else {
                header("Location:comments.php");
            }
        }
    }
    function delete_comment()
    {
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $delete = "delete from comments where comment_id = '{$id}'";
            if (check_query($delete, "deleted")) {
                header("Location:comments.php");
            } else {
                header("Location:comments.php");
            }
        } else {
            session_destroy();
        }
    }
