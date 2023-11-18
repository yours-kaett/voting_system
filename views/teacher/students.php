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
                <h1>Students Masterlist</h1>
            </div>

            <?php
            if (isset($_GET['exist'])) {
            ?>
                <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center justify-content-center mb-4" role="alert">
                    <div>
                        <?php echo $_GET['exist'], "You have inputted an existing Student ID. Please try again!"; ?>
                        <a href="students.php">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </a>
                    </div>
                </div>
            <?php
            }
            if (isset($_GET['unknown_error'])) {
            ?>
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center mb-4" role="alert">
                    <div>
                        <?php echo $_GET['unknown_error'], "Unknown error occured."; ?>
                        <a href="students.php">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </a>
                    </div>
                </div>
            <?php
            }
            if (isset($_GET['success'])) {
            ?>
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center justify-content-center mb-4" role="alert">
                    <div>
                        <?php echo $_GET['success'], "Candidate(s) has been saved successfully."; ?>
                        <a href="students.php">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </a>
                    </div>
                </div>
            <?php
            }
            if (isset($_GET['error'])) {
            ?>
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center mb-4" role="alert">
                    <div>
                        <?php echo $_GET['error'], "Unknown error occured."; ?>
                        <a href="students.php">
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
                                <form action="add-student-check.php" method="POST">
                                    <div id="rows-container"></div>
                                    <div class="d-flex align-items-center justify-content-start mt-3">
                                        <button class="btn btn-primary" id="addRow" type="button">
                                            <i class="bi bi-plus-lg"></i>&nbsp; Add New Student
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
                                                <th>Student ID</th>
                                                <th>Name</th>
                                                <th>Grade Level</th>
                                                <th>Section</th>
                                                <th>Voting Status</th>
                                                <th></th>
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
                                                        <td class="text-center">
                                                            <a href="">
                                                                <button class="btn btn-primary">
                                                                    <i class="bi bi-pencil-square"></i>                                                               </button>
                                                            </a>
                                                            <a href="">
                                                                <button class="btn btn-danger">
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
                                <input type="email" name="email_${rowCounter}" id="email" placeholder="Email" class="form-control" id="email" required>
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                            <div class="form-floating">
                                <input type="text" name="student_id_${rowCounter}" id="student_id" placeholder="Student ID" class="form-control" id="student_id" required>
                                <label for="student_id">Student ID</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                            <div class="form-floating">
                                <input type="password" name="password_${rowCounter}" id="password" placeholder="Student ID" class="form-control" id="password" required>
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                            <div class="form-floating">
                                <select name="gender_${rowCounter}" id="gender" placeholder="Gender" class="form-select" id="gender" required>
                                <option selected disabled>-select-</option>
                                <?php
                                $stmt = $conn->prepare(' SELECT * FROM tbl_gender ');
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while ($row = $result->fetch_assoc()) {
                                    $id = $row['id'];
                                    $gender = $row['gender'];
                                    echo '
                                        <option value=' . $id . '>' . $gender . '</option>
                                    ';
                                }
                                ?>
                                </select>
                                <label for="gender">Gender</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                            <div class="form-floating">
                                <select name="grade_level_${rowCounter}" id="grade_level" placeholder="grade_level" class="form-select" id="grade_level" required>
                                <option selected disabled>-select-</option>
                                <?php
                                $stmt = $conn->prepare(' SELECT * FROM tbl_grade_level ');
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while ($row = $result->fetch_assoc()) {
                                    $id = $row['id'];
                                    $grade_level = $row['grade_level'];
                                    echo '
                                        <option value=' . $id . '>' . $grade_level . '</option>
                                    ';
                                }
                                ?>
                                </select>
                                <label for="grade_level">Grade Level</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                            <div class="form-floating">
                                <select name="section_${rowCounter}" id="section" placeholder="section" class="form-select" id="section" required>
                                <option selected disabled>-select-</option>
                                <?php
                                $stmt = $conn->prepare(' SELECT * FROM tbl_section ');
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while ($row = $result->fetch_assoc()) {
                                    $id = $row['id'];
                                    $section = $row['section'];
                                    echo '
                                        <option value=' . $id . '>' . $section . '</option>
                                    ';
                                }
                                ?>
                                </select>
                                <label for="section">Section</label>
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
