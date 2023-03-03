<?php
include("../includes/connection.php");
include("includes/session.php");
if (isset($_POST['submit'])) {
    if ($_FILES['category_image']['type'] == "image/png" || $_FILES['category_image']['type'] == "image/jpeg") {
        $file = explode(".", $_FILES['category_image']['name']);
        $filename = rand() . time() . rand() . "." . end($file);
        if (move_uploaded_file($_FILES['category_image']['tmp_name'], "../imgs/categories/" . $filename)) {
            try {
                $conn->query("INSERT INTO categories(category_name,category_slug,category_image,category_description) VALUES('{$_POST['category_name']}','{$_POST['category_slug']}','$filename','{$_POST['category_description']}')");
                $success = "Category successfully added.";
            } catch (mysqli_sql_exception $e) {
                unlink("../imgs/categories/" . $filename);
                if (preg_match("/for key 'category_slug'/", $e))
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
    <title>Add Category</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
<?php
    include("includes/navbar.php");
    ?>
    <div class="container-fluid my-5">
        <div class="row">
            <form class="col-md-6 offset-md-3" enctype="multipart/form-data" method="post">
                <div class="alert alert-secondary h2 text-center">
                    <a href="categories.php" class="text-decoration-none text-dark float-start">&lt;</a>Add Category
                </div>
                <?php
                if (isset($success))
                    echo "<div class='alert alert-success'>$success</div>";
                else if (isset($error))
                    echo "<div class='alert alert-danger'>$error</div>";
                ?>
                <div>
                    <label for="category_name">Name</label>
                    <input type="text" name="category_name" id="category_name" class="form-control" required>
                </div>
                <div class="mt-3">
                    <label for="category_slug">Slug</label>
                    <input type="text" name="category_slug" id="category_slug" class="form-control" required>
                </div>
                <div class="mt-3">
                    <label for="category_image">Image</label>
                    <input type="file" name="category_image" id="category_image" class="form-control" required>
                </div>
                <div class="mt-3">
                    <label for="category_description">Description</label>
                    <textarea name="category_description" id="category_description" class="form-control"
                        rows="5" required></textarea>
                </div>
                <div class="mt-4">
                    <input type="submit" name="submit" class="btn btn-primary w-100" value="Add">
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>
</body>

</html>