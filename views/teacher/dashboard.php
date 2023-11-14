<?php
include '../../config.php';
session_start();
if ($_SESSION['id']) {
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

    <main id="main" class="main">

      <div class="pagetitle">
        <h1>Dashboard</h1>
      </div>

      <section class="section dashboard">
        <div class="row">
          <div class="col-xl-4 col-md-4">
            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">Undone with Voting</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <?php
                    $undone = 1;
                    $stmt = $conn->prepare(' SELECT * FROM tbl_student WHERE vote_status = ?');
                    $stmt->bind_param('i', $undone);
                    $stmt->execute();
                    $undone_result = $stmt->get_result();
                    $undone_vote = mysqli_num_rows($undone_result);
                    $undone_percent = $all_student / 1 * $undone_vote;
                    ?>
                    <h6><?php echo $undone_vote ?></h6>
                    <span class="text-danger small pt-1 fw-bold"><?php echo $undone_percent ?>%</span> <span class="text-muted small pt-2 ps-1">covered</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-4 col-md-4">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Done with Voting</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <?php
                    $done = 2;
                    $stmt = $conn->prepare(' SELECT * FROM tbl_student WHERE vote_status = ?');
                    $stmt->bind_param('i', $done);
                    $stmt->execute();
                    $done_result = $stmt->get_result();
                    $done_vote = mysqli_num_rows($done_result);
                    $done_percent = $all_student / 1 * $done_vote;
                    ?>
                    <h6><?php echo $done_vote ?></h6>
                    <span class="text-success small pt-1 fw-bold"><?php echo $done_percent ?>%</span> <span class="text-muted small pt-2 ps-1">covered</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-4 col-md-4">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">All Students</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php echo $all_student ?></h6>
                    <span class="text-success small pt-1 fw-bold">100%</span> <span class="text-muted small pt-2 ps-1">overall</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Gender Analysis</h5>
                <div class="d-flex align-items-center">
                  <?php
                  $stmt = $conn->prepare('SELECT gender FROM tbl_gender');
                  $stmt->execute();
                  $result = $stmt->get_result();
                  $label_gender = [];
                  while ($row = $result->fetch_assoc()) {
                    $label_gender[] = $row['gender'];
                  }
                  $stmt = $conn->prepare('SELECT gender, COUNT(*) as count FROM tbl_student GROUP BY gender');
                  $stmt->execute();
                  $result = $stmt->get_result();
                  $gender = [];
                  while ($row = $result->fetch_assoc()) {
                    $gender[] = $row['count'];
                  }
                  ?>
                  <canvas id="gender_chart"></canvas>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Grade Level Analysis</h5>
                <div class="d-flex align-items-center">
                  <?php
                  $stmt = $conn->prepare('SELECT grade_level FROM tbl_grade_level');
                  $stmt->execute();
                  $result = $stmt->get_result();
                  $label_grade_level = [];
                  while ($row = $result->fetch_assoc()) {
                    $label_grade_level[] = $row['grade_level'];
                  }
                  $stmt = $conn->prepare('SELECT grade_level, COUNT(*) as count FROM tbl_student GROUP BY grade_level');
                  $stmt->execute();
                  $result = $stmt->get_result();
                  $grade_level = [];
                  while ($row = $result->fetch_assoc()) {
                    $grade_level[] = $row['count'];
                  }
                  ?>
                  <canvas id="grade_level_chart"></canvas>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Section</h5>
                <div class="d-flex align-items-center">
                  <?php
                  $stmt = $conn->prepare('SELECT section FROM tbl_section');
                  $stmt->execute();
                  $result = $stmt->get_result();
                  $label_section = [];
                  while ($row = $result->fetch_assoc()) {
                    $label_section[] = $row['section'];
                  }
                  $stmt = $conn->prepare('SELECT section, COUNT(*) as count FROM tbl_student GROUP BY section');
                  $stmt->execute();
                  $result = $stmt->get_result();
                  $section = [];
                  while ($row = $result->fetch_assoc()) {
                    $section[] = $row['count'];
                  }
                  ?>
                  <canvas id="section_chart"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Voting Coverage</h5>
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
                  echo '<div class="table-responsive">';
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
                    echo '<tr';
                    echo '>';
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
                  echo '<div class="mb-3 fw-bold text-success">Highest Votes: ' . $maxVotesCandidate . ' (' . $maxVotes . ' votes)</div>';
                  echo '<hr class="mb-5">';
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script type="text/javascript">
      var ctx = document.getElementById("gender_chart").getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: <?php echo json_encode($label_gender); ?>,
          datasets: [{
            backgroundColor: [
              "#5969ff",
              "#25d5f2"
            ],
            data: <?php echo json_encode($gender); ?>,
          }]
        },
        options: {
          legend: {
            display: true,
            position: 'top',
            labels: {
              fontColor: '#71748d',
              fontFamily: 'sans-serif',
              fontSize: 11,
            }
          },
        }
      });
    </script>
    <script type="text/javascript">
      var ctx = document.getElementById("grade_level_chart").getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: <?php echo json_encode($label_grade_level); ?>,
          datasets: [{
            backgroundColor: [
              "#ff407b",
              "#ffc750"
            ],
            data: <?php echo json_encode($grade_level); ?>,
          }]
        },
        options: {
          legend: {
            display: true,
            position: 'top',
            labels: {
              fontColor: '#71748d',
              fontFamily: 'sans-serif',
              fontSize: 11,
            }
          },
        }
      });
    </script>
    <script type="text/javascript">
      var ctx = document.getElementById("section_chart").getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'polarArea',
        data: {
          labels: <?php echo json_encode($label_section); ?>,
          datasets: [{
            backgroundColor: [
              "#2ec551",
              "#7040fa",
              "#ff004e "
            ],
            data: <?php echo json_encode($section); ?>,
          }]
        },
        options: {
          legend: {
            display: true,
            position: 'top',
            labels: {
              fontColor: '#71748d',
              fontFamily: 'sans-serif',
              fontSize: 11,
            }
          },
        }
      });
    </script>

  </body>

  </html>
<?php
} else {
  header("Location: ../../index.php");
  exit();
}
