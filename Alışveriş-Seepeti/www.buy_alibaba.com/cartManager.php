<?php

class CartManager {

    public static function displayProducts($newArray) {
        foreach($newArray as $product) {
            $name = $product['name'];
            $price = $product['price'];
            echo "<div class='border border-info rounded m-1'>";
            echo "<form method='POST' action='buy.php'>";
            echo "<h4>Name: $name</h4><input name='name' value='$name' style='display:none;'>";
            echo "<h5>Price: $$price</h5><input name='price' value='$price' style='display:none;'>";
            echo "<input class='btn btn-info' type='submit'>";
            echo "</form>";
            echo "</div>";
        }
    }

    public static function addProductToCart ($newProduct) {
        $newProductName = $newProduct['name'];
        if (!self::checkIfProductExists($newProductName)) {
            array_push($_SESSION['shoppingCart'], $newProduct);
        }
        else {
            foreach($_SESSION['shoppingCart'] as $key => $product) {
                if ($product['name'] == $newProductName) {
                    $_SESSION['shoppingCart'][$key]['quantity']++;
                }
            }
        }
    }

    public static function removeProductFromCart ($newProductName) {
        foreach($_SESSION['shoppingCart'] as $key => $product) {
            if ($product['name'] == $newProductName && $product['quantity'] > 1) {
                $_SESSION['shoppingCart'][$key]['quantity']--;
            }
            else if ($product['name'] == $newProductName && $product['quantity'] == 1) {
                unset($_SESSION['shoppingCart'][$key]);
            }
        }
    }

    public static function getCartCount() {
        $count = 0;
        foreach($_SESSION['shoppingCart'] as $product) {
            $count = $count + $product['quantity'];
        }
        return $count;
    }

    public static function getCartSubtotal() {
        $subtotal = 0;
        foreach($_SESSION['shoppingCart'] as $product) {
            $subtotal = $subtotal + ($product['price'] * $product['quantity']);
        }
        return $subtotal;
    }

    public static function getCartContents() {
        if (count($_SESSION['shoppingCart']) < 1) {
            echo "<h2>Nothing in cart. :(</h2>";
        }
        else {
            foreach($_SESSION['shoppingCart'] as $product) {
                $name = strval($product['name']);
                $price = strval($product['price']);
                $quantity = strval($product['quantity']);
                $total = $price * $quantity;
                echo "<div class='border border-info rounded'>";
                echo "<form method='POST' action='viewCart.php'>";
                echo "<h5>Name: $name</h5>";
                echo "<input name='name' value='$name' style='display:none;'>";
                echo "<h5>Price: $$total</h5>";
                echo "<h5>Quantity: $quantity</h5>";
                echo "<input class='btn btn-info' type='submit' value='Remove Product'>";
                echo "</form>";
                echo "</div>";
            }
        }
    }

    private static function checkIfProductExists($newProductName) {
        foreach($_SESSION['shoppingCart'] as $product) {
            if ($newProductName == $product['name']) {
                return true;
            }
        }
    }
}

?>