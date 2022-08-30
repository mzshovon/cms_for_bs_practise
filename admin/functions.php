    <?php

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
            $delete = "update categories set cat_title = '{$title}' where cat_id= '{$id}'";
            $delete_query = mysqli_query($connection, $delete);
            if (!$delete_query) {
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

            $post_comment_count = 12;
            $post_view_count = 1456;
            if ($_POST['submit'] == "Publish and Add Another") {
                header("Location:posts.php?source=add_post");
            } else {
                header("Location:posts.php");
            }
            move_uploaded_file($post_image_tmp, "../assets/img/posts/$post_image");
            $post_image = 'http://localhost/cms/assets/img/posts/' . $post_image;

            $insert = "insert into posts(post_title, post_category_id, post_author, post_date, post_status, post_tags, post_image, post_content, post_comment_count, post_view_count) ";
            $insert .= "value('{$post_title}', '{$post_category_id}' , '{$post_author}', now(), '{$post_status}', '{$post_tags}', '{$post_image}', '{$post_content}', '{$post_comment_count}', '{$post_view_count}')";
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
    function delete_posts()
    {
        global $connection;
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
