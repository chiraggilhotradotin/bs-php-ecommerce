<?php
include("../includes/connection.php");
include("includes/session.php");
if (isset($_POST['submit'])) {
    if ($_FILES['product_image']['type'] == "image/png" || $_FILES['product_image']['type'] == "image/jpeg") {
        $file = explode(".", $_FILES['product_image']['name']);
        $filename = rand() . time() . rand() . "." . end($file);
        if (move_uploaded_file($_FILES['product_image']['tmp_name'], "../imgs/products/" . $filename)) {
            try {
                $conn->query("INSERT INTO products(product_name, product_slug, product_price, product_description, product_image, product_category_id) VALUES('{$_POST['product_name']}','{$_POST['product_slug']}','{$_POST['product_price']}','{$_POST['product_description']}','$filename','{$_POST['product_category_id']}')");
                $success = "Product successfully added.";
            } catch (mysqli_sql_exception $e) {
                unlink("../imgs/products/" . $filename);
                if (preg_match("/for key 'product_slug'/", $e))
                    $error = "Slug already exists.";
                else
                    $error = "Some error occured.";
            }
        } else {
            $error = "File cannot be uploaded.";
        }
    } else {
        $error = "Wrong filetype. Please upload png or jpg.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="d-flex align-items-center min-vh-100">
        <div class="container-fluid">
            <div class="row">
                <form class="col-md-6 offset-md-3 my-4" method="post" enctype="multipart/form-data">
                    <div class="alert alert-secondary text-center h2">
                        <a href="products.php" class="text-decoration-none text-dark float-start">&lt;</a>Add Product
                    </div>
                    <?php
                    if (isset($success))
                        echo "<div class='alert alert-success'>$success</div>";
                    else if (isset($error))
                        echo "<div class='alert alert-danger'>$error</div>";
                    ?>
                    <div>
                        <label for="product_name">Name</label>
                        <input type="text" name="product_name" id="product_name" class="form-control">
                    </div>
                    <div class="mt-3">
                        <label for="product_slug">Slug</label>
                        <input type="text" name="product_slug" id="product_slug" class="form-control">
                    </div>
                    <div class="mt-3">
                        <label for="product_price">Price</label>
                        <input type="number" name="product_price" id="product_price" class="form-control">
                    </div>
                    <div class="mt-3">
                        <label for="product_category_id">Category</label>
                        <select name="product_category_id" id="product_category_id" class="form-select">
                            <?php
                            $result = $conn->query("SELECT * FROM categories WHERE category_isdeleted=0");
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="product_image">Image</label>
                        <input type="file" name="product_image" id="product_image" class="form-control">
                    </div>
                    <div class="mt-3">
                        <label for="product_description">Description</label>
                        <textarea name="product_description" id="product_description" class="form-control"
                            rows="10"></textarea>
                    </div>
                    <div class="mt-4">
                        <input type="submit" name="submit" value="Add" class="btn btn-primary w-100">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>
</body>

</html>