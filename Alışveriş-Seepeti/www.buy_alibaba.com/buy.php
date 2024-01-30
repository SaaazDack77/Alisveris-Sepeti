<?php
session_start();

require_once 'cartManager.php';
require_once 'products.php';

if (!isset($_SESSION['shoppingCart'])) {
    $_SESSION['shoppingCart'] = [];
}

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
	CartManager::addProductToCart(["name" => $_POST['name'], "price" => round($_POST['price'], 2), "quantity" => 1]);
}

?>
<html>
<head>
<title>Submission</title>

</head>
<body>
<h1></h1>
<div class="d-flex flex-row justify-content-around">
    <div>
    <h3 class="ml-3 mt-3">Below is a list of items you can add to the cart -- Alkin Sahin 200218020</h3>
    <?php
        CartManager::displayProducts($products);
    ?>
    </div>
    <div>
        <a class="btn btn-info ml-3 mt-3" href="viewCart.php">View your Cart</a>
        <a class="btn btn-info ml-3 mt-3" href="buy.php">Refresh Page</a>
        <a class="btn btn-info ml-3 mt-3" href="login.php">login page</a>
        <?php
            echo "<h5>cart has " . CartManager::getCartCount() . " item(s).</h5>";
        ?>
    </div>
</div>
</body>
</html>