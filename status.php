<?php

session_start();

include("config/config.php");

$matricNo = $_SESSION['matricNo'];

$query = "SELECT * FROM allocation_requests
WHERE matricNo='$matricNo'
ORDER BY requestId DESC
LIMIT 1";

$result = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Allocation Status
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div class="appbar">
        <div class="container d-flex align-items-center">
            <span class="brand"><span class="tag">RAS</span>Room Allocation System</span>
        </div>
    </div>

    <div class="container mt-5">

        <div class="row justify-content-center">

            <div class="col-md-7">

                <?php if ($data) { ?>

                    <div class="ticket mb-4">

                        <div class="ticket-head">
                            <div>
                                <div class="eyebrow">Allocation Ticket</div>
                                <h2><?php echo $data['studentName']; ?></h2>
                            </div>
                            <?php

                            $statusPillClass = [
                                'Pending'  => 'status-pending',
                                'Approved' => 'status-approved',
                                'Rejected' => 'status-rejected',
                            ][$data['approvalStatus']] ?? '';

                            ?>
                            <span class="status-pill <?php echo $statusPillClass; ?>">
                                <?php echo $data['approvalStatus']; ?>
                            </span>
                        </div>

                        <div class="ticket-stub">
                            <div class="row">
                                <div class="col-6">
                                    <div class="k">Matric Number</div>
                                    <div class="v mono"><?php echo $data['matricNo']; ?></div>
                                </div>
                                <div class="col-6">
                                    <div class="k">Level</div>
                                    <div class="v mono"><?php echo $data['level']; ?></div>
                                </div>
                                <div class="col-12">
                                    <div class="k">Hostel</div>
                                    <div class="v"><?php echo $data['hostelName']; ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="perforation"></div>

                        <div class="ticket-stub">
                            <div class="row">
                                <div class="col-6">
                                    <div class="k">Room Number</div>

                                    <?php if ($data['roomNo'] == "") { ?>
                                        <div class="v placeholder">Not assigned yet</div>
                                    <?php } else { ?>
                                        <div class="v big mono"><?php echo $data['roomNo']; ?></div>
                                    <?php } ?>

                                </div>
                                <div class="col-6">
                                    <div class="k">Bed Space</div>

                                    <?php if ($data['bedSpace'] == "") { ?>
                                        <div class="v placeholder">Not assigned yet</div>
                                    <?php } else { ?>
                                        <div class="v big mono"><?php echo $data['bedSpace']; ?></div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>

                    </div>

                <?php } else { ?>

                    <div class="sheet mb-4">
                        <div class="alert alert-warning mb-0">

                            No allocation request found.

                        </div>
                    </div>

                <?php } ?>

                <a href="dashboard.php" class="btn btn-ink">

                    Back to Dashboard

                </a>

            </div>

        </div>

    </div>

</body>

</html>
