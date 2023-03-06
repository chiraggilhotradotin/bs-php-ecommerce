<?php
include("includes/connection.php");
$result = $conn->query("SELECT * FROM users WHERE user_email='{$_GET['email']}'");
if($result->num_rows == 0)
{
    header("location:signup.php");
    exit;
}
$row = $result->fetch_assoc();
try {
    if ($_GET['token'] == $row['user_verificationtoken']) {
        $conn->query("UPDATE users SET user_isverified=1, user_verificationtoken=NULL WHERE user_id='{$row['user_id']}'");
        header("location:signin.php?success=Email verified successfully.");
    } else
        echo "Wrong token.";
} catch (mysqli_sql_exception $e) {
    echo "Wrong token.";
}
?>