<?php
include "../../config.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function validate($data)
    {
        return htmlspecialchars(trim($data));
    }
    // $user_id = validate($_SESSION['id']);
    $firstname = "no-firstname";
    $middlename = "no-middlename";
    $lastname = "no-lastname";
    date_default_timezone_set('Asia/Manila');
    $created_at = date("F j, Y | l - h : i : s a");
    $img_name = "LOGO.png";
    $rowCounter = 0;
    while (
        isset($_POST["email_$rowCounter"]) &&
        isset($_POST["student_id_$rowCounter"]) &&
        isset($_POST["password_$rowCounter"]) &&
        isset($_POST["gender_$rowCounter"])
    ) {

        $email = validate($_POST["email_$rowCounter"]);
        $student_id = validate($_POST["student_id_$rowCounter"]);
        $password = validate($_POST["password_$rowCounter"]);
        $gender = validate($_POST["gender_$rowCounter"]);
        $grade_level = validate($_POST["grade_level_$rowCounter"]);
        $section = validate($_POST["section_$rowCounter"]);

        $stmt = $conn->prepare("INSERT INTO tbl_student 
        (firstname, middlename, lastname, email, student_id, password, gender, grade_level, section, img_name, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssssiiiss', $firstname, $middlename, $lastname, $email, $student_id, $password, $gender, $grade_level, $section, $img_name, $created_at);
        $stmt->execute();

        // if ($stmt->error) {
        //     header("Location: students.php?error=Error inserting data.");
        //     exit();
        // }

        $rowCounter++;
        header("Location: students.php?success");
        exit();
    }
} else {
    header("Location: students.php?unknown_error");
    exit();
}
