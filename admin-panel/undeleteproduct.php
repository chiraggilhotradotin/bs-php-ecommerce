<?php
    include("../includes/connection.php");
    include("includes/session.php");
    if(!isset($_GET['product_id']))
    {
        header("location:deletedproducts.php");
        exit;
    }
    $conn->query("UPDATE products SET product_isdeleted=0 WHERE product_id='{$_GET['product_id']}'");
    header("location:deletedproducts.php");
?>