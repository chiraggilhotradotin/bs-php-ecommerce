<?php
    include("../includes/connection.php");
    if(isset($_POST['submit']))
    {
        $result = $conn->query("SELECT * FROM admins WHERE admin_username='{$_POST['admin_username']}' AND admin_password=MD5('{$_POST['admin_password']}')");
        if($result->num_rows)
        {
            $row = $result->fetch_assoc();
            $_SESSION['admin_id'] = $row['admin_id'];
            header("location: index.php");
        }
        else{
            $error = "Wrong username or password.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="d-flex align-items-center min-vh-100">
        <div class="container-fluid">
            <div class="row">
                <form class="col-md-6 offset-md-3" method="post">
                    <?php
                        if(isset($error))
                            echo "<div class='alert alert-danger'>$error</div>"
                    ?>
                    <div>
                        <label for="admin_username">Username</label>
                        <input type="text" name="admin_username" id="admin_username" class="form-control" required>
                    </div>
                    <div class="mt-3">
                        <label for="admin_password">Password</label>
                        <input type="password" name="admin_password" id="admin_password" class="form-control" required>
                    </div>
                    <div class="mt-4">
                        <input type="submit" name="submit" class="btn btn-primary w-100">
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