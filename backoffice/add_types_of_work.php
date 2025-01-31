<?php 
    session_name('admin_session');
    session_start();
    include('../condb.php');

    $errors = array();

    if(isset($_POST['add_types_of_work'])) {
        // var_dump($_POST);
        // exit;
        $type_of_work_name = $_POST['type_of_work_name'];

        if (empty($type_of_work_name)) {
            $errors[] = "Types 0f work is required.";
        }

        if (empty($errors)) {
            $query = "INSERT INTO types_of_work (type_of_work_name) VALUES (?)";

            if ($stmt = mysqli_prepare($conn, $query)) {
                mysqli_stmt_bind_param($stmt, "s", $type_of_work_name);

                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['insert_types_of_work'] = 'เพิ่มข้อมูลเรียบร้อยแล้ว';
                    header('location: types_of_work.php');
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
