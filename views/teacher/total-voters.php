<?php
include '../../config.php';
session_start();
if ($_SESSION['id']) {
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
        $u = 1;
        $c = 2;
        $stmt = $conn->prepare('SELECT * FROM tbl_student WHERE vote_status = ?');
        $stmt->bind_param('i', $u);
        $stmt->execute();
        $result = $stmt->get_result();
        $uncasted = mysqli_num_rows($result);
        $stmt->close();

        $stmt = $conn->prepare('SELECT * FROM tbl_student WHERE vote_status = ?');
        $stmt->bind_param('i', $c);
        $stmt->execute();
        $result = $stmt->get_result();
        $casted = mysqli_num_rows($result);
        $stmt->close();

        $stmt = $conn->prepare('SELECT * FROM tbl_student ');
        $stmt->execute();
        $result = $stmt->get_result();
        $all_student = mysqli_num_rows($result);
        $stmt->close();
        ?>

        <main id="main" class="main">

            <div class="pagetitle">
                <h1>Total Voters</h1>
            </div>

            <section class="section dashboard">
                <div class="row">
                    <div class="col-lg-12">
                        <h6 class="mt-2 fw-bold">
                            <span>
                                <a href="viewing-voters.php?id=<?php echo $c ?>">Casted Votes </a>
                            </span>
                            <?php
                                echo " - " . $casted;
                            ?>
                        </h6>
                        <h6 class="mt-2 fw-bold">
                            <span>
                                <a href="viewing-voters.php?id=<?php echo $u ?>">Uncasted Votes </a>
                            </span>
                            <?php
                                echo " - " . $uncasted;
                            ?>
                        </h6>
                        <h6 class="mt-2 fw-bold">
                            <span>
                                <a href="#">Total Voters </a>
                            </span>
                            <?php
                                echo " - " . $all_student;
                            ?>
                        </h6>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive mt-3">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Grade Level</th>
                                                <th>Section</th>
                                                <th>Voting Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $conn->prepare('SELECT 
                                            tbl_student.id,
                                            tbl_student.student_id,
                                            tbl_student.firstname,
                                            tbl_student.middlename,
                                            tbl_student.lastname,
                                            tbl_grade_level.grade_level,
                                            tbl_section.section,
                                            tbl_vote_status.vote_status
                                            FROM tbl_student
                                            INNER JOIN tbl_grade_level ON tbl_student.grade_level = tbl_grade_level.id
                                            INNER JOIN tbl_section ON tbl_student.section = tbl_section.id
                                            INNER JOIN tbl_vote_status ON tbl_student.vote_status = tbl_vote_status.id
                                            ORDER BY tbl_student.id ASC');
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<tr>
                                                        <td>' . $row['firstname'] . " " . $row['middlename'] . " " . $row['lastname'] . '</td>
                                                        <td>' . $row['grade_level'] . '</td>
                                                        <td>' . $row['section'] . '</td>
                                                        <td>' . $row['vote_status'] . '</td>
                                                    </tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
