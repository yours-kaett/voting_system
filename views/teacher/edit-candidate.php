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
                <h1>SSLG Candidate</h1>
            </div>

            <?php
            if (isset($_GET['success'])) {
            ?>
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center justify-content-center mb-4" role="alert">
                    <div>
                        <?php echo $_GET['success'], "Candidate info has been saved successfully."; ?>
                        <a href="edit-candidate.php?id=<?php echo $_GET['id'] ?>">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </a>
                    </div>
                </div>
            <?php
            }
            if (isset($_GET['upload_error'])) {
            ?>
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center mb-4" role="alert">
                    <div>
                        <?php echo $_GET['upload_error'], "There's an error during updating. Try different image!."; ?>
                        <a href="edit-candidate.php?id=<?php echo $_GET['id'] ?>">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </a>
                    </div>
                </div>
            <?php
            }
            if (isset($_GET['invalid_size'])) {
            ?>
                <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center justify-content-center mb-4" role="alert">
                    <div>
                        <?php echo $_GET['invalid_size'], "Selected file has a large size. Try to upload 100MB below."; ?>
                        <a href="edit-candidate.php?id=<?php echo $_GET['id'] ?>">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </a>
                    </div>
                </div>
            <?php
            }
            if (isset($_GET['invalid_format'])) {
            ?>
                <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center justify-content-center mb-4" role="alert">
                    <div>
                        <?php echo $_GET['invalid_format'], "Selected file is not an image format."; ?>
                        <a href="edit-candidate.php?id=<?php echo $_GET['id'] ?>">
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
                        <?php echo $_GET['unknown_error'], "An unknown error occured."; ?>
                        <a href="edit-candidate.php?id=<?php echo $_GET['id'] ?>">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </a>
                    </div>
                </div>
            <?php
            }
            ?>

            <?php
            $stmt = $conn->prepare(' SELECT 
            tbl_candidates.id,
            tbl_candidates.candidate_name,
            tbl_candidates.candidate_position,
            tbl_position.position,
            tbl_candidates.img_name
            FROM tbl_candidates
            INNER JOIN tbl_position ON tbl_candidates.candidate_position = tbl_position.id
            WHERE tbl_candidates.id = ? ');
            $stmt->bind_param('i', $_GET['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $candidate_id = $row['id'];
            $candidate_name = $row['candidate_name'];
            $position_id = $row['candidate_position'];
            $candidate_position = $row['position'];
            $img_name = $row['img_name'];
            ?>
            <section class="section dashboard">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">
                                <form action="update-candidate.php?id=<?php echo $candidate_id ?>" method="POST" class="mt-3" enctype="multipart/form-data">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-lg-3">
                                            <label for="candidate_name">Candidate Name</label>
                                        </div>
                                        <div class="col-lg-5">
                                            <input name="candidate_name" value="<?php echo $candidate_name ?>" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row d-flex align-items-center mt-3">
                                        <div class="col-lg-3">
                                            <label for="candidate_position">Position</label>
                                        </div>
                                        <div class="col-lg-5">
                                            <select name="candidate_position" class="form-control" id="candidate_position" required>
                                                <option value="<?php echo $position_id ?>"><?php echo $candidate_position ?></option>
                                                <?php
                                                $stmt = $conn->prepare(' SELECT * FROM tbl_position ');
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                while ($row = $result->fetch_assoc()) {
                                                    $id = $row['id'];
                                                    $position  = $row['position'];
                                                    echo '
                                                        <option value="' . $id . '">' . $position . '</option>
                                                    ';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-lg-3">
                                            <label for="img_name">Candidate Photo</label>
                                        </div>
                                        <div class="col-lg-3">
                                            <img src="../../candidates-img/<?php echo $img_name ?>" width="214" class="rounded-5" id="uploadedImg" alt="Profile">
                                            <div class="pt-2">
                                                <label for="upload" class="btn btn-primary" tabindex="0">
                                                    <span class="text-white">
                                                        <i class="bi bi-upload"></i></i>&nbsp;Upload
                                                    </span>
                                                    <input name="img_name" type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
                                                </label>
                                                <a href="#" class="btn btn-danger account-image-reset">
                                                    <i class="bi bi-trash"></i>
                                                    &nbsp;Remove
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <button class="btn btn-success" type="submit">
                                            <i class="bi bi-save"></i>
                                            &nbsp; Save Changes
                                        </button>
                                    </div>
                                </form>
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
            'use strict';
            document.addEventListener('DOMContentLoaded', function(e) {
                (function() {
                    let accountUserImage = document.getElementById('uploadedImg');
                    const fileInput = document.querySelector('.account-file-input'),
                        resetFileInput = document.querySelector('.account-image-reset');
                    if (accountUserImage) {
                        const resetImage = accountUserImage.src;
                        fileInput.onchange = () => {
                            if (fileInput.files[0]) {
                                accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
                            }
                        };
                        resetFileInput.onclick = () => {
                            fileInput.value = '';
                            accountUserImage.src = resetImage;
                        };
                    }
                })();
            });
        </script>

    </body>

    </html>
<?php
} else {
    header("Location: ../../index.php");
    exit();
}
