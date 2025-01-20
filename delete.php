<?php
session_start();
include('condb.php');

if (isset($_GET['del']) && isset($_GET['type'])) {
    $del_id = $_GET['del'];
    $type = $_GET['type'];

    if (is_numeric($del_id)) {
        switch ($type) {
            case 'job':
<<<<<<< HEAD
=======
                // ลบ job
>>>>>>> be90c4152549ffaeabecd300948f52670e415214
                $sql = "SELECT * FROM jobs WHERE job_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $del_id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $delete_sql = "DELETE FROM jobs WHERE job_id = ?";
                    $delete_stmt = $conn->prepare($delete_sql);
                    $delete_stmt->bind_param("i", $del_id);
                    if ($delete_stmt->execute()) {
                        echo "Job record deleted successfully";
                        header("Location: profile_job_poster.php");
                    } else {
                        echo "Error deleting job record: " . $conn->error;
                    }
                } else {
                    echo "No job found with this ID.";
                }
                break;

            case 'user':
<<<<<<< HEAD
=======
                // ลบ user
>>>>>>> be90c4152549ffaeabecd300948f52670e415214
                $sql = "SELECT * FROM users WHERE user_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $del_id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $delete_sql = "DELETE FROM users WHERE user_id = ?";
                    $delete_stmt = $conn->prepare($delete_sql);
                    $delete_stmt->bind_param("i", $del_id);
                    if ($delete_stmt->execute()) {
                        echo "User record deleted successfully";
                        header("Location: ./backoffice/employers.php");
                    } else {
                        echo "Error deleting user record: " . $conn->error;
                    }
                } else {
                    echo "No user found with this ID.";
                }
                break;

            case 'salary':
<<<<<<< HEAD
=======
                // ลบ salary
>>>>>>> be90c4152549ffaeabecd300948f52670e415214
                $sql = "SELECT * FROM salarys WHERE salary_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $del_id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $delete_sql = "DELETE FROM salarys WHERE salary_id = ?";
                    $delete_stmt = $conn->prepare($delete_sql);
                    $delete_stmt->bind_param("i", $del_id);
                    if ($delete_stmt->execute()) {
                        echo "Salary record deleted successfully";
<<<<<<< HEAD
                        header("Location: ./backoffice/salarys.php");
=======
                        header("Location: ./backoffice/salarys.php"); // เปลี่ยนเส้นทางไปยังหน้าที่เกี่ยวกับ salary
>>>>>>> be90c4152549ffaeabecd300948f52670e415214
                    } else {
                        echo "Error deleting salary record: " . $conn->error;
                    }
                } else {
                    echo "No salary found with this ID.";
                }
                break;

            case 'job_status':
<<<<<<< HEAD
=======
                // ลบ job_status
>>>>>>> be90c4152549ffaeabecd300948f52670e415214
                $sql = "SELECT * FROM job_status WHERE jobstatus_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $del_id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $delete_sql = "DELETE FROM job_status WHERE jobstatus_id = ?";
                    $delete_stmt = $conn->prepare($delete_sql);
                    $delete_stmt->bind_param("i", $del_id);
                    if ($delete_stmt->execute()) {
                        echo "Job status record deleted successfully";
<<<<<<< HEAD
                        header("Location: ./backoffice/job_status.php");
=======
                        header("Location: ./backoffice/job_status.php"); // เปลี่ยนเส้นทางไปยังหน้าที่เกี่ยวกับ job status
>>>>>>> be90c4152549ffaeabecd300948f52670e415214
                    } else {
                        echo "Error deleting job status record: " . $conn->error;
                    }
                } else {
                    echo "No job status found with this ID.";
                }
                break;

            case 'types_of_work':
<<<<<<< HEAD
=======
                // ลบ types_of_work
>>>>>>> be90c4152549ffaeabecd300948f52670e415214
                $sql = "SELECT * FROM types_of_work WHERE types_of_work_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $del_id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $delete_sql = "DELETE FROM types_of_work WHERE types_of_work_id  = ?";
                    $delete_stmt = $conn->prepare($delete_sql);
                    $delete_stmt->bind_param("i", $del_id);
                    if ($delete_stmt->execute()) {
                        echo "Types of work record deleted successfully";
<<<<<<< HEAD
                        header("Location: ./backoffice/types_of_work.php");
=======
                        header("Location: ./backoffice/types_of_work.php"); // เปลี่ยนเส้นทางไปยังหน้าที่เกี่ยวกับ types of work
>>>>>>> be90c4152549ffaeabecd300948f52670e415214
                    } else {
                        echo "Error deleting types of work record: " . $conn->error;
                    }
                } else {
                    echo "No type of work found with this ID.";
                }
                break;

            case 'work_formats':
<<<<<<< HEAD
=======
                // ลบ work_formats
>>>>>>> be90c4152549ffaeabecd300948f52670e415214
                $sql = "SELECT * FROM work_formats WHERE work_formats_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $del_id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $delete_sql = "DELETE FROM work_formats WHERE work_formats_id = ?";
                    $delete_stmt = $conn->prepare($delete_sql);
                    $delete_stmt->bind_param("i", $del_id);
                    if ($delete_stmt->execute()) {
                        echo "Work formats record deleted successfully";
<<<<<<< HEAD
                        header("Location: ./backoffice/work_formats.php");
=======
                        header("Location: ./backoffice/work_formats.php"); // เปลี่ยนเส้นทางไปยังหน้าที่เกี่ยวกับ work formats
>>>>>>> be90c4152549ffaeabecd300948f52670e415214
                    } else {
                        echo "Error deleting work formats record: " . $conn->error;
                    }
                } else {
                    echo "No work format found with this ID.";
                }
                break;

            case 'business_types':
<<<<<<< HEAD
=======
                // ลบ business_types
>>>>>>> be90c4152549ffaeabecd300948f52670e415214
                $sql = "SELECT * FROM business_types WHERE business_type_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $del_id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $delete_sql = "DELETE FROM business_types WHERE business_type_id = ?";
                    $delete_stmt = $conn->prepare($delete_sql);
                    $delete_stmt->bind_param("i", $del_id);
                    if ($delete_stmt->execute()) {
                        echo "Business type record deleted successfully";
<<<<<<< HEAD
                        header("Location: ./backoffice/business_type.php");
=======
                        header("Location: ./backoffice/business_type.php"); // เปลี่ยนเส้นทางไปยังหน้าที่เกี่ยวกับ business types
>>>>>>> be90c4152549ffaeabecd300948f52670e415214
                    } else {
                        echo "Error deleting business type record: " . $conn->error;
                    }
                } else {
                    echo "No business type found with this ID.";
                }
                break;

            default:
                echo "Invalid type for deletion.";
                break;
        }

<<<<<<< HEAD
=======
        // ปิดการเชื่อมต่อ
>>>>>>> be90c4152549ffaeabecd300948f52670e415214
        $stmt->close();
        $delete_stmt->close();
        $conn->close();

<<<<<<< HEAD
=======
        // หลังจากการลบเสร็จ ให้กลับไปหน้าเดิม
>>>>>>> be90c4152549ffaeabecd300948f52670e415214
        exit();
    } else {
        echo "Invalid ID.";
    }
}
?>