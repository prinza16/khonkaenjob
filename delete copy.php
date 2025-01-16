<?php
session_start();
include('condb.php');

if (isset($_GET['del'])) {
    $job_id = $_GET['del'];

    $sql = "SELECT * FROM jobs WHERE job_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $job_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $delete_sql = "DELETE FROM jobs WHERE job_id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $job_id);
        if ($delete_stmt->execute()) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "No job found with this ID.";
    }

    $stmt->close();
    $delete_stmt->close();
    $conn->close();

    header("Location: profile_job_poster.php");
    exit();
}
?>
