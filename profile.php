<?php include('h.php') ?>
<?php include('navbar.php') ?>

<?php if (isset($_SESSION['username'])) : ?>
    <div class="container-fluid py-7 px-5">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <?php include('menu_left_profile.php') ?>
            </div>
            <div class="col-lg-9 col-md-8">
                <?php include('profile_account.php') ?>
            </div>
        </div>
    </div>
<?php endif ?>

<?php include('footer.php') ?>