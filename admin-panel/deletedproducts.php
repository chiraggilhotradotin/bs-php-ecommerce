<?php
include("../includes/connection.php");
include("includes/session.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deleted Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <?php
    include("includes/navbar.php");
    ?>
    <div class="table-responsive">
        <table class="table">
            <caption class="caption-top text-center h2">Deleted <a class="btn-link" href="products.php">Products</a></caption>
            <tr>
                <th>S. No.</th>
                <th>Name</th>
                <th>Category Name</th>
                <th>Slug</th>
                <th>Price</th>
                <th>Image</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            <?php
            $count = 1;
            $products = $conn->query("SELECT * FROM products INNER JOIN categories ON products.product_category_id=categories.category_id WHERE product_isdeleted=1");
            while ($product = $products->fetch_assoc()) {
                echo "<tr><td>$count</td><td>{$product['product_name']}</td><td>{$product['category_name']}</td><td>{$product['product_slug']}</td><td>{$product['product_price']}</td><td><img src='../imgs/products/{$product['product_image']}' height='100'></td><td>{$product['product_description']}</td><td><a href='undeleteproduct.php?product_id={$product['product_id']}'>Undelete</a></td></tr>";
                $count++;
            }
            ?>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>
</body>

</html>