<?php
include('h.php');
?>
<nav class="navbar navbar-expand-lg navbar-white" style="box-shadow: 0 .125rem .25rem rgba(2,6,23,.075);padding: .5rem;">
    <div class="container-fluid">
        <a class="navbar-brand text-black" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item btn-custom-navbar-menu">
                    <?php
                    $activeClass = (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : '';
                    ?>
                    <a class="nav-link <?php echo $activeClass; ?> text-custom-navbar-menu fs-6 fw-bold" style="color: #64748b;" aria-current="page" href="index.php">Home</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <?php
                if (isset($_SESSION['username'])) {
                    echo '<li class="nav-item">
                                <a class="nav-link text-black fw-semibold" href="profile.php">Welcome, ' . $_SESSION['fullname'] . '</a>
                              </li>';
                    // if (isset($_SESSION['profile_picture'])) {
                    //     echo '<li class="nav-item">
                    //             <img src="' . $_SESSION['profile_picture'] . '" alt="Profile Picture" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px;">
                    //           </li>';
                    // }
                    echo '<li class="nav-item">
                                <a class="nav-link text-white btn-custom-logout-navbar fw-semibold" href="index.php?logout=true">Logout</a>
                              </li>';
                } else {
                    echo '
                            <li class="nav-item">
                                <a class="nav-link btn-custom-login-navbar fs-6 fw-bold me-3 px-3" href="login.php">Login</a>
                            </li>
                        ';
                    echo '
                            <li class="nav-item">
                                <a class="nav-link btn-custom-register-navbar fs-6 fw-bold px-3" href="register.php">Register</a>
                            </li>
                        ';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>