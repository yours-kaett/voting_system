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
        <link href="../../assets/img/LOGO.png" rel="icon">
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="../../assets/css/style.css" rel="stylesheet">
    </head>

    <body>
        <div class="d-flex align-items-center justify-content-between mb-3">
            <img src="../../assets/img/LOGO.png" alt="Logo" width="90">
            <p class="text-center"><span clas="text-success">Escalante National High School </span><br /> <span class="fw-bold">SSLG Candidates</span></p>
            <p>
                <?php 
                date_default_timezone_set('Asia/Manila');
                echo date("F j, Y");
                ?>
            </p>
        </div>
        <main>
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive mt-3">
                                    <table class="table">
                                        <col width="30%">
                                        <col width="30%">
                                        <col width="30%">
                                        <thead>
                                            <tr>
                                                <th>Profile</th>
                                                <th>Name</th>
                                                <th>Position</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $conn->prepare('SELECT 
                                            tbl_candidates.id,
                                            tbl_candidates.candidate_name,
                                            tbl_candidates.candidate_position,
                                            tbl_candidates.img_name,
                                            tbl_position.position
                                            FROM tbl_candidates
                                            INNER JOIN tbl_position ON tbl_candidates.candidate_position = tbl_position.id
                                            ORDER BY tbl_candidates.candidate_position ASC');
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while ($row = $result->fetch_assoc()) {
                                                echo '
                                                <tr>
                                                    <td><img src="../../candidates-img/' . $row['img_name'] . '" style="width: 80px; height: 80px; border-radius: 50%;" /></td>
                                                    <td>' . $row['candidate_name'] . '</td>
                                                    <td>' . $row['position'] . '</td>
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


        <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/js/main.js"></script>
        <script type="text/javascript">
            function PrintPage() {
                window.print();
            }
            window.addEventListener('DOMContentLoaded', (event) => {
                PrintPage()
                setTimeout(function() {
                    window.close()
                }, 900)
            });
        </script>

    </body>

    </html>
<?php
} else {
    header("Location: ../../index.php");
    exit();
}
