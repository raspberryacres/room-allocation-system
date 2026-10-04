<?php

session_start();

if(!isset($_SESSION['student_name'])){

header("Location: login.php");

exit();

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div class="appbar">

        <div class="container d-flex justify-content-between align-items-center">

            <span class="brand">
                <span class="tag">RAS</span>Room Allocation System
            </span>

            <div>

                <span class="welcome me-3">
                    Welcome, <?php echo $_SESSION['student_name']; ?>
                </span>

                <a href="login.php" class="btn btn-outline-cream btn-sm">
                    Logout
                </a>

            </div>

        </div>

    </div>


    <div class="container">

        <div class="page-head">
            <div class="eyebrow">Student Dashboard</div>
            <h2>What would you like to do?</h2>
        </div>

        <div class="row g-4 pb-5">

            <div class="col-md-4">

                <div class="tile">

                    <div class="num">01</div>

                    <h5>Request Accommodation</h5>

                    <p>Submit a hostel room request for the current session.</p>

                    <a href="request.php" class="btn btn-ink">

                        Request Room

                    </a>

                </div>

            </div>


            <div class="col-md-4">

                <div class="tile">

                    <div class="num">02</div>

                    <h5>View Allocation Status</h5>

                    <p>Check your current room allocation details.</p>

                    <a href="status.php" class="btn btn-brass">

                        View Status

                    </a>

                </div>

            </div>


            <div class="col-md-4">

                <div class="tile">

                    <div class="num">03</div>

                    <h5>Notifications</h5>

                    <p>View updates regarding accommodation requests.</p>

                    <a href="#" class="btn btn-warning">

                        View Updates

                    </a>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
