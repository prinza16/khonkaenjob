<?php
session_start();
include('condb.php');

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $fullname = $row['fullname'];
        $email = $row['email'];
        $image_profile = $row['image_profile'];
    }
}
?>

<div class="d-flex align-items-center mb-4 justify-content-center justify-content-md-start ms-4">
    <img class="rounded-circle" style="object-fit: cover;" width="100px" height="100px" src="uploads/<?php echo $image_profile; ?>">
    <div class="ms-3">
        <label class="mb-0"><a class="fs-3 nav-link fw-semibold" href="profile.php"><?php echo $_SESSION['fullname'] ?></a></label>
    </div>
</div>
<ul class="nav-list-custom">
    <li>
        <a href="profile_account.php" class="align-items-baseline">
            <i class="fa-solid fa-user fs-5 fw-bold"></i>
            <label class="fs-5 ms-2 fw-bold">Profile</label>
        </a>
    </li>
    <li>
        <a href="profile_job_poster.php" class="align-items-baseline">
            <i class="fa-solid fa-briefcase fs-5 fw-bold"></i>
            <label class="fs-5 ms-2 fw-bold">Job Poster</label>
        </a>
    </li>
</ul>