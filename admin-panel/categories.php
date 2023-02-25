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
    <title>Categories</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="table-responsive">
        <table class="table">
            <caption class="h2 text-center caption-top">Categories <a href="addcategory.php" class="btn btn-secondary">+</a></caption>
            <tr>
                <th>S. No.</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Image</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            <?php
                $result = $conn->query("SELECT * FROM categories WHERE category_isdeleted=0");
                $count = 1;
                while($row = $result->fetch_assoc())
                {
                    echo "<tr><td>$count</td><td>{$row['category_name']}</td><td>{$row['category_slug']}</td><td><img height='50' src='../imgs/categories/{$row['category_image']}'></td><td>{$row['category_description']}</td><td><a href='editcategory.php?category_id={$row['category_id']}'>Edit</a> | <a href='deletecategory.php?category_id={$row['category_id']}' onclick='return confirm(\"Do you really want to delete this category?\");'>Delete</a></td></tr>";
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