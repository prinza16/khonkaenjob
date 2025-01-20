<?php include('./h.php'); ?>
<?php include('./navbar.php'); ?>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php include('./sidebarmenu.php') ?>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <label class="mt-4 fs-1 fw-bold">Work formats</label>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Work formats</li>
                </ol>
                <hr>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center"><label>No.</label></th>
                            <th scope="col"><label>Work formats name</label></th>
                            <th scope="col"><label>Action</label></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $limit = 10;

                        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }

                        $offset = ($page - 1) * $limit;

                        $total_query = "SELECT COUNT(*) FROM work_formats";
                        $total_result = mysqli_query($conn, $total_query);
                        $total_row = mysqli_fetch_row($total_result);
                        $total_records = $total_row[0];
                        $total_pages = ceil($total_records / $limit);

                        $query = "SELECT * FROM work_formats LIMIT $limit OFFSET $offset";
                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            $no = $offset + 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "
                            <tr style='vertical-align: middle;'>
                                <th class='text-center'><label>" . $no . "</label></th>
                                <td><label>" . $row['work_format_name'] . "</label></td>
                                <td>
                                    <a class='btn btn-primary' href='work_formats_edit.php?work_formats_id=" . $row['work_formats_id'] . "'><i class='fa-solid fa-pen-to-square'></i></a>
                                    <a class='btn btn-danger' href='../delete.php?del=" . $row['work_formats_id'] . "&type=work_formats' onclick='return confirmDelete()'><i class='fa-solid fa-trash'></i></a>
                                </td>
                            </tr>
                        ";
                                $no++;
                            }
                        } else {
                            echo "Error: " . mysqli_error($conn);
                        }

                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>

                <nav class="d-flex justify-content-between" style="align-items: start;">
                    <button class="btn btn-light fw-bold border border-dark" data-bs-toggle="modal" data-bs-target="#add_work_formats">
                        <i class="fa-solid fa-plus text-dark me-3"></i><label class="text-dark">ADD</label>
                    </button>
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                            <a class="page-link" href="?page=1"><i class="fa-solid fa-angles-left"></i></a>
                        </li>

                        <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                            <a class="page-link" href="?page=<?php echo $page - 1; ?>"><i class="fa-solid fa-chevron-left"></i></a>
                        </li>

                        <?php
                        if ($page > 3) {
                            echo "<li class='page-item'><a class='page-link' href='?page=1'>1</a></li>";
                            echo "<li class='page-item disabled'><span class='page-link'>...</span></li>";
                        }

                        $start_page = max(1, $page - 1);
                        $end_page = min($total_pages, $page + 1);

                        for ($i = $start_page; $i <= $end_page; $i++) {
                            $active = ($i == $page) ? 'active' : '';
                            echo "<li class='page-item $active'><a class='page-link' href='?page=$i'>$i</a></li>";
                        }

                        if ($page < $total_pages - 2) {
                            echo "<li class='page-item disabled'><span class='page-link'>...</span></li>";
                            echo "<li class='page-item'><a class='page-link' href='?page=$total_pages'>$total_pages</a></li>";
                        }
                        ?>

                        <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
                            <a class="page-link" href="?page=<?php echo $page + 1; ?>"><i class="fa-solid fa-chevron-right"></i></a>
                        </li>

                        <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
                            <a class="page-link" href="?page=<?php echo $total_pages; ?>"><i class="fa-solid fa-angles-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2023</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<div class="modal fade" id="add_work_formats" tabindex="-1" aria-labelledby="add_work_formats" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_work_formats">เพิ่ม Work formats name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="add_work_formats.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-1">
                            <label for="work_format_name" class="fs-5 fw-normal" style="color: #64748b;">รูปแบบงาน</label>
                            <input type="text" name="work_format_name" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button name="add_work_formats" class="btn btn-lg btn-primary me-2 fw-medium" type="submit" style="font-family: 'Kanit', sans-serif !important;">บันทึก</button>
                    <button class="btn btn-lg btn-light fw-medium" style="color: #334155;font-family: 'Kanit', sans-serif !important;" type="button" onclick="window.history.back()">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function confirmDelete() {
        return confirm("Are you sure you want to delete this record?");
    }
</script>
<?php include('footer.php'); ?>