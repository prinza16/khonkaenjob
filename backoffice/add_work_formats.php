<?php 
    session_name('admin_session');
    session_start();
    include('../condb.php');

    $errors = array();

    if(isset($_POST['add_work_formats'])) {
        // var_dump($_POST);
        // exit;
        $work_format_name = $_POST['work_format_name'];

        if (empty($work_format_name)) {
            $errors[] = "Work formats is required.";
        }

        if (empty($errors)) {
            $query = "INSERT INTO work_formats (work_format_name) VALUES (?)";

            if ($stmt = mysqli_prepare($conn, $query)) {
                mysqli_stmt_bind_param($stmt, "s", $work_format_name);

                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['insert_work_format'] = 'เพิ่มข้อมูลเรียบร้อยแล้ว';
                    header('location: work_formats.php');
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