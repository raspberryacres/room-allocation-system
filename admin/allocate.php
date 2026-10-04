<?php

session_start();

include("../config/config.php");

if (isset($_POST['update'])) {

    $requestId = $_POST['requestId'];

    $roomNo = $_POST['roomNo'];

    $bedSpace = $_POST['bedSpace'];

    $approvalStatus = $_POST['approvalStatus'];

    $query = "UPDATE allocation_requests

SET

roomNo='$roomNo',
bedSpace='$bedSpace',
approvalStatus='$approvalStatus'

WHERE requestId='$requestId'";

    $result = mysqli_query($conn, $query);

    if ($result) {

        $message = "Allocation updated successfully";

    } else {

        $message = "Update failed";

    }

}

$hostelName = $_SESSION['hostelName'];
$select = "SELECT * FROM allocation_requests
WHERE hostelName='$hostelName'";

$records = mysqli_query($conn, $select);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>

        Admin Allocation Panel

    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

    <div class="container mt-5">

        <h2 class="mb-4 text-center">

            Admin Room Allocation Panel

        </h2>

        <?php

        if (isset($message)) {

            echo "<div class='alert alert-info'>$message</div>";

        }

        ?>

        <div class="card shadow p-4">

            <a href="auto_allocate.php" class="btn btn-dark mb-3">

                Approve All Pending Requests

            </a>

            <table class="table table-bordered table-striped">

                <thead>

                    <tr>

                        <th>
                            Student Name
                        </th>

                        <th>
                            Matric No
                        </th>

                        <th>
                            Hostel
                        </th>

                        <th>
                            Level
                        </th>

                        <th>
                            Assign Room
                        </th>

                        <th>
                            Bed Space
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php

                    while ($row = mysqli_fetch_assoc($records)) {

                        ?>

                        <tr>

                            <form method="POST">

                                <td>

                                    <?php echo $row['studentName']; ?>

                                </td>

                                <td>

                                    <?php echo $row['matricNo']; ?>

                                </td>

                                <td>

                                    <?php echo $row['hostelName']; ?>

                                </td>

                                <td>

                                    <?php echo $row['level']; ?>

                                </td>

                                <td>

                                    <input type="text" name="roomNo" class="form-control"
                                        value="<?php echo $row['roomNo']; ?>">

                                </td>

                                <td>

                                    <select name="bedSpace" class="form-select">

                                        <option>

                                            <?php echo $row['bedSpace']; ?>

                                        </option>

                                        <option>L1</option>
                                        <option>R1</option>
                                        <option>L2</option>
                                        <option>R2</option>

                                    </select>

                                </td>

                                <td>

                                    <select name="approvalStatus" class="form-select">

                                        <option>

                                            <?php echo $row['approvalStatus']; ?>

                                        </option>

                                        <option>Approved</option>
                                        <option>Rejected</option>
                                        <option>Pending</option>

                                    </select>

                                </td>

                                <td>

                                    <input type="hidden" name="requestId" value="<?php echo $row['requestId']; ?>">

                                    <button type="submit" name="update" class="btn btn-success">

                                        Update

                                    </button>

                                </td>

                            </form>

                        </tr>

                        <?php

                    }

                    ?>

                </tbody>

            </table>

        </div>

    </div>

</body>

</html>