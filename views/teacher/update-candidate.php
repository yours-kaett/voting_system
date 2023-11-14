<?php
include "../../config.php";

$id = $_GET['id'];

if (
    isset($_POST['candidate_name']) &&
    isset($_POST['candidate_position']) &&
    isset($_FILES['img_name'])
) {
    $candidate_name = htmlspecialchars($_POST['candidate_name']);
    $candidate_position = htmlspecialchars($_POST['candidate_position']);

    date_default_timezone_set('Asia/Manila');
    $updated_at = date("F j, Y | l - h:i:s a");

    $img_name = $_FILES['img_name']['name'];
    $img_size = $_FILES['img_name']['size'];
    $tmp_name = $_FILES['img_name']['tmp_name'];
    $error = $_FILES['img_name']['error'];

    if ($error === 0) {
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $allowed_exs = array("jpg", "jpeg", "png");

        if (in_array(strtolower($img_ex), $allowed_exs)) {
            // Set a unique name to prevent overwriting files
            $img_new_name = uniqid('candidate_') . '.' . $img_ex;
            $img_upload_path = '../../candidates-img/' . $img_new_name;

            if ($img_size <= 10000000) { // Check file size
                if (move_uploaded_file($tmp_name, $img_upload_path)) {
                    $stmt = $conn->prepare("UPDATE tbl_candidates SET candidate_name = ?, candidate_position = ?, img_name = ?, updated_at = ? WHERE id = ?");
                    $stmt->bind_param('sssii', $candidate_name, $candidate_position, $img_new_name, $updated_at, $id);
                    $stmt->execute();
                    header("Location: edit-candidate.php?id=$id&success");
                    exit();
                } else {
                    header("Location: edit-candidate.php?id=$id&upload_error");
                    exit();
                }
            } else {
                header("Location: edit-candidate.php?id=$id&invalid_size");
                exit();
            }
        } else {
            header("Location: edit-candidate.php?id=$id&invalid_format");
            exit();
        }
    } else {
        header("Location: edit-candidate.php?id=$id&upload_error");
        exit();
    }
} else {
    header("Location: edit-candidate.php?id=$id&unknown_error");
    exit();
}
