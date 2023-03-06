<?php
include("includes/connection.php");
if (isset($_POST['submit'])) {
    try {
        if ($_POST['otp'] == $_SESSION['otp']) {
            $conn->query("UPDATE users SET user_isverified=1 WHERE user_id='{$_SESSION['user_id']}'");
            $success = "Email verification successful. Click <a href='signin.php'>here</a> to signin.";
        } else
            $error = "Wrong otp.";
    } catch (mysqli_sql_exception $e) {
        $error = "Wrong otp.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify with OTP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="d-flex align-items-center min-vh-100">
        <div class="container-fluid">
            <div class="row">
                <form class="col-md-6 offset-md-3" method="post">
                    <div class="alert alert-secondary text-center h2">
                        Verify with OTP
                    </div>
                    <?php
                    if (isset($success))
                        echo "<div class='alert alert-success'>$success</div>";
                    else if (isset($error))
                        echo "<div class='alert alert-danger'>$error</div>";
                    else if (isset($_GET['error']))
                        echo "<div class='alert alert-danger'>{$_GET['error']}</div>";
                    else if (isset($_GET['success']))
                        echo "<div class='alert alert-success'>{$_GET['success']} Click <a href='sendmail.php'>here</a> to resend mail.</div>";
                    ?>
                    <div>
                        <label for="otp">OTP</label>
                        <input type="password" name="otp" id="otp" required class="form-control">
                    </div>
                    <div class="mt-4">
                        <input type="submit" value="Verify" name="submit" class="btn btn-primary w-100">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>
</body>

</html>