<?php
  include "layouts/header.php";
  $query = "select * from comments 
            inner join posts on comments.comment_post_id = posts.post_id
            order by comment_id desc";
  $result = mysqli_query($connection, $query);
  ?>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
      <?php include "layouts/sidebar.php"; ?>
      <!-- / Menu -->
      <!-- Layout container -->
      <div class="layout-page">
        <?php include "layouts/navbar.php"; ?>
        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">
            <?php
            if (isset($_GET['source'])) {
              switch ($_GET['source']) {
                case 'add_comment':
                  include "includes/add_comment.php";
                  break;
                case 'edit_comment':
                  include "includes/edit_comment.php";
                  break;
                default:
                  include "includes/comment_table.php";
              }
            } else {
              include "includes/comment_table.php";
            }
            ?>
          </div>
          <!-- / Content -->
          <!-- Footer -->
          <?php include "layouts/footer.php"; ?>
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <?php include "layouts/scripts.php" ?>