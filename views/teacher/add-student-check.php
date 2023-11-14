<?php
include "../../config.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function validate($data)
    {
        return htmlspecialchars(trim($data));
    }

    $user_id = validate($_SESSION['id']);
    $vote_status = 1;
    $img_name = 'default.jpg';
    $firstname = 'no_firstname';
    $middlename = 'no_middlename';
    $lastname = 'no_lastname';
    date_default_timezone_set('Asia/Manila');
    $created_at = date("F j, Y | l - h:i:s a");

    $rowCounter = 0;
    while (
        isset($_POST["email_$rowCounter"]) &&
        isset($_POST["student_id_$rowCounter"]) &&
        isset($_POST["password_$rowCounter"]) &&
        isset($_POST["gender_$rowCounter"]) &&
        isset($_POST["grade_level_$rowCounter"]) &&
        isset($_POST["section_$rowCounter"])
    ) {
        $email = validate($_POST["email_$rowCounter"]);
        $student_id = validate($_POST["student_id_$rowCounter"]);
        $password = validate($_POST["password_$rowCounter"]);
        $gender = validate($_POST["gender_$rowCounter"]);
        $grade_level = validate($_POST["grade_level_$rowCounter"]);
        $section = validate($_POST["section_$rowCounter"]);

        $password = md5($password);

        $stmt = $conn->prepare(" SELECT student_id FROM tbl_student WHERE student_id = ?");
        $stmt->bind_param('s', $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if (mysqli_num_rows($result) > 0) {
            header("Location: students.php?exist");
            exit();
        } else {
            $stmt = $conn->prepare('INSERT INTO tbl_student (email, student_id, password, vote_status, gender, img_name, firstname, middlename, lastname, grade_level, section, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $stmt->bind_param('sssiissssiis', $email, $student_id, $password, $vote_status, $gender, $img_name, $firstname, $middlename, $lastname, $grade_level, $section, $created_at);
            $stmt->execute();
            header("Location: students.php?success");
            $rowCounter++;
        }
    }
} else {
    header("Location: students.php?unknown_error");
    exit;
}
