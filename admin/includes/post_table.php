<div class="row">
    <div class="card">
        <h5 class="card-header">Posts Table</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Title</th>
                        <th>Post Author</th>
                        <!-- <th>Post Content</th> -->
                        <th>Post Image</th>
                        <th>Post Tags</th>
                        <th>Post Comments</th>
                        <th>Post Views</th>
                        <th>Status</th>
                        <th>Post Date</th>
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
                            <td><?= $row['post_title'] ?></td>
                            <td><?= $row['post_author'] ?></td>
                            <!-- <td><small><?= $row['post_content'] ?></small></td> -->
                            <td>
                                <img src="<?= $row['post_image'] ?>" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                            </td>
                            <td>
                                <?php
                                foreach (explode(',', $row['post_tags']) as $key => $value) {
                                    echo '<span class="badge rounded-pill bg-info">' . $value . '</span>';
                                }
                                ?>
                            </td>
                            <td><i class='bx bx-message-rounded-dots'></i> <?= $row['post_comment_count'] ?></td>
                            <td><i class='bx bxs-binoculars'></i> <?= $row['post_view_count'] ?></td>
                            <!-- <td>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Lilian Fuller">
                                <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                              </li>
                            </ul>
                          </td> -->
                            <td><span class="badge bg-label-primary me-1"><?= $row['post_status'] ?></span></td>
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
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
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

</html>