<?php 
  include "layouts/header.php"; 
  include "layouts/navbar.php"; 
  $query = "select * from posts";
  $result = mysqli_query($connection, $query);
?>
    <div class="search-area">
      <div class="search-area-inner d-flex align-items-center justify-content-center position-relative">
        <div class="close-btn position-absolute p-4 top-0 end-0 cursor-pointer z-index-20"><i class="fas fa-times"></i></div>
        <div class="row d-flex justify-content-center w-100">
          <div class="col-md-8">
            <form action="#">
              <div class="input-group border-bottom">
                <input class="form-control form-control-lg border-0 shadow-0 ps-0 bg-none px-0" type="search" placeholder="What are you looking for?">
                <button class="btn btn-link btn-sm shadow-0 px-0 btn-lg text-dark" type="submit"><i class="fas fa-search"></i></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <section>
      <div class="container">
        <div class="row gy-5">
          <!-- Latest Posts -->
          <main class="col-lg-8"> 
            <div class="container">
              <div class="row gy-4 mb-5">
                <?php 
                  if(isset($_POST['submit']) || isset($_GET['tags'])) {
                    $search = isset($_POST['submit']) ? $_POST['search'] : $_GET['tags'] ;
                    $query = "select * from posts where post_tags like '%$search%' order by post_date desc";
                    $result = mysqli_query($connection, $query);
                    if(mysqli_num_rows($result) == 0) {
                      echo "<h2 class='text-center text-black'>No Result Found</h2>";
                    } else {
                      while($row = mysqli_fetch_assoc($result)) {
                ?>
                  <div class="col-xl-6"><a class="mb-3" href="<?= "post.php?id=".$row['post_id']; ?>"><img class="img-fluid" src="<?= $row['post_image'] ?>" alt="..."/></a>
                    <div class="d-flex align-items-center justify-content-between mb-2"><small class="text-gray-500"><?php $date = new DateTime($row['post_date']); echo $date->format("d M,Y | h:i:s a"); ?></small><a class="small fw-bold text-uppercase small" href="!#">DEV</a></div>
                    <h3 class="h4"><a class="text-dark" href="<?= "post.php?id=".$row['post_id']; ?>"><?= $row['post_title'] ?></a></h3>
                    <p class="text-muted text-sm"><?= $row['post_content'] ?></p>
                    <ul class="list-inline list-separated text-gray-500 mb-0">
                      <li class="list-inline-item"><a class="d-flex align-items-center flex-wrap text-reset" href="!#">
                          <div class="avatar flex-shrink-0"><img class="img-fluid" src="img/avatar-3.jpg" alt="..."/></div><small><?= $row['post_author'] ?></small></a></li>
                      <li class="list-inline-item small"><i class="far fa-clock"></i> 2 months ago</li>
                      <li class="list-inline-item small"><i class="far fa-comment"></i> <?= $row['post_comment_count'] ?></li>
                    </ul>
                  </div>
                <?php
                   }}
                } else {            
                    while($row = mysqli_fetch_assoc($result)) { ?>
                    <!-- post -->
                    <div class="col-xl-6"><a class="mb-3" href="<?= "post.php?id=".$row['post_id']; ?>"><img class="img-fluid" src="<?= $row['post_image'] ?>" alt="..."/></a>
                      <div class="d-flex align-items-center justify-content-between mb-2"><small class="text-gray-500"><?php $date = new DateTime($row['post_date']); echo $date->format("d M,Y | h:i:s a"); ?></small><a class="small fw-bold text-uppercase small" href="!#">DEV</a></div>
                      <h3 class="h4"><a class="text-dark" href="<?= "post.php?id=".$row['post_id']; ?>"><?= $row['post_title'] ?></a></h3>
                      <p class="text-muted text-sm"><?= $row['post_content'] ?></p>
                      <ul class="list-inline list-separated text-gray-500 mb-0">
                        <li class="list-inline-item"><a class="d-flex align-items-center flex-wrap text-reset" href="!#">
                            <div class="avatar flex-shrink-0"><img class="img-fluid" src="img/avatar-3.jpg" alt="..."/></div><small><?= $row['post_author'] ?></small></a></li>
                        <li class="list-inline-item small"><i class="far fa-clock"></i> 2 months ago</li>
                        <li class="list-inline-item small"><i class="far fa-comment"></i> <?= $row['post_comment_count'] ?></li>
                      </ul>
                    </div>
              <?php }} ?>
              </div>
              <!-- Pagination -->
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                  <li class="page-item"><a class="page-link" href="!#"><i class="fas fa-angle-left"></i></a></li>
                  <li class="page-item active"><a class="page-link" href="!#">1</a></li>
                  <li class="page-item"><a class="page-link" href="!#">2</a></li>
                  <li class="page-item"><a class="page-link" href="!#">3</a></li>
                  <li class="page-item"><a class="page-link" href="!#"><i class="fas fa-angle-right"></i></a></li>
                </ul>
              </nav>
            </div>
          </main>
          <aside class="col-lg-4">
            <?php 
              include "layouts/search.php"; 
              include "layouts/latest.php"; 
              include "layouts/categories.php"; 
              include "layouts/tags.php"; 
            ?>
          </aside>
        </div>
      </div>
    </section>
    <!-- Page Footer-->
    <footer class="footer text-white" style="background: #0e0e0e">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h6 class="text-white">Bootstrap Blog</h6>
            <p class="fw-light mb-1">53 Broadway, Broklyn, NY 11249</p>
            <p class="fw-light mb-1">Phone: (020) 123 456 789</p>
            <p class="fw-light mb-4">Email: <a class="text-decoration-underline text-reset" href="mailto:info@company.com">Info@Company.com</a></p>
            <ul class="list-unstyled">
              <li class="list-inline-item"><a class="text-reset me-2" href="!#"><i class="fab fa-facebook-f"></i></a></li>
              <li class="list-inline-item"><a class="text-reset me-2" href="!#"><i class="fab fa-twitter"></i></a></li>
              <li class="list-inline-item"><a class="text-reset me-2" href="!#"><i class="fab fa-instagram"></i></a></li>
              <li class="list-inline-item"><a class="text-reset me-2" href="!#"><i class="fab fa-behance"></i></a></li>
              <li class="list-inline-item"><a class="text-reset me-2" href="!#"><i class="fab fa-pinterest"></i></a></li>
            </ul>
          </div>
          <div class="col-md-4">
            <div class="d-flex">
              <ul class="list-unstyled text-sm me-4">
                <li class="mb-2"><a class="text-reset fw-light" href="!#">My Account</a></li>
                <li class="mb-2"><a class="text-reset fw-light" href="!#">Add Listing</a></li>
                <li class="mb-2"><a class="text-reset fw-light" href="!#">Pricing</a></li>
                <li class="mb-2"><a class="text-reset fw-light" href="!#">Privacy &amp; Policy</a></li>
              </ul>
              <ul class="list-unstyled text-sm">
                <li class="mb-2"><a class="text-reset fw-light" href="!#">Our Partners</a></li>
                <li class="mb-2"><a class="text-reset fw-light" href="!#">FAQ</a></li>
                <li class="mb-2"><a class="text-reset fw-light" href="!#">How It Works</a></li>
                <li class="mb-2"><a class="text-reset fw-light" href="!#">Contact</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4"><a class="d-block mb-2" href="post.html">
              <div class="d-flex align-items-center"><img class="img-fluid p-1 border border-gray-600 flex-shrink-0" src="img/small-thumbnail-1.jpg" alt="..." width="50">
                <div class="ms-2 text-muted">
                  <p class="fw-bold mb-0">Hotels for all budgets</p><span>October 26, 2016</span>
                </div>
              </div></a><a class="d-block mb-2" href="post.html">
              <div class="d-flex align-items-center"><img class="img-fluid p-1 border border-gray-600 flex-shrink-0" src="img/small-thumbnail-2.jpg" alt="..." width="50">
                <div class="ms-2 text-muted">
                  <p class="fw-bold mb-0">Great street atrs in London</p><span>October 26, 2016</span>
                </div>
              </div></a><a class="d-block" href="post.html">
              <div class="d-flex align-items-center"><img class="img-fluid p-1 border border-gray-600 flex-shrink-0" src="img/small-thumbnail-3.jpg" alt="..." width="50">
                <div class="ms-2 text-muted">
                  <p class="fw-bold mb-0">Best coffee shops in Sydney</p><span>October 26, 2016</span>
                </div>
              </div></a>
          </div>
        </div>
      </div>
    </footer>
    <div class="copyrights text-white py-4" style="background: #090909">
      <div class="container">
        <div class="row text-center gy-2">
          <div class="col-md-6 text-md-start">
            <p class="mb-0 fw-light text-sm">&copy; 2022. All rights reserved. Your great site.</p>
          </div>
          <div class="col-md-6 text-md-end">
            <p class="mb-0 text-sm">Template By <a class="text-reset fw-light" href="https://bootstrapious.com/p/bootstrap-blog">Bootstrapious</a>
              <!-- Please do not remove the backlink to Bootstrap Temple unless you purchase an attribution-free license @ Bootstrap Temple or support us at http://bootstrapious.com/donate. It is part of the license conditions. Thanks for understanding :)                         -->
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/glightbox/glightbox.js"></script>
    <script src="js/theme.js"></script>
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
</html>