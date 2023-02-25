<?php
    if(!isset($_SESSION['admin_id']))
    {
        header("location:signin.php");
        exit;
    }
?>