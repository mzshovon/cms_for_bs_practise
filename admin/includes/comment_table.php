<?php
delete_comment();
change_status();
?>
<div class="row">
    <div class="card">
        <?php include "layouts/alert.php" ?>
        <h5 class="card-header">Comments Table</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Comment Author</th>
                        <th>Comment Author Email</th>
                        <th>Post</th>
                        <th>Status</th>
                        <th>Comment Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $i ?></strong></td>
                                <td><?= $row['comment_author'] ?></td>
                                <td><small><?= $row['comment_author_email'] ?></small></td>
                                <td><i class='bx bx-file'></i> <?= $row['post_title'] ?></td>
                                <td><span class="badge bg-label-primary me-1"><?= $row['comment_status'] ?></span></td>
                                <td><span class="badge bg-label-primary me-1">
                                        <?php
                                        $date = new DateTime($row['post_date']);
                                        echo $date->format("d M,Y");
                                        ?>
                                    </span></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="comments.php?source=edit_comment&comment_id=<?= $row['comment_id'] ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="dropdown-item" href="comments.php?delete=<?= $row['comment_id'] ?>"><i class="bx bx-trash me-1"></i> Delete</a>
                                            <a class="dropdown-item" href="comments.php?change_status=<?= $row['comment_status'] == 'approved' ? 'unapproved':'approved'?>&comment_id=<?= $row['comment_id'] ?>"><i class="bx bx-<?= $row['comment_status'] == 'approved' ? 'stop-circle':'like'?> me-1"></i>
                                             <?= $row['comment_status'] == 'approved' ? 'Unapprove':'Approve'?>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                    <?php
                            $i++;
                        }
                    } ?>
                </tbody>
            </table>
            <br>
        </div>
    </div>
</div>

</html>