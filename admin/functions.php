<?php


function get_absolute_url()
{
    $array = explode('/', $_SERVER['REQUEST_URI']);
    $get_abs_url = explode('.php', $array[count($array) - 1])[0];
    return $get_abs_url;
}


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
