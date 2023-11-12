<?php
include "../../config.php";
session_start();
$stmt = $conn->prepare(' DELETE FROM tbl_candidates WHERE id = ? ');
$stmt->bind_param('i', $_GET['id']);
$stmt->execute();
header('Location: candidates.php');
exit();
?>