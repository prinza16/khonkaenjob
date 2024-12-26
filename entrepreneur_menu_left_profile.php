<?php
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
            $fullname = $row['fullname'];
            $email = $row['email'];
            $image_profile = $row['image_profile'];
        }
    }

    mysqli_stmt_close($stmt);

}

$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="d-flex align-items-center mb-4 justify-content-center justify-content-md-start ms-4">
    <img class="rounded-circle" style="object-fit: cover;" width="100px" height="100px" src="profile/<?php echo $image_profile; ?>">
    <div class="ms-3">
        <label class="mb-0"><a class="fs-3 nav-link fw-semibold" href="profile.php"><?php echo $_SESSION['fullname'] ?></a></label>
    </div>
</div>
<ul class="nav-list-custom">
    <li class="<?php echo ($current_page == 'entrepreneur_profile_account.php') ? 'active_linkprofile' : ''; ?>">
        <a href="entrepreneur_profile_account.php" class="py-3">
            <i class="fa-solid fa-user fs-5 fw-bold"></i>
            <h5 class="ms-2 fw-bold my-0">Profile</h5>
        </a>
    </li>
    <li class="my-2 <?php echo in_array($current_page, ['entrepreneur_profile_job_poster.php', 'entrepreneur_job_announcement_form_edit.php']) ? 'active_linkprofile' : ''; ?>">
        <a href="entrepreneur_profile_job_poster.php" class="py-3">
            <i class="fa-solid fa-briefcase fs-5 fw-bold"></i>
            <h5 class="ms-2 fw-bold my-0">Job Poster</h5>
        </a>
    </li>
</ul>

<style>
    .nav-list-custom li.active_linkprofile a {
        background-color: #007bff;
        color: white;
    }
</style>