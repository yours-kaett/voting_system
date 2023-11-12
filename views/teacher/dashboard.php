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
        <h1>Dashboard</h1>
      </div>

      <section class="section dashboard">
        <div class="row">
          <div class="col-lg-12">
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
                        <h6>400</h6>
                        <span class="text-danger small pt-1 fw-bold">40%</span> <span class="text-muted small pt-2 ps-1">covered</span>
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
                        <h6>600</h6>
                        <span class="text-success small pt-1 fw-bold">60%</span> <span class="text-muted small pt-2 ps-1">covered</span>
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
                        <h6>1, 000</h6>
                        <span class="text-success small pt-1 fw-bold">100%</span> <span class="text-muted small pt-2 ps-1">overall</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- <div class="col-lg-12">
                <div class="card">
                  <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                      <li class="dropdown-header text-start">
                        <h6>Filter</h6>
                      </li>
                      <li><a class="dropdown-item" href="#">Today</a></li>
                      <li><a class="dropdown-item" href="#">This Month</a></li>
                      <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">Reports <span>/ Today</span></h5>
                    <div id="reportsChart"></div>
                    <script>
                      document.addEventListener("DOMContentLoaded", () => {
                        new ApexCharts(document.querySelector("#reportsChart"), {
                          series: [{
                            name: 'All',
                            data: [15, 11, 32, 18, 9, 24, 11],
                          }, {
                            name: 'Done',
                            data: [11, 32, 45, 32, 34, 52, 41]
                          }, {
                            name: 'Undone',
                            data: [31, 40, 28, 51, 42, 82, 56]
                          }],
                          chart: {
                            height: 350,
                            type: 'area',
                            toolbar: {
                              show: false
                            },
                          },
                          markers: {
                            size: 4
                          },
                          colors: ['#4154f1', '#2eca6a', '#ff771d'],
                          fill: {
                            type: "gradient",
                            gradient: {
                              shadeIntensity: 1,
                              opacityFrom: 0.3,
                              opacityTo: 0.4,
                              stops: [0, 90, 100]
                            }
                          },
                          dataLabels: {
                            enabled: false
                          },
                          stroke: {
                            curve: 'smooth',
                            width: 2
                          },
                          xaxis: {
                            type: 'datetime',
                            categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                          },
                          tooltip: {
                            x: {
                              format: 'dd/MM/yy HH:mm'
                            },
                          }
                        }).render();
                      });
                    </script>
                  </div>
                </div>
              </div> -->

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

                      while ($name_row = $name_result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $name_row['candidate_name'] . '</td>';
                        echo '<td>' . $name_row['votes'] . '</td>';
                        echo '</tr>';
                      }

                      echo '</tbody>';
                      echo '</table>';
                      echo '</div>';
                      echo '<div class="mb-3"></div>';
                    }

                    ?>

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
