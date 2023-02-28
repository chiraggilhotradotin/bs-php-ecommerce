<?php
    include("../includes/connection.php");
    include("includes/session.php");
    if(!isset($_GET['product_id']))
    {
        header("location:products.php");
        exit;
    }
    $conn->query("UPDATE products SET product_isdeleted=1 WHERE product_id='{$_GET['product_id']}'");
    header("location:products.php");
?>