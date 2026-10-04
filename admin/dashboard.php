<?php

session_start();

include("../config/config.php");

if (!isset($_SESSION['admin_id'])) {

    header("Location: login.php");

    exit();

}

$hostelName = $_SESSION['hostelName'];

$totalQuery = "SELECT * FROM allocation_requests
WHERE hostelName='$hostelName'";

$totalResult = mysqli_query($conn, $totalQuery);

$totalRequests = mysqli_num_rows($totalResult);

$approvedQuery = "SELECT * FROM allocation_requests
WHERE hostelName='$hostelName'
AND approvalStatus='Approved'";

$approvedResult = mysqli_query($conn, $approvedQuery);

$approvedCount = mysqli_num_rows($approvedResult);

$pendingQuery = "SELECT * FROM allocation_requests
WHERE hostelName='$hostelName'
AND approvalStatus='Pending'";

$pendingResult = mysqli_query($conn, $pendingQuery);

$pendingCount = mysqli_num_rows($pendingResult);

$occupiedQuery = "SELECT * FROM rooms
WHERE hostelName='$hostelName'
AND occupied='Yes'";

$occupiedResult = mysqli_query($conn, $occupiedQuery);

$occupiedCount = mysqli_num_rows($occupiedResult);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>

        Admin Dashboard

    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

    <nav class="navbar navbar-dark bg-dark">

        <div class="container">

            <span class="navbar-brand">

                <?php echo $hostelName; ?> Dashboard

            </span>

            <div>

                <span class="text-white me-3">

                    <?php echo $_SESSION['admin_email']; ?>

                </span>

                <a href="logout.php" class="btn btn-light btn-sm">

                    Logout

                </a>

            </div>

        </div>

    </nav>

    <div class="container mt-5">

        <div class="row">

            <div class="col-md-3 mb-4">

                <div class="card shadow text-center p-4">

                    <h5>

                        Total Requests

                    </h5>

                    <h2>

                        <?php echo $totalRequests; ?>

                    </h2>

                </div>

            </div>

            <div class="col-md-3 mb-4">

                <div class="card shadow text-center p-4">

                    <h5>

                        Approved

                    </h5>

                    <h2>

                        <?php echo $approvedCount; ?>

                    </h2>

                </div>

            </div>

            <div class="col-md-3 mb-4">

                <div class="card shadow text-center p-4">

                    <h5>

                        Pending

                    </h5>

                    <h2>

                        <?php echo $pendingCount; ?>

                    </h2>

                </div>

            </div>

            <div class="col-md-3 mb-4">

                <div class="card shadow text-center p-4">

                    <h5>

                        Occupied Bedspaces

                    </h5>

                    <h2>

                        <?php echo $occupiedCount; ?>

                    </h2>

                </div>

            </div>

        </div>

        <div class="row mt-4">

            <div class="col-md-4 mb-4">

                <div class="card shadow p-4 text-center">

                    <h5>

                        Allocation Requests

                    </h5>

                    <p>

                        Manage student room allocations.

                    </p>

                    <a href="allocate.php" class="btn btn-primary">

                        Open Module

                    </a>

                </div>

            </div>

            <div class="col-md-4 mb-4">

                <div class="card shadow p-4 text-center">

                    <h5>

                        Occupancy Reports

                    </h5>

                    <p>

                        View hostel occupancy statistics.

                    </p>

                    <a href="reports.php" class="btn btn-success">

                        View Reports

                    </a>

                </div>

            </div>

            <div class="col-md-4 mb-4">

                <div class="card shadow p-4 text-center">

                    <h5>

                        Auto Allocation

                    </h5>

                    <p>

                        Automatically allocate pending requests.

                    </p>

                    <a href="auto_allocate.php" class="btn btn-dark">

                        Run Auto Allocation

                    </a>

                </div>

            </div>

        </div>

    </div>

</body>

</html>