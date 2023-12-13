<?php
session_start();
include "config.php";
if (isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $password = md5($password);
    try {
        $stmt = $conn->prepare(' SELECT * FROM tbl_teacher WHERE username = ? AND password = ? ');
        if (!$stmt) {
            throw new Exception("Database query error: " . $conn->error);
        }
        $stmt->bind_param("ss", $username, $password);
        if (!$stmt->execute()) {
            throw new Exception("Database query execution failed.");
        }
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if ($row['username'] === $username && $row['password'] === $password) {
                
                $_SESSION['id'] = $row['id'];
                // $_SESSION['username'] = $row['username'];

                header("Location: views/teacher/dashboard.php");
                exit();
            } else {
                header("Location: teacher-login.php?error");
                exit();
            }
        } else {
            header("Location: teacher-login.php?error");
            exit();
        }
    } catch (Exception $e) {
        header("Location: teacher-login.php?error=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: teacher-login.php");
    exit();
}
