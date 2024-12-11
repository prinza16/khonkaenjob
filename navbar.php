<?php
include('h.php');
?>
<nav class="navbar navbar-expand-lg px-5" style="box-shadow: 0 .125rem .25rem rgba(2,6,23,.075);padding: .5rem;background: #ffffff;">
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
                    echo '<li class="nav-item d-flex align-items-center p-1 btn btn-light me-2">
                              <img src="https://plus.unsplash.com/premium_photo-1664541336692-e931d407ba88?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Profile Picture" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px;">
                              <a class="nav-link text-black fw-semibold" href="profile.php">Profile</a>
                            </li>
                            <li class="nav-item btn btn-light">
                                <a class="nav-link fw-semibold" href="index.php?logout=true"><span>Logout</span></a>   
                            </li>
                            ';
                    // if (isset($_SESSION['profile_picture'])) {
                    //     echo '<li class="nav-item">
                    //             <img src="' . $_SESSION['profile_picture'] . '" alt="Profile Picture" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px;">
                    //           </li>';
                    // }
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