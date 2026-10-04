<?php

session_start();

include("config/config.php");

if (isset($_POST['login'])) {

    $matricNo = $_POST['matricNo'];
    $password = $_POST['password'];

    $query = "SELECT * FROM students
WHERE matricNo='$matricNo'
AND password='$password'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        $_SESSION['student_id'] = $row['id'];

        $_SESSION['student_name'] = $row['name'];

        $_SESSION['matricNo'] = $row['matricNo'];

        $_SESSION['program'] = $row['program'];

        header("Location: dashboard.php");

        exit();

    } else {

        $error = "Invalid login details";

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Student Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div class="auth-shell">

        <div class="auth-form-side">

            <div class="auth-card">

                <div class="eyebrow">Hostel Room Allocation System</div>

                <h2>Student Login</h2>

                <?php

                if (isset($error)) {

                    echo "<div class='alert alert-danger mb-3'>$error</div>";

                }

                ?>

                <form method="POST">

                    <div class="field">

                        <label>Matric Number</label>

                        <input type="text" class="form-control" name="matricNo" required>

                    </div>

                    <div class="field">

                        <label>Password</label>

                        <input type="password" class="form-control" name="password" required>

                    </div>

                    <button type="submit" name="login" class="btn btn-ink w-100">

                        Log In

                    </button>

                    <div class="text-center mt-3">

                        <a href="admin/login.php" class="btn btn-warning w-100">

                            Admin Login

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</body>

</html>
