<?php
include "../../config.php";

$user_id = $_SESSION['id'];

if (
    isset($_POST['firstname']) &&
    isset($_POST['middlename']) &&
    isset($_POST['lastname']) &&
    isset($_POST['phone_number']) &&
    isset($_POST['email'])

) {
    $firstname = htmlspecialchars($_POST['firstname']);
    $middlename = htmlspecialchars($_POST['middlename']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $phone_number = htmlspecialchars($_POST['phone_number']);
    $email = htmlspecialchars($_POST['email']);

    date_default_timezone_set('Asia/Manila');
    $updated_at = date("F j, Y | l - h:i:s a");

    $stmt = $conn->prepare("UPDATE tbl_teacher SET firstname = ?, middlename = ?, lastname = ?, phone_number = ?, email = ?, updated_at = ? WHERE id = ?");
    $stmt->bind_param('ssssssi', $firstname, $middlename, $lastname, $phone_number, $email, $updated_at, $user_id);
    $stmt->execute();
    header("Location: user-profile.php?success");
    exit();
} else {
    header("Location: user-profile.php?unknown_error");
    exit();
}
