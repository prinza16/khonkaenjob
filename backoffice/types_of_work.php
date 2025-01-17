<?php include('./h.php'); ?>
<?php include('./navbar.php'); ?>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php include('./sidebarmenu.php') ?>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <label class="mt-4 fs-1 fw-bold">Types of work</label>
                <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Types of work</li>
                    </ol>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center"><label>No.</label></th>
                            <th scope="col"><label>Types of work name</label></th>
                            <th scope="col"><label>Action</label></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $query = "SELECT * FROM types_of_work ";
                    $result = mysqli_query($conn, $query);

                    if ($query) {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "
                            <tr style='vertical-align: middle;'>
                                <th class='text-center'><label>". $no ."</label></th>
                                <td><label>". $row['type_of_work_name'] ."</label></td>
                                <td>
                                    <a class='btn btn-primary' href='types_of_work_edit.php?types_of_work_id=" . $row['types_of_work_id'] . "'><i class='fa-solid fa-pen-to-square'></i></a>
                                    <a class='btn btn-danger' href='../delete.php?del=" . $row['types_of_work_id'] . "&type=types_of_work' onclick='return confirmDelete()'><i class='fa-solid fa-trash'></i></a>
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
    function confirmDelete() {
        return confirm("Are you sure you want to delete this record?");
    }
</script>
<?php include('footer.php'); ?>