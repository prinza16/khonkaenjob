<?php 
    session_name('admin_session');
    session_start();
    include('../condb.php');

    $errors = array();

    if(isset($_POST['add_job_status'])) {
        // var_dump($_POST);
        // exit;
        $jobstatus_name = $_POST['jobstatus_name'];

        if (empty($jobstatus_name)) {
            $errors[] = "Job status is required.";
        }

        if (empty($errors)) {
            $query = "INSERT INTO job_status (jobstatus_name) VALUES (?)";

            if ($stmt = mysqli_prepare($conn, $query)) {
                mysqli_stmt_bind_param($stmt, "s", $jobstatus_name);

                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['insert_employer'] = 'เพิ่มข้อมูลเรียบร้อยแล้ว';
                    header('location: job_status.php');
                    exit();
                } else {
                    echo "Error: " . mysqli_error($conn);
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "Error preparing statement: " . mysqli_error($conn);
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
        }
    }
?>