<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    include("includes/connection.php");

    $result = $conn->query("SELECT * FROM users WHERE user_id='{$_SESSION['user_id']}'");
    if($result->num_rows == 0)
    {
        header("location:signup.php");
        exit;
    }
    $row = $result->fetch_assoc();
    if($row['user_isverified'] == 1)
    {
        header("location:signin.php");
        exit;
    }

    require("vendor/autoload.php");

    $mail = new PHPMailer();
    try{
        $mail->isSMTP();
        $mail->Host = "your host";
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";
    
        $mail->SMTPAuth = true;
        $mail->Username = "your username";
        $mail->Password = "your password";
    
        $mail->setFrom("noreply@mail.chiraggilhotra.in","Ecommerce");
        $mail->addAddress($_SESSION['user_email']);
    
        $_SESSION['otp'] = rand(111111,999999);
        $verificationtoken = md5($_SESSION['otp']);
        $conn->query("UPDATE users SET user_verificationtoken='$verificationtoken' WHERE  user_id='{$_SESSION['user_id']}'");

        $mail->isHTML();
        $mail->Subject = "Verify your email.";
        $mail->Body = "Your otp is {$_SESSION['otp']}.<br>Click <a href='{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}/../verifywithtoken.php?token=$verificationtoken&email={$_SESSION['user_email']}'>here</a> to verify your account.";
    
        $mail->send();
        header("location:verifywithotp.php?success=Mail has been sent.");
    }
    catch(Exception $e)
    {
        header("location:verifywithotp.php?error=Unable to send mail.");
    }
?>