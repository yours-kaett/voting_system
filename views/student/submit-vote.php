<?php
include '../../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id'])) {
    $studentID = $_SESSION['id'];
    $vote_status = 2; //DONE

    $stmt_check_voted = $conn->prepare('SELECT id, vote_status FROM tbl_student WHERE id = ? AND vote_status = ?');
    $stmt_check_voted->bind_param('ii', $studentID, $vote_status);
    $stmt_check_voted->execute();
    $result = $stmt_check_voted->get_result();
    if ($result->num_rows > 0) {
        header("Location: candidates.php?done");
        exit();
    }
    $stmt_check_voted->close();

    $votes = [];
    foreach ($_POST as $position => $candidateID) {
        $stmt_update_votes = $conn->prepare('UPDATE tbl_candidates SET votes = votes + 1 WHERE id = ?');
        $stmt_update_votes->bind_param('i', $candidateID);
        $stmt_update_votes->execute();
        $stmt_update_votes->close();

        date_default_timezone_set('Asia/Manila');
        $created_at = date("F j, Y | l - h : i : s a");
        $stmt_insert_votes = $conn->prepare('INSERT INTO tbl_votings 
            (student_id, candidates_id, created_at) VALUES (?, ?, ?)');
            $stmt_insert_votes->bind_param('iis', $studentID, $candidateID, $created_at);
            $stmt_insert_votes->execute();
            $stmt_insert_votes->close();
    }

    $stmt = $conn->prepare('UPDATE tbl_student SET vote_status = ? WHERE id = ?');
    $stmt->bind_param('ii', $vote_status, $studentID);
    $stmt->execute();
    $stmt->close();

    header("Location: candidates.php?success");
    exit();
} else {
    header("Location: ../../index.php");
    exit();
}
?>
