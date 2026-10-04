<?php

session_start();

include("../config/config.php");

if (!isset($_SESSION['admin_id'])) {

    header("Location: login.php");

    exit();

}

$hostelName = $_SESSION['hostelName'];

$totalBedsQuery = "SELECT * FROM rooms
WHERE hostelName='$hostelName'";

$totalBedsResult = mysqli_query($conn, $totalBedsQuery);

$totalBeds = mysqli_num_rows($totalBedsResult);

$occupiedQuery = "SELECT * FROM rooms
WHERE hostelName='$hostelName'
AND occupied='Yes'";

$occupiedResult = mysqli_query($conn, $occupiedQuery);

$occupiedBeds = mysqli_num_rows($occupiedResult);

$freeBeds = $totalBeds - $occupiedBeds;

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

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>

        Occupancy Reports

    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <div class="appbar">
        <div class="container d-flex align-items-center">
            <span class="brand"><span class="tag">RAS</span>Room Allocation System &mdash; Admin</span>
        </div>
    </div>

    <div class="container">

        <div class="page-head">
            <div class="eyebrow">Occupancy Report</div>
            <h2><?php echo $hostelName; ?></h2>
        </div>

        <div class="row g-4 pb-3">

            <div class="col-6 col-md-4">
                <div class="tile">
                    <div class="num"><?php echo $totalBeds; ?></div>
                    <h5>Total Bedspaces</h5>
                </div>
            </div>

            <div class="col-6 col-md-4">
                <div class="tile">
                    <div class="num"><?php echo $occupiedBeds; ?></div>
                    <h5>Occupied Bedspaces</h5>
                </div>
            </div>

            <div class="col-6 col-md-4">
                <div class="tile">
                    <div class="num"><?php echo $freeBeds; ?></div>
                    <h5>Available Bedspaces</h5>
                </div>
            </div>

            <div class="col-6 col-md-6">
                <div class="tile">
                    <div class="num"><?php echo $approvedCount; ?></div>
                    <h5>Approved Requests</h5>
                </div>
            </div>

            <div class="col-6 col-md-6">
                <div class="tile">
                    <div class="num"><?php echo $pendingCount; ?></div>
                    <h5>Pending Requests</h5>
                </div>
            </div>

        </div>

        <a href="dashboard.php" class="btn btn-ink mb-5">

            Back to Dashboard

        </a>

    </div>

</body>

</html>
