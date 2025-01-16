<?php include('./h.php'); ?>
<?php include('./navbar.php'); ?>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php include('./sidebarmenu.php') ?>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <label class="mt-4 fs-1 fw-bold">Business types</label>
                <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Business types</li>
                    </ol>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center"><label>No.</label></th>
                            <th scope="col"><label>Business types name</label></th>
                            <th scope="col"><label>Action</label></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $query = "SELECT * FROM business_types ";
                    $result = mysqli_query($conn, $query);

                    if ($query) {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "
                            <tr style='vertical-align: middle;'>
                                <th class='text-center'><label>". $no ."</label></th>
                                <td><label>". $row['business_type_name'] ."</label></td>
                                <td>
                                    <a class='btn btn-primary' href='business_type_edit.php?business_type_id=" . $row['business_type_id'] . "'><i class='fa-solid fa-pen-to-square'></i></a>
                                    <a class='btn btn-danger' href='../delete.php?del=" . $row['business_type_id'] . "&type=user' onclick='return confirmDelete()'><i class='fa-solid fa-trash'></i></a>
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