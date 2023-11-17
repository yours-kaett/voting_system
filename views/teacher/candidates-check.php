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
    $created_at = date("F j, Y | l - h:i:s a");

    $rowCounter = 0;
    while (
        isset($_POST["candidate_name_$rowCounter"]) &&
        isset($_POST["candidate_position_$rowCounter"]) &&
        isset($_FILES["img_name_$rowCounter"])
    ) {
        $candidate_name = validate($_POST["candidate_name_$rowCounter"]);
        $candidate_position = validate($_POST["candidate_position_$rowCounter"]);

        $img_name = $_FILES["img_name_$rowCounter"]['name'];
        $img_size = $_FILES["img_name_$rowCounter"]['size'];
        $tmp_name = $_FILES["img_name_$rowCounter"]['tmp_name'];
        $error = $_FILES["img_name_$rowCounter"]['error'];

        if ($error === 0) {
            if ($img_size > 10000000) {
                header("Location: candidates.php?invalid_size");
                exit;
            } else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $allowed_exs = array("jpg", "jpeg", "png");
                if (in_array($img_ex_lc, $allowed_exs)) {
                    $target_dir = "../../candidates-img/";
                    $img_upload_path = $target_dir . basename($img_name);
                    move_uploaded_file($tmp_name, $img_upload_path);
                    $stmt = $conn->prepare('INSERT INTO tbl_candidates (candidate_name, candidate_position, img_name, user_id, created_at) VALUES (?, ?, ?, ?, ?)');
                    $stmt->bind_param('sssis', $candidate_name, $candidate_position, $img_name, $user_id, $created_at);
                    $stmt->execute();
                    $rowCounter++;
                } else {
                    header("Location: candidates.php?invalid_format");
                    exit;
                }
            }
        } else {
            header("Location: candidates.php?file_error");
            exit;
        }
    }
    header("Location: candidates.php?success");
    exit;
} else {
    header("Location: candidates.php?unknown_error");
    exit;
}
