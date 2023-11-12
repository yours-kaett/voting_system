<?php
include "config.php";

// require 'src/PHPMailer.php';
// require 'src/SMTP.php';
// require 'src/Exception.php';

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

session_start();

if (isset($_POST['email'])&& isset($_POST['gender']) && isset($_POST['student_id']) && isset($_POST['password'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $email = validate($_POST['email']);
    $gender = validate($_POST['gender']);
    $student_id = validate($_POST['student_id']);
    $password = validate($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM tbl_student WHERE student_id = ?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) > 0) {
        header("Location: student-signup.php?error=LRN already taken.");
        exit();
    } 
    else {
        // $mail = new PHPMailer(true);
        // try {
        //     // SMTP configuration
        //     $mail->isSMTP();
        //     $mail->Host = 'smtp.gmail.com';
        //     $mail->SMTPAuth = true;
        //     $mail->Username = 'christianschool.main@gmail.com';
        //     $mail->Password = 'lhkvevgaglyugygu';
        //     $mail->SMTPSecure = 'tls';
        //     $mail->Port = 587;

        //     // Email content
        //     date_default_timezone_set('Asia/Manila');
        //     $datetime = date("F j, Y - l")." | ".date("h : i : s a");
        //     $recipient = 'kentanthony2022@gmail.com';
        //     $subject = 'Account Creation';
        //     $message = "New Account has been added to the system on $datetime. \n \n";
        //     $message .= "Email: " . $email . "\n";
        //     $message .= "Student ID: " . $student_id . "\n";
        //     $message .= "Password: " . $password . "\n \n";
        //     $message .= "Note: Make sure to save the credentials for future purposes.";
        //     $mail->setFrom('christianschool.main@gmail.com', 'Dreamers');
        //     $mail->addAddress($recipient);
        //     $mail->Subject = $subject;
        //     $mail->Body = $message;

        //     $mail->send();
        // }
        // catch (Exception $e) {
        //     echo 'Email could not be sent. Error: ', $mail->ErrorInfo;
        // }

        $password = md5($password);
        $vote_status = 1;
        $img_name = "default.jpg";
        $stmt = $conn->prepare("INSERT INTO tbl_student (email, student_id, password, vote_status, gender, img_name) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssiis', $email, $student_id, $password, $vote_status, $gender, $img_name);
        $stmt->execute();
        $result = $stmt->get_result();
        header("Location: student-signup.php?success");
        exit();
    }
} else {
    header("Location: student-signup.php?error=Unknown error occured.");
    exit();
}
