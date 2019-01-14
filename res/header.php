<!DOCTYPE html>
<?php 
    require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
?>
<html>
<head>
    <title>Ecommerce sample app</title>
    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <link href="<?php echo $root_url; ?>/media/css/main.css" rel="stylesheet">
</head>
<body>

<nav class="menu">
    <a href="<?php echo $root_url; ?>/index.php">HOME</a> | 
    <a href="<?php echo $root_url; ?>/controller/products/list_products.php">PRODUCTS</a> | 
    <a href="<?php echo $root_url; ?>/controller/retailers/list_retailers.php">RETAILERS</a>
</nav>

<hr>
