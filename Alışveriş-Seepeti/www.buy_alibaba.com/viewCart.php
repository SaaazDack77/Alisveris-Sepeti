<?php
session_start();
require_once 'cartManager.php';
require_once 'products.php';

if (!isset($_SESSION['shoppingCart'])) {
    $_SESSION['shoppingCart'] = [];
}

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
	CartManager::removeProductFromCart($_POST['name']);
}


?>
<html>
<head>
<title>View Cart</title>

</head>
<body class="d-flex flex-row justify-content-center">
    <div class="d-flex flex-column mt-5 mr-5">
        <a class="btn btn-info ml-3 mt-3" href="buy.php">Back To Index</a>
    </div>
    <div class="d-flex flex-column mt-5">
    <h1>Your Cart:</h1>
        <?php
        CartManager::getCartContents();
        ?>
    </div>
    <div class="d-flex flex-column mt-5 ml-5">
        <h1>Cart Quantity: <?php echo CartManager::getCartCount(); ?></h1>
        <h1>Cart Subtotal: $<?php echo CartManager::getCartSubtotal(); ?></h1>
    </div>
</body>
</html>