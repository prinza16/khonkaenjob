<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ps-3" href="#">Start Bootstrap</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4 container-fluid">
        <?php
        session_start();
        if (isset($_SESSION['username'])) {
            echo "<li class='nav-item fs-6 fw-bold ms-auto' style='line-height: 40px;'>
                        <label class='text-white fw-bold'>" . $_SESSION['username'] . "</label>
                    </li>
                    <li><a class='btn btn-outline-light ms-2' href='admin_login.php?logout=true' ><h6 class='username-navber-custom my-0'>Logout</h6></a></li>
                    ";
        } else {
            header("Location: admin_login.php");
            exit();
        }
        ?>
    </ul>
</nav>
<style>
    .username-navbar-custom {
        color: #fff;
        font-weight: 600;
        font-family: "Nunito", sans-serif !important;
    }
    .username-navbar-custom :hover {
        color: #64748b;
        font-weight: 600;
    }
</style>