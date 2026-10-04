<?php

session_start();

include("../config/config.php");

if (isset($_POST['login'])) {

    $email = $_POST['email'];

    $password = $_POST['password'];

    $query = "SELECT * FROM admin
WHERE email='$email'
AND password='$password'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        $_SESSION['admin_id'] = $row['id'];

        $_SESSION['hostelName'] = $row['hostelName'];

        $_SESSION['admin_email'] = $row['email'];

        header("Location: dashboard.php");

        exit();

    } else {

        $error = "Invalid admin credentials";

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Admin Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <div class="auth-shell">

        <div class="auth-form-side">

            <div class="auth-card">

                <div class="eyebrow">Hostel Room Allocation System</div>

                    <h2>Admin Login</h2>

                    <?php

                    if (isset($error)) {

                        echo "<div class='alert alert-danger'>$error</div>";

                    }

                    ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label>
                                Staff Email
                            </label>

                            <input type="email" name="email" class="form-control" required>

                        </div>

                        <div class="mb-3">

                            <label>
                                Password
                            </label>

                            <input type="password" name="password" class="form-control" required>

                        </div>

                        <button type="submit" name="login" class="btn btn-dark w-100">

                            Login

                        </button>

                    </form>

            </div>

        </div>

    </div>

</body>

</html>