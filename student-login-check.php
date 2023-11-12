<?php
session_start();
include "config.php";
if (isset($_POST['student_id']) && isset($_POST['password'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $student_id = validate($_POST['student_id']);
    $password = validate($_POST['password']);
    $password = md5($password);
    try {
        $stmt = $conn->prepare(' SELECT * FROM tbl_student WHERE student_id = ? AND password = ? ');
        if (!$stmt) {
            throw new Exception("Database query error: " . $conn->error);
        }
        $stmt->bind_param("ss", $student_id, $password);
        if (!$stmt->execute()) {
            throw new Exception("Database query execution failed.");
        }
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if ($row['student_id'] === $student_id && $row['password'] === $password) {
                
                $_SESSION['id'] = $row['id'];
                $_SESSION['student_id'] = $row['student_id'];

                // header("Location: views/voting-area.php");
                // exit();
                echo 'Success!';
            } else {
                header("Location: student-login.php?error");
                exit();
            }
        } else {
            header("Location: student-login.php?error");
            exit();
        }
    } catch (Exception $e) {
        header("Location: student-login.php?error=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: student-login.php");
    exit();
}
