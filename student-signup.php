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
                                <img src="assets/img/LOGO.png" alt="Logo" width="80">
                                <div class="mt-3 text-center">
                                    <h5 class="h5-main"><strong>Escalante National Highschool <br /> SSG Voting System</strong></h5>
                                </div>
                            </div>
                            <hr class="w-100">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title text-center fs-2">S I G N U P</h5>
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
                                    <form action="student-signup-check.php" method="post" class="row g-3">
                                        <div class="col-lg-12">
                                            <label for="email">Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroupPrepend">
                                                    <i class="bi bi-at"></i>
                                                </span>
                                                <input type="email" name="email" class="form-control" id="email" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="gender">Gender</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroupPrepend">
                                                    <i class="bi bi-gender-ambiguous"></i>
                                                </span>
                                                <select name="gender" class="form-select" id="gender">
                                                    <option disabled selected>-select-</option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                    <option value="3">LGBTQIA+</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="student_id">LRN</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroupPrepend">
                                                    <i class="bi bi-hash"></i>
                                                </span>
                                                <input type="text" name="student_id" class="form-control" id="student_id" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="password">Password</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroupPrepend">
                                                    <i class="bi bi-lock"></i>
                                                </span>
                                                <input type="password" name="password" class="form-control" id="password" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn-starter w-100 mt-2 p-3" id="loaderButton">
                                                <span id="submitBlank">
                                                    <span id="submit">Submit</span>
                                                </span>
                                            </button>
                                        </div>
                                        <p>Has already an account? <a href="student-login.php">Login here.</a></p>
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