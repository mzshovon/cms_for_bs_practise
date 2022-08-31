<?php 
  include "layouts/header.php"; 
  include "layouts/navbar.php"; 
  include "includes/functions.php"; 
  insert_comment();
  $post_id = $_GET['id'];
  $query ="select * from posts where post_id = $post_id";
  $result = mysqli_query($connection, $query);
  $row = mysqli_fetch_array($result);
  $fetch_query ="select * from comments where comment_status='approved' and comment_post_id = $post_id order by comment_date desc";
  $fetch_result = mysqli_query($connection, $fetch_query);

?>
    <section class="py-5">
      <div class="container">
        <div class="row gy-5">
          <?php include "layouts/alert.php"; ?>
          <!-- Latest Posts -->
          <main class="col-lg-8"> 
            <div class="container"><img class="img-fluid w-100 mb-4" src="<?= $row['post_image'] ?>" alt="...">
              <ul class="list-inline mb-3">
                <li class="list-inline-item"><a class="text-uppercase" href="">Business</a></li>
                <li class="list-inline-item"><a class="text-uppercase" href="">Technology</a></li>
              </ul>
              <h1 class="mb-4"><?= $row['post_title'] ?><a href=""><i class="fa fa-bookmark-o"></i></a></h1>
              <ul class="list-inline list-separated text-gray-500 mb-5">
                <li class="list-inline-item"><a class="d-flex align-items-center flex-wrap text-reset" href="!#">
                    <div class="avatar flex-shrink-0"><img class="img-fluid" src="img/avatar-1.jpg" alt="..."></div><small><?= $row['post_author'] ?></small></a></li>
                <li class="list-inline-item small"><i class="far fa-clock"></i>
                <?php $date = new DateTime($row['post_date']); echo $date->format("d M,Y"); ?>
              </li>
                <li class="list-inline-item small"><i class="far fa-comment"></i> <?= $row['post_comment_count'] ?></li>
              </ul>
              <div class="post-body">
                <?= $row['post_content'] ?>
              </div>
              <ul class="list-inline mb-5 mt-4">
                <?php foreach (explode(',',$row['post_tags']) as $key => $value) {
                ?>
                  <li class="list-inline-item"><a class="tag" href="blog.php?tags=<?= $value ?>"><?= $value ?></a></li>
                <?php 
                } ?>
              </ul>
              <div class="posts-nav d-flex justify-content-between align-items-stretch flex-column flex-md-row mb-5"><a class="prev-post text-start d-flex align-items-center" href="!#">
                  <div class="icon prev"><i class="fas fa-angle-left"></i></div>
                  <div class="text"><strong class="text-primary">Previous Post </strong>
                    <h6>I Bought a Wedding Dress.</h6>
                  </div></a><a class="next-post text-end d-flex align-items-center justify-content-end" href="!#">
                  <div class="text"><strong class="text-primary">Next Post </strong>
                    <h6>I Bought a Wedding Dress.</h6>
                  </div>
                  <div class="icon next"><i class="fas fa-angle-right">   </i></div></a></div>
              <div class="mb-5">
                <header>
                  <h3 class="h6 mb-4">Post Comments<span class="fw-light text-gray-600 small ms-2">(<?= mysqli_num_rows($fetch_result) ?>)</span></h3>
                </header>
                <?php 
                  while ($fetch_row = mysqli_fetch_assoc($fetch_result)) {
                ?>
                <div class="d-flex align-items-start"><img class="img-fluid rounded-circle flex-shrink-0" src="img/user.svg" alt="Jabi Hernandiz" width="50"/>
                  <div class="pb-4 ms-3 border-bottom mb-4"><strong><?= $fetch_row['comment_author'] ?></strong>
                    <p class="small text-gray-500"><?php $date = new DateTime($fetch_row['comment_date']); echo $date->format("d M, Y"); ?></p>
                    <p class="mb-0 text-sm"><?= $fetch_row['comment_content'] ?></p>
                  </div>
                </div>
              <?php  }?>
              <div class="mb-5">
                <header>
                  <h3 class="h6 mb-4">Leave a reply</h3>
                </header>
                <form action="" method="post">
                  <div class="row gy-3">
                    <div class="col-md-6">
                      <div class="border-bottom">
                        <input class="form-control px-0 border-0 shadow-0" type="hidden" name="comment_post_id" value="<?= $post_id ?>">
                        <input class="form-control px-0 border-0 shadow-0" type="text" name="comment_author" id="username" placeholder="Name">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="border-bottom">
                        <input class="form-control px-0 border-0 shadow-0" type="email" name="comment_author_email" id="useremail" placeholder="Email Address (will not be published)">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="border-bottom">
                        <textarea class="form-control px-0 border-0 shadow-0" rows="5" name="comment_content" id="usercomment" placeholder="Type your comment"></textarea>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <input class="btn btn-secondary" type="submit" name="submit" value="Submit Comment">
                    </div>
                  </div>
                </form>
              </div>
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
<?php 
  include "layouts/footer.php"; 
  include "layouts/scripts.php"; 
?>