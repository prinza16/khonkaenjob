<?php 
    session_start();
    include('condb.php');

    $errors = array();

    if (!isset($_SESSION['user_id'])) {
        $errors[] = "You must be logged in to post a job.";
    } 

    if (isset($_POST['update'])) {
        // var_dump($_POST);
        // exit;
        $job_id = $_POST['job_id'];
        $company_name = $_POST['company_name'];
        $company_address = $_POST['company_address'];
        $company_tel = $_POST['company_tel'];
        $company_website = $_POST['company_website'];
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
        $create_date = $_POST['create_date'];
        $post_date = $_POST['post_date'];
        $expiry_date = $_POST['expiry_date'];
        $updated_at = $_POST['updated_at'];
        $job_status = $_POST['job_status'];
        $company_logo = $_FILES['company_logo'];
    
        $company_logo2 = $_POST['company_logo2'];
        $upload = $_FILES['company_logo']['name'];
    
        if ($upload != '') {
            $allow = array('jpg', 'jpeg', 'png');
            
            $extension = explode(".", $company_logo['name']);
            $fileActExt = strtolower(end($extension));
    
            $fileNew = $extension[0] . '.' . $fileActExt;
            $filePath = "profile/" . $fileNew;
    
            if (in_array($fileActExt, $allow)) {
                if ($company_logo['size'] > 0 && $company_logo['error'] == 0) {
                    move_uploaded_file($company_logo['tmp_name'], $filePath);
                } else {
                    echo "There was an error uploadimg your file.";
                }
            } else {
                echo "Invalid file type. Only JPG, JPEG, and PNG are allowed.";
            }
        } else {
            $fileNew = $company_logo2;
        }
    
        $query = "UPDATE jobs
                SET company_name = ?,
                    company_address = ?,
                    company_tel = ?,
                    company_website = ?,
                    business_type = ?,
                    job_position = ?,
                    acceptance_rate = ?,
                    work_format = ?,
                    type_of_work = ?,
                    workplace = ?,
                    salary = ?,
                    duty = ?,
                    gender = ?,
                    age = ?,
                    education = ?,
                    required_abilities = ?,
                    required_experience = ?,
                    benefit = ?,
                    tel_name = ?,
                    tel = ?,
                    email = ?,
                    company_logo = ?
                WHERE job_id = ? ";
        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, "ssssisiiisississssssssi", $company_name, $company_address, $company_tel, $company_website, $business_type, $job_position, $acceptance_rate, $work_format, $type_of_work, $workplace, $salary, $duty, $gender, $age, $education, $required_abilities, $required_experience, $benefit, $tel_name, $tel, $email, $fileNew, $job_id );
    
            if (mysqli_stmt_execute($stmt)) {
                header('Location: job_announcement_form_edit.php?job_id=' . $job_id);
                var_dump($stmt);
            } else {
                echo "Error: " . mysqli_error($conn);
            }
    
            mysqli_stmt_close($stmt);
        } else {
            echo "Error in preparing statement: " . mysqli_error($conn);
        }
    }
?>