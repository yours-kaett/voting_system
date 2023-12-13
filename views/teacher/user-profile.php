<?php
include '../../config.php';
session_start();
if ($_SESSION['id']) {
  $user_id = $_SESSION['id'];
  $stmt = $conn->prepare(' SELECT * FROM tbl_teacher WHERE id = ?');
  $stmt->bind_param('i', $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $firstname = $row['firstname'];
  $middlename = $row['middlename'];
  $lastname = $row['lastname'];
  $phone_number = $row['phone_number'];
  $email = $row['email'];
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Online Voting System</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="../../assets/img/favicon.png" rel="icon">
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
        <h1>Profile</h1>
      </div>

      <?php
      if (isset($_GET['unknown_error'])) {
      ?>
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center mb-4" role="alert">
          <div>
            <?php echo $_GET['unknown_error'], "Unknown error occured."; ?>
            <a href="user-profile.php">
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
            <?php echo $_GET['success'], "Profile has been updated successfully."; ?>
            <a href="user-profile.php">
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </a>
          </div>
        </div>
      <?php
      }
      ?>

      <section class="section profile">
        <div class="row">
          <div class="col-xl-4">
            <div class="card">
              <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                <img src="../../assets/img/profile.jpg" alt="Profile" class="rounded-circle">
                <h2 class="mt-4"><?php echo $firstname . " " . $middlename . " " . $lastname ?></h2>
                <h3>Teacher</h3>
                <div class="social-links mt-2">
                  <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                  <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                  <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                  <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>

          </div>

          <div class="col-xl-8">
            <div class="card">
              <div class="card-body pt-3">
                <ul class="nav nav-tabs nav-tabs-bordered">

                  <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                  </li>

                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit</button>
                  </li>

                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Password</button>
                  </li>

                </ul>
                <div class="tab-content pt-2">

                  <div class="tab-pane fade show active profile-overview" id="profile-overview">
                    <h5 class="card-title">Profile Details</h5>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Full Name</div>
                      <div class="col-lg-9 col-md-8"><?php echo $firstname . " " . $middlename . " " . $lastname ?></div>
                    </div>
                    <!-- <div class="row">
                      <div class="col-lg-3 col-md-4 label">Grade</div>
                      <div class="col-lg-9 col-md-8">12</div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Section</div>
                      <div class="col-lg-9 col-md-8">Jupiter</div>
                    </div> -->
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Phone #</div>
                      <div class="col-lg-9 col-md-8"><?php echo $phone_number ?></div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Email</div>
                      <div class="col-lg-9 col-md-8"><?php echo $email ?></div>
                    </div>
                  </div>

                  <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                    <form action="update-user-profile.php" method="POST">
                      <div class="row mb-3">
                        <label for="firstname" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="firstname" type="text" class="form-control" id="firstname" value="<?php echo $firstname ?>">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="middlename" class="col-md-4 col-lg-3 col-form-label">Middle Name</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="middlename" type="text" class="form-control" id="middlename" value="<?php echo $middlename ?>">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="lastname" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="lastname" type="text" class="form-control" id="lastname" value="<?php echo $lastname ?>">
                        </div>
                      </div>
                      <!-- <div class="row mb-3">
                        <label for="grade" class="col-md-4 col-lg-3 col-form-label">Grade</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="grade" type="text" class="form-control" id="grade" value="12">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="section" class="col-md-4 col-lg-3 col-form-label">Section</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="section" type="text" class="form-control" id="section" value="Jupiter">
                        </div>
                      </div> -->
                      <div class="row mb-3">
                        <label for="phone_number" class="col-md-4 col-lg-3 col-form-label">Phone #</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="phone_number" type="text" class="form-control" id="phone_number" value="<?php echo $phone_number ?>">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="email" type="email" class="form-control" id="email" value="<?php echo $email ?>">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="offset-md-3 col-lg-9">
                          <button type="submit" class="btn btn-success">
                            <i class="bi bi-upload"></i>&nbsp; Update
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="tab-pane fade pt-3" id="profile-change-password">
                    <form>
                      <div class="row mb-3">
                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="password" type="password" class="form-control" id="currentPassword">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="newpassword" type="password" class="form-control" id="newPassword">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <div class="offset-md-3 col-lg-9">
                          <button type="submit" class="btn btn-success">
                            <i class="bi bi-arrow-left-right"></i>&nbsp; Change
                          </button>
                        </div>
                      </div>
                    </form>

                  </div>

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
