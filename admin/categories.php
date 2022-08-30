<?php
include "layouts/header.php";
$query = "select * from categories order by cat_id desc";
$result = mysqli_query($connection, $query);
insert_categories();
edit_category();
delete_categories();
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
                    <div class="row">
                        <div class="col-md-7">
                            <form action="categories.php" method="post">
                                <?php if (isset($_GET['edit'])) {
                                    $id = $_GET['edit'];
                                    $query = "select cat_title from categories where cat_id = $id";
                                    $get_query = mysqli_query($connection, $query);
                                    $get_category = mysqli_fetch_array($get_query);
                                ?>
                                    <div class="card mb-4">
                                        <div class="card-body demo-vertical-spacing demo-only-element">
                                            <input type="hidden" value="<?= $id ?>" name="cat_id">
                                            <label for="defaultFormControlInput" class="form-label">Title</label>
                                            <div class="input-group input-group-merge speech-to-text">
                                                <input type="text" class="form-control form-control-lg" name="cat_title" placeholder="Write or Say it" aria-describedby="text-to-speech-addon" value="<?= $get_category['cat_title']; ?>" required />
                                                <span class="input-group-text" id="text-to-speech-addon">
                                                    <i class="bx bx-microphone cursor-pointer text-to-speech-toggle"></i>
                                                </span>
                                                <input type="submit" class="btn btn-outline-primary" name="update" value="Edit Category">
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="card mb-4">
                                        <div class="card-body demo-vertical-spacing demo-only-element">
                                            <label for="defaultFormControlInput" class="form-label">Edit Title</label>
                                            <div class="input-group input-group-merge speech-to-text">
                                                <input type="text" class="form-control form-control-lg" name="cat_title" placeholder="Write or Say it" aria-describedby="text-to-speech-addon" required />
                                                <span class="input-group-text" id="text-to-speech-addon">
                                                    <i class="bx bx-microphone cursor-pointer text-to-speech-toggle"></i>
                                                </span>
                                                <input type="submit" class="btn btn-outline-primary" name="submit" value="Add Category">
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </form>
                        </div>
                        <div class="col-md-5">
                            <div class="card">
                                <h5 class="card-header">Categories</h5>
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-dark">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Category Title</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <?php
                                            $i = 1;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <tr>
                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $i ?></strong></td>
                                                    <td><span class="badge bg-label-primary me-1"><?= $row['cat_title'] ?></span></td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="categories.php?edit=<?= $row['cat_id'] ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                                <a class="dropdown-item" href="categories.php?delete=<?= $row['cat_id'] ?>"><i class="bx bx-trash me-1"></i> Delete</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                                $i++;
                                            } ?>
                                        </tbody>
                                    </table>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
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