<?php
include '../../config.php';
session_start();
if ($_SESSION['username']) {
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
                <h1>SSLG Candidates</h1>
            </div>

            <?php
            if (isset($_GET['success'])) {
            ?>
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center justify-content-center mb-4" role="alert">
                    <div>
                        <?php echo $_GET['success'], "Candidate(s) has been saved successfully."; ?>
                        <a href="candidates.php">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </a>
                    </div>
                </div>
            <?php
            }
            ?>

            <section class="section dashboard">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="candidates-check.php" method="POST">
                                    <div id="rows-container"></div>
                                    <div class="d-flex align-items-center justify-content-start mt-3">
                                        <button class="btn btn-primary" id="addRow" type="button">
                                            <i class="bi bi-plus-lg"></i>&nbsp; Add Candidates
                                        </button>&nbsp;
                                        <button class="btn btn-success" type="submit">
                                            Save &nbsp;<i class="bi bi-save"></i>
                                        </button>
                                    </div>
                                </form>
                                <div class="table-responsive mt-3">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $conn->prepare('SELECT 
                                            tbl_candidates.id,
                                            tbl_candidates.candidate_name,
                                            tbl_candidates.candidate_position,
                                            tbl_position.position
                                            FROM tbl_candidates
                                            INNER JOIN tbl_position ON tbl_candidates.candidate_position = tbl_position.id
                                            ORDER BY tbl_candidates.candidate_position ASC');
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<tr>
                                                    <td>' . $row['candidate_name'] . '</td>
                                                    <td>' . $row['position'] . '</td>
                                                    <td>
                                                        <a href="edit-candidate.php?id=' . $row['id'] . '">
                                                            <button class="btn btn-outline-success btn-sm">
                                                                <i class="bi bi-pencil-square"></i>
                                                            </button>
                                                        </a>
                                                        <a href="delete-candidate.php?id=' . $row['id'] . '">
                                                            <button class="btn btn-outline-danger btn-sm">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </a>
                                                    </td>
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
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const addRowButton = document.getElementById("addRow");
                const rowsContainer = document.getElementById("rows-container");
                let rowCounter = 0;
                let itemNumber = 1;
                addRowButton.addEventListener("click", function() {
                    const newRow = document.createElement("div");
                    newRow.classList.add("row");
                    newRow.innerHTML = `
                        <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                            <div class="form-floating">
                                <input type="text" name="candidate_name_${rowCounter}" id="candidate_name" placeholder="Candidate Name" class="form-control" id="candidate_name" required>
                                <label for="candidate_name">Candidate Name</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                            <div class="form-floating">
                                <select name="candidate_position_${rowCounter}" id="candidate_position" placeholder="Candidate Position" class="form-select" id="candidate_position" required>
                                <?php
                                $stmt = $conn->prepare(' SELECT * FROM tbl_position ');
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while ($row = $result->fetch_assoc()) {
                                    $id = $row['id'];
                                    $postion = $row['position'];
                                    echo '
                                        <option value=' . $id . '>' . $postion . '</option>
                                    ';
                                }
                                ?>
                                </select>
                                <label for="candidate_position">Candidate Position</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 mt-2 mb-2">
                            <div class="form-floating">
                                <input type="file" name="img_name_${rowCounter}" id="img_name" placeholder="Image" class="form-control" id="img_name" >
                                <label for="img_name">Image</label>
                            </div>
                        </div>
                        <hr class="mt-2 mb-0">
                    `;
                    rowsContainer.appendChild(newRow);
                    rowCounter++;
                });
            });
        </script>

    </body>

    </html>
<?php
} else {
    header("Location: ../../index.php");
    exit();
}
