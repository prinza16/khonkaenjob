<?php 
    session_name('admin_session');
    session_start();
    include('../condb.php');

    $errors = array();

    if(isset($_POST['add_business_type'])) {
        // var_dump($_POST);
        // exit;
        $business_type_name = $_POST['business_type_name'];

        if (empty($business_type_name)) {
            $errors[] = "Business type name is required.";
        }

        if (empty($errors)) {
            $query = "INSERT INTO business_types (business_type_name) VALUES (?)";

            if ($stmt = mysqli_prepare($conn, $query)) {
                mysqli_stmt_bind_param($stmt, "s", $business_type_name);

                if (mysqli_stmt_execute($stmt)) {
                    header('location: business_type.php');
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
