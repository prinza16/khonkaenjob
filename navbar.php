<?php
session_name('user_session');
session_start();
include('h.php');
include('condb.php');

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM users WHERE user_id = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $contact_name = $row['contact_name'];
            $email = $row['email'];
        } else {
            echo "No user found.";
        }
    }

    mysqli_stmt_close($stmt);
}
?>
<nav class="navbar navbar-expand-lg px-1" style="box-shadow: 0 .125rem .25rem rgba(2,6,23,.075);padding: .5rem;background: #ffffff;">
    <div class="container-fluid">
        <a class="navbar-brand text-black" href="index.php"><label style="cursor: pointer;">khonkaen Job</label></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item btn-custom-navbar-menu">
                    <?php
                    $activeClass = (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : '';
                    ?>
                    <a class="nav-link <?php echo $activeClass; ?> text-custom-navbar-menu fs-6 fw-bold" aria-current="page" href="index.php"><label style="cursor:pointer;">Home</label></a>
                </li>
            </ul>

            <?php
            if (isset($_SESSION['username'])) {
                echo '
                    <div class="mt-3 mt-lg-0 d-flex align-items-center">
            <span class="d-inline-flex align-items-center btn-custom-profile me-1" style="min-height: 40px;">
                <a class="nav-link fw-semibold" href="profile_account.php" style="color:#64748b"><label style="cursor: pointer;">' . $contact_name . '</label></a>
            </span>
            <span class="d-inline-flex align-items-center btn-custom-profile" style="min-height: 40px;">
                <a class="nav-link fw-semibold" href="index.php?logout=true" style="color:#64748b;"><label style="cursor: pointer;">Logout</label></a>
            </span>
        </div>
                    ';
            } else {
                echo '
                    <div class="mt-3 mt-lg-0 d-flex align-items-center">
                <span class="col-6">
                    <a href="login.php" class="btn btn-light container fs-6 fw-bold" style="color:#64748b">Login</a>
                </span>
                <span class="col-6">
                    <a href="register.php" class="btn btn-primary container ms-2 fs-6 fw-bold">Register</a>
                </span>
            </div>
                    ';
            }
            ?>
        </div>
    </div>
</nav>

<style>
    @media screen and (min-width: 992px) {
        .btn-custom-profile {
            margin: 0;
            font-size: 1rem;
            text-align: center;
            cursor: pointer;
            border-radius: 0.25rem;
            transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
            background-color: #f8f9fa;
            color: #495057;
            border-color: #ced4da;
            justify-content: center;
            display: inline-flex;
            align-items: center;
            padding-right: 10px;
            padding-left: 10px;
        }

        .btn-custom-profile:hover {
            background-color: #e2e6ea;
            border-color: #adb5bd;
            text-decoration: none;
        }
    }

    @media screen and (max-width: 991px) {
        .btn-custom-profile {
            margin: 0;
            font-size: 1rem;
            text-align: center;
            cursor: pointer;
            border-radius: 0.25rem;
            transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
            background-color: #f8f9fa;
            color: #495057;
            border-color: #ced4da;
            justify-content: center;
            width: 50%;
        }

        .btn-custom-profile:hover {
            background-color: #e2e6ea;
            border-color: #adb5bd;
            text-decoration: none;
        }
    }
</style>
