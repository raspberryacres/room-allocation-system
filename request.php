<?php

session_start();

include("config/config.php");

$matricNo = $_SESSION['matricNo'];

$studentQuery = "SELECT * FROM students
WHERE matricNo='$matricNo'";

$studentResult = mysqli_query($conn, $studentQuery);

$student = mysqli_fetch_assoc($studentResult);

$program = $student['program'];

$gender = $student['gender'];

$hostelQuery = "SELECT * FROM hostels
WHERE gender='$gender'";

$hostelResult = mysqli_query($conn, $hostelQuery);

if (isset($_POST['submit'])) {

    $studentName = $_POST['studentName'];
    $hostelName = $_POST['hostelName'];
    $matricNo = $_POST['matricNo'];
    $program = $_POST['program'];
    $department = $_POST['department'];
    $level = $_POST['level'];

    $query = "INSERT INTO allocation_requests
(studentName,hostelName,matricNo,program,department,level,roomNo,bedSpace,approvalStatus)

VALUES
(
'$studentName',
'$hostelName',
'$matricNo',
'$program',
'$department',
'$level',
'',
'',
'Pending'
)";

    $result = mysqli_query($conn, $query);

    if ($result) {

        $message = "Request submitted successfully";

    } else {

        $message = "Request submission failed";

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Room Request</title>

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

            <div class="col-md-8">

                <div class="sheet">

                    <h2>Accommodation Request Form</h2>
                    <p class="sub">Confirm your details and choose a hostel for the session.</p>

                    <?php

                    if (isset($message)) {

                        echo "<div class='alert alert-info mb-4'>$message</div>";

                    }

                    ?>

                    <form method="POST">

                        <div class="id-box">

                            <div class="section-label">Your Details</div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="k">Student Name</div>
                                    <div class="v"><?php echo $student['name']; ?></div>
                                    <input type="hidden" name="studentName" value="<?php echo $student['name']; ?>">
                                </div>

                                <div class="col-md-6">
                                    <div class="k">Matric Number</div>
                                    <div class="v"><?php echo $student['matricNo']; ?></div>
                                    <input type="hidden" name="matricNo" value="<?php echo $student['matricNo']; ?>">
                                </div>

                                <div class="col-md-6">
                                    <div class="k">Department</div>
                                    <div class="v"><?php echo $student['department']; ?></div>
                                    <input type="hidden" name="department" value="<?php echo $student['department']; ?>">
                                </div>

                                <div class="col-md-6">
                                    <div class="k">Program</div>
                                    <div class="v"><?php echo $student['program']; ?></div>
                                    <input type="hidden" name="program" value="<?php echo $student['program']; ?>">
                                </div>

                                <div class="col-md-6">
                                    <div class="k">Gender</div>
                                    <div class="v"><?php echo $student['gender']; ?></div>
                                </div>

                                <div class="col-md-6">
                                    <div class="k">Level</div>
                                    <div class="v"><?php echo $student['level']; ?></div>
                                    <input type="hidden" name="level" value="<?php echo $student['level']; ?>">
                                </div>

                            </div>

                        </div>

                        <div class="section-label">Room Preference</div>

                        <div class="row">

                            <div class="col-md-6 field">

                                <label>Hostel</label>

                                <select class="form-select" name="hostelName" required>

                                    <option>

                                        Select Hostel

                                    </option>

                                    <?php

                                    while ($hostel = mysqli_fetch_assoc($hostelResult)) {

                                        ?>

                                        <option>

                                            <?php echo $hostel['hostelName']; ?>

                                        </option>

                                        <?php

                                    }

                                    ?>

                                </select>

                            </div>

                        </div>

                        <button type="submit" name="submit" class="btn btn-ink w-100 mt-2">

                            Submit Request

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
