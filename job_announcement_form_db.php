<?php 
    session_start();
    include('condb.php');

    $errors = array();

    if (!isset($_SESSION['user_id'])) {
        $errors[] = "You must be logged in to post a job.";
    } 

    if (isset($_POST['hiring'])) {
        $company_name = $_POST['company_name'];
        $business_type = $_POST['business_type'];
        $job_position = $_POST['job_position'];
        $acceptance_rate = $_POST['acceptance_rate'];
        $work_format = $_POST['work_format'];
        $type_of_work = $_POST['type_of_work'];
        $workplace = $_POST['workplace'];
        $salary = $_POST['salary'];
        $duty = $_POST['duty'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $education = $_POST['education'];
        $required_abilities = $_POST['required_abilities'];
        $required_experience = $_POST['required_experience'];
        $benefit = $_POST['benefit'];
        $tel_name = $_POST['tel_name'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $company_address = $_POST['company_address'];
        $company_tel = $_POST['company_tel'];
        $company_website = $_POST['company_website'];
        $logo_company = $_POST['logo_company'];

        if (isset($_FILES['logo_company']) && $_FILES['logo_company']['error'] === UPLOAD_ERR_OK) {
            $logo_temp_name = $_FILES['logo_company']['tmp_name'];
            $logo_name = $_FILES['logo_company']['name'];
            $logo_size = $_FILES['logo_company']['size'];
            $logo_type = $_FILES['logo_company']['type'];

            $target_dir = "uploads/";
            $target_file = $target_dir . basename($logo_name);

            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowed_types = array("jpg", "jpeg", "png", "gif");

            if (in_array($imageFileType, $allowed_types)) {
                if (move_uploaded_file($logo_temp_name, $target_file)) {
                    $logo_company = basename($logo_name);
                } else {
                    $errors[] = "Sorry, there was an error uploading your file.";
                }
            } else {
                $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
        } else {
            $errors[] = "No file was uploaded or there was an error.";
        }

        if (empty($errors)) {
            $query = "INSERT INTO Jobs (user_id, company_name, business_type, job_position, acceptance_rate, work_format, type_of_work, workplace, salary, duty, gender, age, education, required_abilities, required_experience, benefit, tel_name, tel, email, company_address, company_tel, company_website, company_logo) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            if ($stmt = mysqli_prepare($conn, $query)) {
                mysqli_stmt_bind_param($stmt, "isisiiisississsssssssss", 
                    $_SESSION['user_id'], $company_name, $business_type, $job_position, $acceptance_rate, 
                    $work_format, $type_of_work, $workplace, $salary, $duty, $gender, $age, $education, 
                    $required_abilities, $required_experience, $benefit, $tel_name, $tel, $email, 
                    $company_address, $company_tel, $company_website, $logo_company);

                if (mysqli_stmt_execute($stmt)) {
                    header('location: index.php');
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
