<?php
include '../../config.php';
session_start();
if ($_SESSION['id']) {
    $studentID = $_SESSION['id'];
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

        <style>
            input[type="radio"] {
                display: none;
            }

            input[type="radio"]+label {
                display: inline-block;
                padding: 15px;
                text-align: center;
                text-decoration: none;
                font-size: 16px;
                border: none;
                border-radius: 30px;
                cursor: pointer;
                color: #fff;
                background: none;
                background-size: 200% 100%;
                transition: background-position 0.5s ease-in-out;
            }

            input[type="radio"]:checked+label {
                background: linear-gradient(to bottom, #346b00 0%, #00196b 100%);
                color: white;
            }
        </style>
    </head>

    <body>
        <?php include 'header.php' ?>
        <?php include 'aside.php' ?>
        <?php
        $stmt = $conn->prepare(' SELECT * FROM tbl_student WHERE id =? ');
        $stmt->bind_param('i', $studentID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $firstname = $row['firstname'];
        ?>

        <main id="main" class="main">

            <div class="pagetitle">
                <h1>Welcome, <span class="fw-bold text-success"><?php echo $firstname ?></span>!</h1>
            </div>

            <section class="section dashboard mb-5">
                <?php
                if (isset($_GET['success'])) {
                ?>
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center justify-content-center my-3" role="alert">
                        <div>
                            <?php echo $_GET['success'], "Your vote has been submitted successfully."; ?>
                            <a href="candidates.php">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </a>
                        </div>
                    </div>
                <?php
                }
                if (isset($_GET['done'])) {
                ?>
                    <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center justify-content-center my-3" role="alert">
                        <div>
                            <?php echo $_GET['done'], "You have already done voting."; ?>
                            <a href="candidates.php">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </a>
                        </div>
                    </div>
                <?php
                }
                ?>
                <form action="submit-vote.php" method="POST" class="mt-4">
                    <div class="row">
                        <h3 class="mb-3">President</h3>
                        <?php
                        $president = 1;
                        $stmt = $conn->prepare(' SELECT 
                        tbl_candidates.id,
                        tbl_candidates.candidate_position,
                        tbl_position.position,
                        tbl_candidates.candidate_name,
                        tbl_candidates.img_name
                        FROM tbl_candidates
                        INNER JOIN tbl_position ON tbl_candidates.candidate_position = tbl_position.id
                        WHERE tbl_candidates.candidate_position = ? ');
                        $stmt->bind_param('i', $president);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            $candidate_id = $row['id'];
                            $p_position = $row['position'];
                            $candidate_position = $row['candidate_position'];
                            $president_name = $row['candidate_name'];
                            $img_name = $row['img_name'];
                            echo '
                            <div class="col-lg-3 d-flex align-items-end mb-3">
                                <input type="radio" name="position_' . $candidate_position . '" value="' . $candidate_id . '" id="pres_' . $candidate_id . '" />
                                <label class="form-check-label" for="pres_' . $candidate_id . '">
                                    <img src="../../candidates-img/' . $img_name . '" alt="Profile" class="form-check-input mx-2" id=" ' . $candidate_id . ' " style="width: 120px; height: 120px; border-radius: 50%; cursor: pointer;" />
                                </label>
                                <span id="pres">' . $president_name . '</span>
                            </div>';
                        }
                        ?>
                    </div>
                    <hr class="my-4">
                    <div class="row">
                        <h3 class="mb-3">Vice President</h3>
                        <?php
                        $v_president = 2;
                        $stmt = $conn->prepare(' SELECT 
                        tbl_candidates.id,
                        tbl_candidates.candidate_position,
                        tbl_position.position,
                        tbl_candidates.candidate_name,
                        tbl_candidates.img_name
                        FROM tbl_candidates
                        INNER JOIN tbl_position ON tbl_candidates.candidate_position = tbl_position.id
                        WHERE tbl_candidates.candidate_position = ? ');
                        $stmt->bind_param('i', $v_president);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            $candidate_id = $row['id'];
                            $vp_position = $row['position'];
                            $candidate_position = $row['candidate_position'];
                            $vicepresident_name = $row['candidate_name'];
                            $img_name = $row['img_name'];
                            echo '
                            <div class="col-lg-3 d-flex align-items-end mb-3">
                                <input type="radio" name="position_' . $candidate_position . '" value="' . $candidate_id . '" id="vpres_' . $candidate_id . '" />
                                <label class="form-check-label" for="vpres_' . $candidate_id . '">
                                    <img src="../../candidates-img/' . $img_name . '" alt="Profile" class="form-check-input mx-2" id=" ' . $candidate_id . ' " style="width: 120px; height: 120px; border-radius: 50%; cursor: pointer;" />
                                </label>
                                <span  id="vpres">' . $vicepresident_name . '</span>
                            </div>';
                        }
                        ?>
                    </div>
                    <hr class="my-4">
                    <div class="row">
                        <h3 class="mb-3">Secretary</h3>
                        <?php
                        $secretary = 3;
                        $stmt = $conn->prepare(' SELECT 
                        tbl_candidates.id,
                        tbl_candidates.candidate_position,
                        tbl_position.position,
                        tbl_candidates.candidate_name,
                        tbl_candidates.img_name
                        FROM tbl_candidates
                        INNER JOIN tbl_position ON tbl_candidates.candidate_position = tbl_position.id
                        WHERE tbl_candidates.candidate_position = ? ');
                        $stmt->bind_param('i', $secretary);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            $candidate_id = $row['id'];
                            $sec_position = $row['position'];
                            $candidate_position = $row['candidate_position'];
                            $secretary_name = $row['candidate_name'];
                            $img_name = $row['img_name'];
                            echo '
                            <div class="col-lg-3 d-flex align-items-end mb-3">
                                <input type="radio" name="position_' . $candidate_position . '" value="' . $candidate_id . '" id="secretary_' . $candidate_id . '" />
                                <label class="form-check-label" for="secretary_' . $candidate_id . '">
                                    <img src="../../candidates-img/' . $img_name . '" alt="Profile" class="form-check-input mx-2" id=" ' . $candidate_id . ' " style="width: 120px; height: 120px; border-radius: 50%; cursor: pointer;" />
                                </label>
                                <span id="secretary">' . $secretary_name . '</span>
                            </div>';
                        }
                        ?>
                    </div>
                    <hr class="my-4">
                    <div class="row">
                        <h3 class="mb-3">Treasurer</h3>
                        <?php
                        $treasurer = 4;
                        $stmt = $conn->prepare(' SELECT 
                        tbl_candidates.id,
                        tbl_candidates.candidate_position,
                        tbl_position.position,
                        tbl_candidates.candidate_name,
                        tbl_candidates.img_name
                        FROM tbl_candidates
                        INNER JOIN tbl_position ON tbl_candidates.candidate_position = tbl_position.id
                        WHERE tbl_candidates.candidate_position = ? ');
                        $stmt->bind_param('i', $treasurer);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            $candidate_id = $row['id'];
                            $treas_position = $row['position'];
                            $candidate_position = $row['candidate_position'];
                            $treasurer_name = $row['candidate_name'];
                            $img_name = $row['img_name'];
                            echo '
                            <div class="col-lg-3 d-flex align-items-end mb-3">
                                <input type="radio" name="position_' . $candidate_position . '" value="' . $candidate_id . '" id="treasurer_' . $candidate_id . '" />
                                <label class="form-check-label" for="treasurer_' . $candidate_id . '">
                                    <img src="../../candidates-img/' . $img_name . '" alt="Profile" class="form-check-input mx-2" id=" ' . $candidate_id . ' " style="width: 120px; height: 120px; border-radius: 50%; cursor: pointer;" />
                                </label>
                                <span id="treasurer">' . $treasurer_name . '</span>
                            </div>';
                        }
                        ?>
                    </div>
                    <hr class="my-4">
                    <div class="row">
                        <h3 class="mb-3">Auditor</h3>
                        <?php
                        $auditor = 5;
                        $stmt = $conn->prepare(' SELECT 
                        tbl_candidates.id,
                        tbl_candidates.candidate_position,
                        tbl_position.position,
                        tbl_candidates.candidate_name,
                        tbl_candidates.img_name
                        FROM tbl_candidates
                        INNER JOIN tbl_position ON tbl_candidates.candidate_position = tbl_position.id
                        WHERE tbl_candidates.candidate_position = ? ');
                        $stmt->bind_param('i', $auditor);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            $candidate_id = $row['id'];
                            $aud_position = $row['position'];
                            $candidate_position = $row['candidate_position'];
                            $auditor_name = $row['candidate_name'];
                            $img_name = $row['img_name'];
                            echo '
                            <div class="col-lg-3 d-flex align-items-end mb-3">
                                <input type="radio" name="position_' . $candidate_position . '" value="' . $candidate_id . '" id="auditor_' . $candidate_id . '" />
                                <label class="form-check-label" for="auditor_' . $candidate_id . '">
                                    <img src="../../candidates-img/' . $img_name . '" alt="Profile" class="form-check-input mx-2" id=" ' . $candidate_id . ' " style="width: 120px; height: 120px; border-radius: 50%; cursor: pointer;" />
                                </label>
                                <span id="auditor">' . $auditor_name . '</span>
                            </div>';
                        }
                        ?>
                    </div>
                    <hr class="my-4">
                    <div class="row">
                        <h3 class="mb-3">P.I.O</h3>
                        <?php
                        $pio = 6;
                        $stmt = $conn->prepare(' SELECT 
                        tbl_candidates.id,
                        tbl_candidates.candidate_position,
                        tbl_position.position,
                        tbl_candidates.candidate_name,
                        tbl_candidates.img_name
                        FROM tbl_candidates
                        INNER JOIN tbl_position ON tbl_candidates.candidate_position = tbl_position.id
                        WHERE tbl_candidates.candidate_position = ? ');
                        $stmt->bind_param('i', $pio);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            $candidate_id = $row['id'];
                            $pio_position = $row['position'];
                            $candidate_position = $row['candidate_position'];
                            $pio_name = $row['candidate_name'];
                            $img_name = $row['img_name'];
                            echo '
                            <div class="col-lg-3 d-flex align-items-end mb-3">
                                <input type="radio" name="position_' . $candidate_position . '" value="' . $candidate_id . '" id="pio_' . $candidate_id . '" />
                                <label class="form-check-label" for="pio_' . $candidate_id . '">
                                    <img src="../../candidates-img/' . $img_name . '" alt="Profile" class="form-check-input mx-2" id=" ' . $candidate_id . ' " style="width: 120px; height: 120px; border-radius: 50%; cursor: pointer;" />
                                </label>
                                <span id="pio">' . $pio_name . '</span>
                            </div>';
                        }
                        ?>
                    </div>
                    <hr class="my-4">
                    <div class="row">
                        <h3 class="mb-3">Protocol Officer</h3>
                        <?php
                        $p_o = 7;
                        $stmt = $conn->prepare(' SELECT 
                        tbl_candidates.id,
                        tbl_candidates.candidate_position,
                        tbl_position.position,
                        tbl_candidates.candidate_name,
                        tbl_candidates.img_name
                        FROM tbl_candidates
                        INNER JOIN tbl_position ON tbl_candidates.candidate_position = tbl_position.id
                        WHERE tbl_candidates.candidate_position = ? ');
                        $stmt->bind_param('i', $p_o);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            $candidate_id = $row['id'];
                            $po_position = $row['position'];
                            $candidate_position = $row['candidate_position'];
                            $protocolofficer_name = $row['candidate_name'];
                            $img_name = $row['img_name'];
                            echo '
                            <div class="col-lg-3 d-flex align-items-end mb-3">
                                <input type="radio" name="position_' . $candidate_position . '" value="' . $candidate_id . '" id="po_' . $candidate_id . '" />
                                <label class="form-check-label" for="po_' . $candidate_id . '">
                                    <img src="../../candidates-img/' . $img_name . '" alt="Profile" class="form-check-input mx-2" id=" ' . $candidate_id . ' " style="width: 120px; height: 120px; border-radius: 50%; cursor: pointer;" />
                                </label>
                                <span id="po">' . $protocolofficer_name . '</span>
                            </div>';
                        }
                        ?>
                    </div>
                    <hr class="my-4">
                    <?php
                    $vote_status = 1;
                    $stmt = $conn->prepare(' SELECT * FROM tbl_student WHERE vote_status = ? AND id = ? ');
                    $stmt->bind_param('ii', $vote_status, $studentID);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (mysqli_num_rows($result) > 0) {
                        $btn_indicator = "block";
                    } else {
                        $btn_indicator = "none";
                    }
                    
                    ?>
                    <button class="btn btn-success" style="display: <?php echo $btn_indicator ?>;" id="submit" type="button" data-bs-toggle="modal" data-bs-target="#submitModal">
                        Submit Vote &nbsp;<i class="bi bi-skip-forward"></i>
                    </button>

                    <div class="modal fade" id="submitModal" tabindex="-1" aria-labelledby="submitModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content p-1" >
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="submitModalLabel">Voting Confirmation</h1>
                                    <a href="candidates.php">
                                        <button type="button" class="btn-close"></button>
                                    </a>
                                </div>
                                <div class="modal-body" id="modal-content">
                                    <!-- <p>President: <span id="selectedPresident">?</span></p>
                                    <p>Vice President: <span id="selectedVicePresident">?</span></p>
                                    <p>Secretary: <span id="selectedSecretary">?</span></p>
                                    <p>Treasurer: <span id="selectedTreasurer">?</span></p>
                                    <p>Auditor: <span id="selectedAuditor">?</span></p>
                                    <p>Pio: <span id="selectedPio">?</span></p>
                                    <p>Protocol Officer: <span id="selectedProtocolOfficer">?</span></p> -->
                                </div>
                                <div class="modal-footer">
                                    <a href="candidates.php">
                                        <button type="button" class="btn btn-outline-danger">Close</button>
                                    </a>
                                    <button type="submit" class="btn btn-success">Confirm &nbsp;<i class="bi bi-check2-circle"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </section>

        </main>

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/js/main.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let previousSelectedImage = null;
                const imageInputs = document.querySelectorAll(".form-check-input");

                imageInputs.forEach(function (input) {
                    input.addEventListener('click', function () {
                        const selectedImage = document.getElementById(this.id);
                        const position = this.name.replace('position_', ''); // Extract position from input name

                        if (selectedImage) {
                            previousSelectedImage = selectedImage;

                            // Update modal content with the selected candidate's name
                            const candidateName = document.getElementById(position);
                            if (candidateName) {
                                document.getElementById('selected' + position).textContent = candidateName.textContent;
                            }
                        }
                    });
                });

                // Additional code to update the modal content when the form is submitted
                const submitButton = document.getElementById('submit');
                if (submitButton) {
                    submitButton.addEventListener('click', function () {
                        updateModalContent('1', 'President');
                        updateModalContent('2', 'Vice President');
                        updateModalContent('3', 'Secretary');
                        updateModalContent('4', 'Treasurer');
                        updateModalContent('5', 'Auditor');
                        updateModalContent('6', 'Pio');
                        updateModalContent('7', 'Protocol Officer');

                        // Show the modal only if at least one position is selected
                        const modalContent = document.getElementById('modal-content').innerHTML;
                        const modalButton = document.getElementById('submit');

                        if (modalContent.trim() !== '') {
                            modalButton.style.display = 'block';
                        } else {
                            modalButton.style.display = 'none';
                            alert('Please select at least one candidate.');
                        }
                    });
                }

                function updateModalContent(positionNumber, positionName) {
                    const selectedCandidate = document.querySelector(`input[name="position_${positionNumber}"]:checked + label + span`);
                    const modalContent = document.getElementById('modal-content');

                    if (selectedCandidate) {
                        modalContent.innerHTML += `<p>${positionName}: <span>${selectedCandidate.textContent}</span></p>`;
                    }
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
