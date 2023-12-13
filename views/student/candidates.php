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
                <h1>Welcome, <span class="fw-bold text-success"><?php echo $firstname ?></span>!</h1>
            </div>

            <section class="section dashboard mb-5"> 
            <?php
            if (isset($_GET['success'])) {
            ?>
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center justify-content-center my-3" role="alert">
                    <div>
                        <?php echo $_GET['success'], "Your vote has been submitted successfully."; ?>
                        <a href="candidates.php">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </a>
                    </div>
                </div>
            <?php
            }
            if (isset($_GET['done'])) {
            ?>
                <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center justify-content-center my-3" role="alert">
                    <div>
                        <?php echo $_GET['done'], "You have already done voting."; ?>
                        <a href="candidates.php">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </a>
                    </div>
                </div>
            <?php
            }
            ?>
                <form action="submit-vote.php" method="POST" class="mt-4">
                    <div class="row">
                        <h3 class="mb-3">President</h3>
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
                            $candidate_id = $row['id'];
                            $position = $row['position'];
                            $candidate_name = $row['candidate_name'];
                            $img_name = $row['img_name'];
                            echo '
                            <div class="col-lg-3 d-flex align-items-end mb-3">
                                <input type="radio" name="position_' . $position . '" value="' . $candidate_id . '" />
                                <img src="../../candidates-img/' . $img_name . '" alt="Profile" class="mx-2" id=" ' . $candidate_id . ' " style="width: 120px; height: 120px;" />
                                <span>' . $candidate_name . '</span>
                            </div>';
                        }
                        ?>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <h3 class="mb-3">Vice President</h3>
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
                            $candidate_id = $row['id'];
                            $position = $row['position'];
                            $candidate_name = $row['candidate_name'];
                            $img_name = $row['img_name'];
                            echo '
                            <div class="col-lg-3 d-flex align-items-end">
                                <input type="radio" name="position_' . $position . '" value="' . $candidate_id . '" />
                                <img src="../../candidates-img/' . $img_name . '" alt="Profile" class="mx-2" id=" ' . $candidate_id . ' " style="width: 120px; height: 120px;" />
                                <span>' . $candidate_name . '</span>
                            </div>';
                        }
                        ?>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <h3 class="mb-3">Secretary</h3>
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
                            $candidate_id = $row['id'];
                            $position = $row['position'];
                            $candidate_name = $row['candidate_name'];
                            $img_name = $row['img_name'];
                            echo '
                            <div class="col-lg-3 d-flex align-items-end">
                                <input type="radio" name="position_' . $position . '" value="' . $candidate_id . '" />
                                <img src="../../candidates-img/' . $img_name . '" alt="Profile" class="mx-2" id=" ' . $candidate_id . ' " style="width: 120px; height: 120px;" />
                                <span>' . $candidate_name . '</span>
                            </div>';
                        }
                        ?>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <h3 class="mb-3">Treasurer</h3>
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
                            $candidate_id = $row['id'];
                            $position = $row['position'];
                            $candidate_name = $row['candidate_name'];
                            $img_name = $row['img_name'];
                            echo '
                            <div class="col-lg-3 d-flex align-items-end">
                                <input type="radio" name="position_' . $position . '" value="' . $candidate_id . '" />
                                <img src="../../candidates-img/' . $img_name . '" alt="Profile" class="mx-2" id=" ' . $candidate_id . ' " style="width: 120px; height: 120px;" />
                                <span>' . $candidate_name . '</span>
                            </div>';
                        }
                        ?>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <h3 class="mb-3">Auditor</h3>
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
                            $candidate_id = $row['id'];
                            $position = $row['position'];
                            $candidate_name = $row['candidate_name'];
                            $img_name = $row['img_name'];
                            echo '
                            <div class="col-lg-3 d-flex align-items-end">
                                <input type="radio" name="position_' . $position . '" value="' . $candidate_id . '" />
                                <img src="../../candidates-img/' . $img_name . '" alt="Profile" class="mx-2" id=" ' . $candidate_id . ' " style="width: 120px; height: 120px;" />
                                <span>' . $candidate_name . '</span>
                            </div>';
                        }
                        ?>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <h3 class="mb-3">P.I.O</h3>
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
                            $candidate_id = $row['id'];
                            $position = $row['position'];
                            $candidate_name = $row['candidate_name'];
                            $img_name = $row['img_name'];
                            echo '
                            <div class="col-lg-3 d-flex align-items-end">
                                <input type="radio" name="position_' . $position . '" value="' . $candidate_id . '" />
                                <img src="../../candidates-img/' . $img_name . '" alt="Profile" class="mx-2" id=" ' . $candidate_id . ' " style="width: 120px; height: 120px;" />
                                <span>' . $candidate_name . '</span>
                            </div>';
                        }
                        ?>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <h3 class="mb-3">Protocol Officer</h3>
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
                            $candidate_id = $row['id'];
                            $position = $row['position'];
                            $candidate_name = $row['candidate_name'];
                            $img_name = $row['img_name'];
                            echo '
                            <div class="col-lg-3 d-flex align-items-end">
                                <input type="radio" name="position_' . $position . '" value="' . $candidate_id . '" />
                                <img src="../../candidates-img/' . $img_name . '" alt="Profile" class="mx-2" id=" ' . $candidate_id . ' " style="width: 120px; height: 120px;" />
                                <span>' . $candidate_name . '</span>
                            </div>';
                        }
                        ?>
                    </div>

                    <hr class="my-4">

                    <button class="btn btn-success">
                        Submit Vote &nbsp;<i class="bi bi-skip-forward"></i>
                    </button>
                </form>
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
