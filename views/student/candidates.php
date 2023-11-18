<?php
include '../../config.php';
session_start();
if ($_SESSION['id']) {
    $studentID = $_SESSION['id'];
    $stmt = $conn->prepare(' SELECT * FROM tbl_student ');
    $stmt->execute();
    $all_result = $stmt->get_result();
    $all_student = mysqli_num_rows($all_result);
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
                <h1>Welcome, <span class="fw-bold text-success"><?php echo $firstname ?></span>!</h1>
            </div>

            <section class="section dashboard">
                <form action="submit-vote.php" method="POST" class="mt-5">
                    <div class="row mb-5">
                        <h3>President</h3>
                        <?php
                        $president = 1;
                        $stmt = $conn->prepare(' SELECT 
                    tbl_candidates.id,
                    tbl_candidates.candidate_position,
                    tbl_position.position,
                    tbl_candidates.candidate_name,
                    tbl_candidates.img_name
                    FROM tbl_candidates
                    INNER JOIN tbl_position ON tbl_candidates.candidate_position = tbl_position.id
                    WHERE tbl_candidates.candidate_position = ? ');
                        $stmt->bind_param('i', $president);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            $position = $row['position'];
                            $candidate_name = $row['candidate_name'];
                            $img_name = $row['img_name'];
                            echo '
                            <img src="../../profile/' . $img_name . '" alt="Profile" width="100" />
                            <p class="ms-5">' . $candidate_name . '</p>
                        ';
                        }
                        ?>
                    </div>

                    <div class="row mb-5">
                        <h3>Vice President</h3>
                        <?php
                        $v_president = 2;
                        $stmt = $conn->prepare(' SELECT 
                    tbl_candidates.id,
                    tbl_candidates.candidate_position,
                    tbl_position.position,
                    tbl_candidates.candidate_name,
                    tbl_candidates.img_name
                    FROM tbl_candidates
                    INNER JOIN tbl_position ON tbl_candidates.candidate_position = tbl_position.id
                    WHERE tbl_candidates.candidate_position = ? ');
                        $stmt->bind_param('i', $v_president);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            $position = $row['position'];
                            $candidate_name = $row['candidate_name'];
                            $img_name = $row['img_name'];
                            echo '
                            <img src="../../profile/' . $img_name . '" alt="Profile" width="100" />
                            <p class="ms-5">' . $candidate_name . '</p>
                        ';
                        }
                        ?>
                    </div>

                    <div class="row mb-5">
                        <h3>Secretary</h3>
                        <?php
                        $secretary = 3;
                        $stmt = $conn->prepare(' SELECT 
                    tbl_candidates.id,
                    tbl_candidates.candidate_position,
                    tbl_position.position,
                    tbl_candidates.candidate_name,
                    tbl_candidates.img_name
                    FROM tbl_candidates
                    INNER JOIN tbl_position ON tbl_candidates.candidate_position = tbl_position.id
                    WHERE tbl_candidates.candidate_position = ? ');
                        $stmt->bind_param('i', $secretary);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            $position = $row['position'];
                            $candidate_name = $row['candidate_name'];
                            $img_name = $row['img_name'];
                            echo '
                            <img src="../../profile/' . $img_name . '" alt="Profile" width="100" />
                            <p class="ms-5">' . $candidate_name . '</p>
                        ';
                        }
                        ?>
                    </div>

                    <div class="row mb-5">
                        <h3>Treasurer</h3>
                        <?php
                        $treasurer = 4;
                        $stmt = $conn->prepare(' SELECT 
                    tbl_candidates.id,
                    tbl_candidates.candidate_position,
                    tbl_position.position,
                    tbl_candidates.candidate_name,
                    tbl_candidates.img_name
                    FROM tbl_candidates
                    INNER JOIN tbl_position ON tbl_candidates.candidate_position = tbl_position.id
                    WHERE tbl_candidates.candidate_position = ? ');
                        $stmt->bind_param('i', $treasurer);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            $position = $row['position'];
                            $candidate_name = $row['candidate_name'];
                            $img_name = $row['img_name'];
                            echo '
                            <img src="../../profile/' . $img_name . '" alt="Profile" width="100" />
                            <p class="ms-5">' . $candidate_name . '</p>
                        ';
                        }
                        ?>
                    </div>

                    <div class="row mb-5">
                        <h3>Auditor</h3>
                        <?php
                        $auditor = 5;
                        $stmt = $conn->prepare(' SELECT 
                    tbl_candidates.id,
                    tbl_candidates.candidate_position,
                    tbl_position.position,
                    tbl_candidates.candidate_name,
                    tbl_candidates.img_name
                    FROM tbl_candidates
                    INNER JOIN tbl_position ON tbl_candidates.candidate_position = tbl_position.id
                    WHERE tbl_candidates.candidate_position = ? ');
                        $stmt->bind_param('i', $auditor);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            $position = $row['position'];
                            $candidate_name = $row['candidate_name'];
                            $img_name = $row['img_name'];
                            echo '
                            <img src="../../profile/' . $img_name . '" alt="Profile" width="100" />
                            <p class="ms-5">' . $candidate_name . '</p>
                        ';
                        }
                        ?>
                    </div>

                    <div class="row mb-5">
                        <h3>P.I.O</h3>
                        <?php
                        $pio = 6;
                        $stmt = $conn->prepare(' SELECT 
                    tbl_candidates.id,
                    tbl_candidates.candidate_position,
                    tbl_position.position,
                    tbl_candidates.candidate_name,
                    tbl_candidates.img_name
                    FROM tbl_candidates
                    INNER JOIN tbl_position ON tbl_candidates.candidate_position = tbl_position.id
                    WHERE tbl_candidates.candidate_position = ? ');
                        $stmt->bind_param('i', $pio);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            $position = $row['position'];
                            $candidate_name = $row['candidate_name'];
                            $img_name = $row['img_name'];
                            echo '
                            <img src="../../profile/' . $img_name . '" alt="Profile" width="100" />
                            <p class="ms-5">' . $candidate_name . '</p>
                        ';
                        }
                        ?>
                    </div>

                    <div class="row mb-5">
                        <h3>Protocol Officer</h3>
                        <?php
                        $p_o = 7;
                        $stmt = $conn->prepare(' SELECT 
                    tbl_candidates.id,
                    tbl_candidates.candidate_position,
                    tbl_position.position,
                    tbl_candidates.candidate_name,
                    tbl_candidates.img_name
                    FROM tbl_candidates
                    INNER JOIN tbl_position ON tbl_candidates.candidate_position = tbl_position.id
                    WHERE tbl_candidates.candidate_position = ? ');
                        $stmt->bind_param('i', $p_o);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            $position = $row['position'];
                            $candidate_name = $row['candidate_name'];
                            $img_name = $row['img_name'];
                            echo '
                            <img src="../../profile/' . $img_name . '" alt="Profile" width="100" />
                            <p class="ms-5">' . $candidate_name . '</p>
                        ';
                        }
                        ?>
                    </div>
                </form>
            </section>

        </main>

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/js/main.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

    </body>

    </html>
<?php
} else {
    header("Location: ../../index.php");
    exit();
}
