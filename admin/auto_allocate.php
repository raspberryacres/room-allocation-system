<?php

session_start();

include("../config/config.php");

if (!isset($_SESSION['admin_id'])) {

    header("Location: login.php");

    exit();

}

$hostelName = $_SESSION['hostelName'];

$pendingQuery = "SELECT * FROM allocation_requests

WHERE hostelName='$hostelName'
AND approvalStatus='Pending'";

$pendingResult = mysqli_query($conn, $pendingQuery);

$allocatedCount = 0;

while ($student = mysqli_fetch_assoc($pendingResult)) {

    $requestId = $student['requestId'];

    $studentLevel = $student['level'];

    $matricNo = $student['matricNo'];

    $bedQuery = "SELECT * FROM rooms

WHERE hostelName='$hostelName'
AND occupied='No'";

    $bedResult = mysqli_query($conn, $bedQuery);

    $allocated = false;

    while ($bed = mysqli_fetch_assoc($bedResult)) {

        $roomNo = $bed['roomNo'];

        $bedSpace = $bed['bedSpace'];

        $checkRoom = "SELECT * FROM rooms

WHERE hostelName='$hostelName'
AND roomNo='$roomNo'
AND occupantLevel='$studentLevel'";

        $checkResult = mysqli_query($conn, $checkRoom);

        if (mysqli_num_rows($checkResult) == 0) {

            $updateRequest = "UPDATE allocation_requests

SET

roomNo='$roomNo',
bedSpace='$bedSpace',
approvalStatus='Approved'

WHERE requestId='$requestId'";

            mysqli_query($conn, $updateRequest);

            $updateRoom = "UPDATE rooms

SET

occupied='Yes',
occupantMatricNo='$matricNo',
occupantLevel='$studentLevel'

WHERE roomId='" . $bed['roomId'] . "'";

            mysqli_query($conn, $updateRoom);

            $allocated = true;

            $allocatedCount++;

            break;

        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>

        Auto Allocation

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

    <div class="container mt-5">

        <div class="row justify-content-center">

            <div class="col-md-6">

                <div class="sheet text-center">

                    <div class="section-label">Automated Assignment &middot; <?php echo $hostelName; ?></div>

                    <h2>Auto Allocation Complete</h2>

                    <p class="v big mono my-3"><?php echo $allocatedCount; ?></p>

                    <p class="sub mb-4">

                        student<?php echo ($allocatedCount == 1) ? '' : 's'; ?> allocated successfully.

                    </p>

                    <a href="dashboard.php" class="btn btn-ink">

                        Back to Dashboard

                    </a>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
