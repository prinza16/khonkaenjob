<?php
session_name('user_session');
session_start();
include('condb.php');

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM users WHERE user_id = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $contact_name = $row['contact_name'];
            $email = $row['email'];
        }
    }

    mysqli_stmt_close($stmt);
}

$current_page = basename($_SERVER['PHP_SELF']);
?>


<div class="d-flex align-items-center mb-4 justify-content-center justify-content-md-start">
    <div class="ms-3">
        <label class="mb-0"><a class="fs-3 nav-link fw-semibold"><?php echo $_SESSION['contact_name'] ?></a></label>
    </div>
</div>

<div class="mb-4 text-center text-md-start">
</div>
<div class="d-md-none text-center d-grid">
    <button class="btn btn-white mb-3 d-flex align-items-center justify-content-between " type="button"
        data-bs-toggle="collapse" data-bs-target="#collapseAccountMenu" aria-expanded="false"
        aria-controls="collapseAccountMenu">
        <label>Account Menu</label>
        <i class="fa-solid fa-chevron-down ms-2"></i>
    </button>
</div>
<div class="collapse d-md-block" id="collapseAccountMenu">
    <ul class="nav-list-custom">
        <li class="<?php echo ($current_page == 'profile_account.php') ? 'active_linkprofile' : ''; ?>">
            <a href="profile_account.php" class="py-3">
                <i class="fa-solid fa-user fs-6 fw-bold"></i>
                <h6 class="ms-2 fw-bold my-0">Profile</h6>
            </a>
        </li>
        <li class="my-2 <?php echo in_array($current_page, ['profile_job_poster.php', 'job_announcement_form_edit.php']) ? 'active_linkprofile' : ''; ?>">
            <a href="profile_job_poster.php" class="py-3">
                <i class="fa-solid fa-briefcase fs-6 fw-bold"></i>
                <h6 class="ms-2 fw-bold my-0">Job Poster</h6>
            </a>
        </li>
    </ul>
</div>

<style>
    .nav-list-custom li.active_linkprofile a {
        background-color: #007bff;
        color: white;
    }

    .btn-white {
        background-color: #ffffff;
        color: #64748b;
        border: 1px solid #adadad;
    }

    .btn-white:hover {
        background-color: #ffffff;
        color: #64748b;
        border: 1px solid #adadad;
    }
</style>