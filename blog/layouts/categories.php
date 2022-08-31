<?php
  $query = "select * from categories order by cat_id desc limit 6";
  $result = mysqli_query($connection, $query);
?>
<!-- Widget [Categories Widget]-->
<div class="card mb-5">
    <div class="card-body">
    <h3 class="h6 mb-3">Categories</h3>
    <?php
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="p-2 d-flex justify-content-between fw-bold text-gray-600 bg-light"><a class="text-reset" href=""><?= $row['cat_title']; ?></a></div>
        </li>
    <?php
    }?>
    </div>
</div>