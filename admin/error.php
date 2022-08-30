<?php
include "layouts/header.php";
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
                <div class="container-xxl container-p-y">
                    <div class="misc-wrapper text-center">
                        <h2 class="mb-2 mx-2">Page Not Found :(</h2>
                        <p class="mb-4 mx-2">Oops! 😖 The requested URL was not found on this server.</p>
                        <a href="index.php" class="btn btn-primary">Back to home</a>
                        <div class="mt-3">
                            <img src="../assets/img/illustrations/page-misc-error-light.png" alt="page-misc-error-light" width="500" class="img-fluid" data-app-dark-img="illustrations/page-misc-error-dark.png" data-app-light-img="illustrations/page-misc-error-light.png" />
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