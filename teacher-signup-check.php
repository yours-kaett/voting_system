<?php
include "config.php";

session_start();

if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $email = validate($_POST['email']);
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM tbl_teacher WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) > 0) {
        header("Location: teacher-signup.php?error=Username already taken.");
        exit();
    } 
    else {
        $password = md5($password);
        $img_name = "default.jpg";
        $stmt = $conn->prepare("INSERT INTO tbl_teacher (email, username, password, img_name) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $email, $username, $password, $img_name);
        $stmt->execute();
        $result = $stmt->get_result();
        header("Location: teacher-signup.php?success");
        exit();
    }
} else {
    header("Location: teacher-signup.php");
    exit();
}
