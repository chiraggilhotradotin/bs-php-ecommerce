<?php
    include("includes/connection.php");
    if(isset($_POST['submit']))
    {
        try{
            $conn->query("INSERT INTO users (user_name, user_email, user_mobile, user_password) VALUES('{$_POST['user_name']}','{$_POST['user_email']}','{$_POST['user_mobile']}',MD5('{$_POST['user_password']}'))");
            $success = "User created successfully. Please click <a href='sendmail.php'>here</a> to verify your account.";
            $_SESSION['user_email'] = $_POST['user_email'];
            $_SESSION['user_id'] = $conn->insert_id;
        }
        catch(mysqli_sql_exception $e)
        {
            if(preg_match("/for key 'user_email'/",$e))
            $error = "Email already exists.";
            else if(preg_match("/for key 'user_mobile'/",$e))
            $error = "Mobile already exists.";
            else 
            $error = "Some error occured.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="d-flex align-items-center min-vh-100">
        <div class="container-fluid">
            <div class="row">
                <form class="col-md-6 offset-md-3" method="post">
                    <div class="alert alert-secondary text-center h2">
                        Signup
                    </div>
                    <?php
                        if(isset($success))
                        echo "<div class='alert alert-success'>$success</div>";
                        else if(isset($error))
                        echo "<div class='alert alert-danger'>$error</div>";
                    ?>
                    <div>
                        <label for="user_name">Name</label>
                        <input type="text" name="user_name" id="user_name" required class="form-control">
                    </div>
                    <div class="mt-3">
                        <label for="user_email">Email</label>
                        <input type="email" name="user_email" id="user_email" required class="form-control">
                    </div>
                    <div class="mt-3">
                        <label for="user_mobile">Mobile</label>
                        <input type="tel" name="user_mobile" pattern="[0-9]{10}" id="user_mobile" required class="form-control">
                    </div>
                    <div class="mt-3">
                        <label for="user_password">Password</label>
                        <input type="password" name="user_password" id="user_password" required class="form-control">
                    </div>
                    <div class="mt-4">
                        <input type="submit" value="Signup" name="submit" class="btn btn-primary w-100">
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