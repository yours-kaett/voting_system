<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Voting System</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />
    <link href="assets/img/LOGO.png" rel="icon" />
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
    <main>
        <div class="container starters">
            <section class="section min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex align-items-center flex-column">
                                <div>
                                    <a href="index.php" class="logo d-flex align-items-center w-auto">
                                        <img src="assets/img/LOGO.png" alt="">
                                    </a>
                                </div>
                                <div class="mt-3 text-center">
                                    <h5 class="h5-main"><strong>Escalante National Highschool <br /> SSG Voting System</strong></h5>
                                </div>
                            </div>
                            <hr class="w-100">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title text-center fs-2">S I G N U P<br>(teacher)</h5>
                                    <!-- success & error -->
                                    <?php
                                    if (isset($_GET['success'])) {
                                    ?>
                                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center justify-content-center" role="alert">
                                            <div>
                                                <?php echo $_GET['success'], "Account created successfully."; ?>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    if (isset($_GET['error'])) {
                                    ?>
                                        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center" role="alert">
                                            <div>
                                                <?php echo $_GET['error']; ?>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <form action="teacher-signup-check.php" method="post" class="row g-3 needs-validation" novalidate>
                                        <div class="col-12 mb-3">
                                            <label for="email">Email</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">
                                                    <i class="bi bi-at"></i>
                                                </span>
                                                <input type="email" name="email" class="form-control" id="email" required />
                                                <span class="invalid-feedback position-absolute" style="font-size: 13px; margin-top: 35px;">Empty email.</span>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="username">Username</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">
                                                    <i class="bi bi-hash"></i>
                                                </span>
                                                <input type="text" name="username" class="form-control" id="username" required />
                                                <span class="invalid-feedback position-absolute" style="font-size: 13px; margin-top: 35px;">Empty username.</span>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label for="password">Password</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">
                                                    <i class="bi bi-lock"></i>
                                                </span>
                                                <input type="password" name="password" class="form-control" id="password" required />
                                                <span class="invalid-feedback position-absolute" style="font-size: 13px; margin-top: 35px;">Empty password.</span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn w-100 mt-2" id="loaderButton">
                                                <span id="submitBlank">
                                                    <span id="submit">Submit &nbsp;<i class="bi bi-arrow-return-right"></i></span>
                                                </span>
                                            </button>
                                        </div>
                                        <a href="teacher-login.php" class="small">
                                            <i class="bi bi-arrow-left"></i>&nbsp; Back
                                        </a>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </section>
        </div>
    </main>
    <!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
</body>

</html>