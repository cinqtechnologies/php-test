<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Ecommerce</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-light navbar-expand-md bg-faded justify-content-center mb-3 bg-success">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
                <span class="text-white font-weight-bold">CINQ Backend PHP Test | Ecommerce</span>
            </a>
        </div>
    </nav>
    <div class="container">
        <?php
        $page = $_GET['page'] ?? 'retailerList';
        $page .= '.php';

        require_once($page);
        ?>
    </div>
</body>
</html>