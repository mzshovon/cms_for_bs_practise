<?php
  $query = "select * from menus";
  $result = mysqli_query($connection, $query);
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3">
      <div class="container py-1"><a class="navbar-brand text-sm fw-bold text-dark" href="index.php">CMS Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span></span><span></span><span></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
            <li class="nav-item"><a class="nav-link active " href="index.php">Home</a>
            </li>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <li class="nav-item"><a class="nav-link active " href="<?= strtolower($row['menu_title'].'.php'); ?>"><?= $row['menu_title']; ?></a>
              </li>
            <?php
            }
            ?>
            <li class="nav-item"><a class="nav-link active " href="../admin/index.php">Admin</a>
            </li>
            <li class="nav-item mt-2 mt-lg-0">
              <ul class="list-inline d-flex align-items-center">
                <li class="list-inline-item mx-lg-2 px-2 border-start border-end"><a class="search-btn nav-link small py-0 text-dark" href="#"><i class="fas fa-search"></i></a></li>
                <li class="list-inline-item d-flex align-items-end small"><a class="text-dark" href="#">EN</a><span class="underscore mb-1"></span><a class="text-gray-500" href="#">ES</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>