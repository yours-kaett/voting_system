<?php
include '../../config.php';
session_start();
if ($_SESSION['id']) {
    $studentID = $_SESSION['id'];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>Online Voting System</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
        <link href="../../assets/img/logo.png" rel="icon">
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="../../assets/css/style.css" rel="stylesheet">
    </head>

    <body>
        <?php include 'header.php' ?>
        <?php include 'aside.php' ?>
        <?php
        $stmt = $conn->prepare(' SELECT * FROM tbl_student WHERE id =? ');
        $stmt->bind_param('i', $studentID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $firstname = $row['firstname'];
        ?>

        <main id="main" class="main">

            <div class="pagetitle">
                <h1>My <span class="fw-bold text-success">Candidates</span></h1>
            </div>

            <section class="section dashboard mb-5"> 
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="small">Profile</th>
                                <th class="small">Position</th>
                                <th class="small">Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stmt = $conn->prepare(' SELECT 
                            tbl_candidates.img_name,
                            tbl_votings.student_id,
                            tbl_candidates.candidate_name,
                            tbl_position.position
                            FROM tbl_votings
                            INNER JOIN tbl_candidates ON tbl_votings.candidates_id = tbl_candidates.id
                            INNER JOIN tbl_position ON tbl_candidates.candidate_position = tbl_position.id
                            WHERE tbl_votings.student_id = ? ');
                            $stmt->bind_param('i', $studentID);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while ($row = $result->fetch_assoc()) {
                                $img_name = $row['img_name'];
                                $position = $row['position'];
                                $candidate_name = $row['candidate_name'];
                                echo '
                                    <tr>
                                        <td><img src="../../candidates-img/' . $img_name . '" alt="Candidate Profile" style="width: 60px; height: 60px; border-radius: 50%;" /></td>
                                        <td class="small">' . $position . '</td>
                                        <td class="small">' . $candidate_name . '</td>
                                    </tr>
                                ';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>

        </main>

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/js/main.js"></script>

    </body>

    </html>
<?php
} else {
    header("Location: ../../index.php");
    exit();
}
