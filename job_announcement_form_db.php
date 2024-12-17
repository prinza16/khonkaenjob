<?php 
    session_start();
    include('condb.php');

    $errors = array();

    if (!isset($_SESSION['user_id'])) {
        $errors[] = "You must be logged in to post a job.";
    } 

    if (isset($_POST['hiring'])) {
        $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
        $business_type = mysqli_real_escape_string($conn, $_POST['business_type']);
        $job_position = mysqli_real_escape_string($conn, $_POST['job_position']);
        $acceptance_rate = mysqli_real_escape_string($conn, $_POST['acceptance_rate']);
        $work_format = mysqli_real_escape_string($conn, $_POST['work_format']);
        $type_of_work = mysqli_real_escape_string($conn, $_POST['type_of_work']);
        $workplace = mysqli_real_escape_string($conn, $_POST['workplace']);
        $salary = mysqli_real_escape_string($conn, $_POST['salary']);
        $duty = mysqli_real_escape_string($conn, $_POST['duty']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $age = mysqli_real_escape_string($conn, $_POST['age']);
        $education = mysqli_real_escape_string($conn, $_POST['education']);
        $required_abilities = mysqli_real_escape_string($conn, $_POST['required_abilities']);
        $required_experience = mysqli_real_escape_string($conn, $_POST['required_experience']);
        $benefit = mysqli_real_escape_string($conn, $_POST['benefit']);
        $tel_name = mysqli_real_escape_string($conn, $_POST['tel_name']);
        $tel = mysqli_real_escape_string($conn, $_POST['tel']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $company_address = mysqli_real_escape_string($conn, $_POST['company_address']);
        $company_tel = mysqli_real_escape_string($conn, $_POST['company_tel']);
        $company_website = mysqli_real_escape_string($conn, $_POST['company_website']);
        $logo_company = mysqli_real_escape_string($conn, $_POST['logo_company']);

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
                    $logo_company = $target_file;
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
                      VALUES (".$_SESSION['user_id'].",'$company_name', '$business_type', '$job_position', '$acceptance_rate', '$work_format', '$type_of_work', '$workplace', '$salary', '$duty', '$gender', '$age', '$education', '$required_abilities', '$required_experience', '$benefit', '$tel_name', '$tel', '$email', '$company_address', '$company_tel', '$company_website', '$logo_company')";
            
            if (mysqli_query($conn, $query)) {
                header('location: index.php');
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
        }
    }
?>
