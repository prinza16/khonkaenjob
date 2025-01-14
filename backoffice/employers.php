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
                    $query = "SELECT * FROM users ";
                    $result = mysqli_query($conn, $query);

                    if ($query) {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "
                            <tr style='vertical-align: middle;'>
                                <th class='text-center'><label>". $no ."</label></th>
                                <td><label>". $row['company_name'] ."</label></td>
                                <td><label>". $row['contact_name'] ."</label></td>
                                <td><label>". $row['username'] ."</label></td>
                                <td><label>". $row['email'] ."</label></td>
                                <td><label>". $row['last_login'] ."</label></td>
                                <td>
                                    <a class='btn btn-primary' href='employers_edit.php?users_id=" . $row['user_id'] . "'><i class='fa-solid fa-pen-to-square'></i></a>
                                    <button class='btn btn-danger'><i class='fa-solid fa-trash'></i></button>
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
<?php include('footer.php'); ?>