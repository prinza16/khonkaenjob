<?php include('./h.php'); ?>
<?php include('./navbar.php'); ?>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php include('./sidebarmenu.php') ?>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <label class="mt-4 fs-1 fw-bold">Employers</label>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Employers</li>
                </ol>
                <hr>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center"><label>No.</label></th>
                            <th scope="col"><label>Company name</label></th>
                            <th scope="col"><label>Name</label></th>
                            <th scope="col"><label>Username</label></th>
                            <th scope="col"><label>Email</label></th>
                            <th scope="col"><label>Last login</label></th>
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

                        $total_query = "SELECT COUNT(*) FROM users";
                        $total_result = mysqli_query($conn, $total_query);
                        $total_row = mysqli_fetch_row($total_result);
                        $total_records = $total_row[0];
                        $total_pages = ceil($total_records / $limit);

                        $query = "SELECT * FROM users LIMIT $limit OFFSET $offset";
                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            $no = $offset + 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "
                            <tr style='vertical-align: middle;'>
                                <th class='text-center'><label>" . $no . "</label></th>
                                <td><label>" . $row['company_name'] . "</label></td>
                                <td><label>" . $row['contact_name'] . "</label></td>
                                <td><label>" . $row['username'] . "</label></td>
                                <td><label>" . $row['email'] . "</label></td>
                                <td><label>" . $row['last_login'] . "</label></td>
                                <td>
                                    <a class='btn btn-primary' href='employers_edit.php?user_id=" . $row['user_id'] . "'><i class='fa-solid fa-pen-to-square'></i></a>
                                    <a class='btn btn-danger' href='#' onclick='return confirmDelete(" . $row['user_id'] . ")'>
                <i class='fa-solid fa-trash'></i>
            </a>
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

                <!-- Pagination -->
                <nav class="d-flex justify-content-end" style="align-items: start;">
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
<script type="text/javascript">
    function confirmDelete(user_id) {
        event.preventDefault();

        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: 'คุณต้องการลบข้อมูลนี้หรือไม่?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../delete.php?del=' + user_id + '&type=user';
            }
        });
    }
</script>
<?php include('footer.php'); ?>