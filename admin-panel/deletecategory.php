<?php
    include("../includes/connection.php");
    include("includes/session.php");
    if(!isset($_GET['category_id']))
    {
        header("location:categories.php");
        exit;
    }
    $conn->query("UPDATE categories SET category_isdeleted=1 WHERE category_id='{$_GET['category_id']}'");
    header("location:categories.php");
?>