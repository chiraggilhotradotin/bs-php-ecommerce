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
    <title>Deleted Categories</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<?php
    include("includes/navbar.php");
    ?>
    <div class="table-responsive">
        <table class="table">
            <caption class="h2 text-center caption-top">Deleted <a class="btn-link" href='categories.php'>Categories</a></caption>
            <tr>
                <th>S. No.</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Image</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            <?php
                $count = 1;
                $categories = $conn->query("SELECT * FROM categories WHERE category_isdeleted=1");
                while($category = $categories->fetch_assoc())
                {
                    echo "<tr><td>$count</td><td>{$category['category_name']}</td><td>{$category['category_slug']}</td><td><img height='100' src='../imgs/categories/{$category['category_image']}'></td><td>{$category['category_description']}</td><td><a href='undeletecategory.php?category_id={$category['category_id']}'>Undelete</a></td></tr>";
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