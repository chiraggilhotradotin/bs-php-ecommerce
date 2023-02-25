<?php
session_start();
try {
    $conn = new mysqli("localhost", "root", "", "ecommerce");
} catch (mysqli_sql_exception $e) {
    echo "Error in database connectivity";
    exit;
}
?>