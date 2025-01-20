<?php 
    session_name('admin_session');
    session_start();
    include('../condb.php');

    $errors = array();

    if(isset($_POST['add_salary_data'])) {
        // var_dump($_POST);
        // exit;
        $salary_data = $_POST['salary_data'];

        if (empty($salary_data)) {
            $errors[] = "Salary data is required.";
        }

        if (empty($errors)) {
            $query = "INSERT INTO salarys (salary_data) VALUES (?)";

            if ($stmt = mysqli_prepare($conn, $query)) {
                mysqli_stmt_bind_param($stmt, "s", $salary_data);

                if (mysqli_stmt_execute($stmt)) {
                    header('location: salarys.php');
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
