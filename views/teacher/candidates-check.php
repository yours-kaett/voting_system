<?php
include "../../config.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function validate($data)
    {
        return htmlspecialchars(trim($data));
    }
    $user_id = validate($_SESSION['id']);
    date_default_timezone_set('Asia/Manila');
    $created_at = date("F j, Y | l - h : i : s a");
    $img_name = "LOGO.png";
    $rowCounter = 0;
    while (isset($_POST["candidate_name_$rowCounter"]) && 
        isset($_POST["candidate_position_$rowCounter"]) &&
        isset($_POST["img_name_$rowCounter"])) {

        $candidate_name = validate($_POST["candidate_name_$rowCounter"]);
        $candidate_position = validate($_POST["candidate_position_$rowCounter"]);
        $img_name = validate($_POST["img_name_$rowCounter"]);

        $stmt = $conn->prepare("INSERT INTO tbl_candidates 
        (candidate_name, candidate_position, img_name, user_id, created_at) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('sisis', $candidate_name, $candidate_position, $img_name, $user_id, $created_at);
        $stmt->execute();

        if ($stmt->error) {
            header("Location: candidates.php?error=Error inserting data.");
            exit();
        }

        $rowCounter++;
    }

    header("Location: candidates.php?success");
    exit();
} else {
    header("Location: candidates.php?error=Unknown error occurred.");
    exit();
}
