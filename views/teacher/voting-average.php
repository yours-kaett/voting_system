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

        <main id="main" class="main">

            <div class="pagetitle">
                <h1>Voting Average</h1>
            </div>
            <section class="section dashboard">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                $stmt = $conn->prepare('SELECT 
                                tbl_candidates.candidate_name,
                                tbl_position.position,
                                tbl_candidates.candidate_position,
                                tbl_candidates.votes
                                FROM tbl_candidates 
                                INNER JOIN tbl_position ON tbl_candidates.candidate_position = tbl_position.id
                                GROUP BY tbl_candidates.candidate_position');
                                $stmt->execute();
                                $candidates_result = $stmt->get_result();
                                while ($candidates_row = $candidates_result->fetch_assoc()) {
                                    echo '<div class="table-responsive mt-4">';
                                    echo '<table class="table table-bordered">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th scope="col">' . $candidates_row['position'] . '</th>';
                                    echo '<th scope="col">Votes</th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';

                                    $candidate_position = $candidates_row['candidate_position'];
                                    $stmt2 = $conn->prepare('SELECT * FROM tbl_candidates WHERE candidate_position = ?');
                                    $stmt2->bind_param('i', $candidate_position);
                                    $stmt2->execute();
                                    $name_result = $stmt2->get_result();

                                    $maxVotes = 0;
                                    $maxVotesCandidate = '';

                                    while ($name_row = $name_result->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . $name_row['candidate_name'] . '</td>';
                                        echo '<td>' . $name_row['votes'] . '</td>';
                                        echo '</tr>';

                                        // Update maxVotes and maxVotesCandidate if needed
                                        if ($name_row['votes'] > $maxVotes) {
                                            $maxVotes = $name_row['votes'];
                                            $maxVotesCandidate = $name_row['candidate_name'];
                                        }
                                    }

                                    echo '</tbody>';
                                    echo '</table>';
                                    echo '</div>';
                                    echo '<div class="mb-3">Highest Votes: <span class="text-success fw-bold">' . $maxVotesCandidate . ' (' . $maxVotes . ' votes)</span></div>';
                                    echo '<hr>';
                                }
                                ?>
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
