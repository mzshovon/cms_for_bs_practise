<?php
    if (isset($_SESSION['message'])) {
        echo '<div class="col-md-12"><div class="alert alert-' . $_SESSION['alert'] . ' alert-dismissible" role="alert">
                    ' . $_SESSION['message'] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div></div>';
    }
?>