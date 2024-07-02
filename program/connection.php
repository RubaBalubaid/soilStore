<?php 

$link = mysqli_connect("localhost","root","","plant");

// if($link === false)
//     die("Error connection".mysqli_connect_error());
// else 
//     echo "Successfully connection".mysqli_get_host_info($link);

// Include database connection

session_start();

if (isset($_POST["add_to_cart"])) {
    // Get product details from the form
    $product_id = $_GET["id"];
    $product_name = $_POST["hidden_name"];
    $product_price = $_POST["hidden_price"];
    $product_quantity = $_POST["quantity"];
    $product_image = $_POST["image1_path"];

    // Create an array with product details
    $item_array = array(
        'item_id' => $product_id,
        'item_name' => $product_name,
        'item_price' => $product_price,
        'item_quantity' => $product_quantity,
        'image1_path' => $product_image
    );

    if (isset($_SESSION["shopping_cart"])) {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
    
        // Check if the product is not already in the cart
        if (!in_array($product_id, $item_array_id)) {
            array_push($_SESSION["shopping_cart"], $item_array);
        } else {
            // Product is already in the cart
            echo '<script>alert("Item Already Added")</script>';
        }
    } else {
        // Shopping cart session is not set, create it
        $_SESSION["shopping_cart"][] = $item_array;
    }
}
    
if (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["id"])) {
    $item_id = $_GET["id"];

    foreach ($_SESSION["shopping_cart"] as $key => $value) {
        // Check if "item_id" key exists before accessing it
        if (isset($value["item_id"]) && $value["item_id"] == $item_id) {
            unset($_SESSION["shopping_cart"][$key]);
            echo '<script>alert("Item Removed")</script>';
            // Add additional debug information
            echo '<pre>';
            echo '</pre>';
        }
    }
}
// Check if 'action' is set (for removing items from the cart)
if (isset($_SESSION['user_id'])) {
    // The user_id is set, perform your actions here

    if (isset($_GET["action"]) && $_GET["action"] == "delete") {
        $user_id = $_SESSION["user_id"];
        $product_id = $_GET["id"];

        // Remove the item from the session shopping cart
        foreach ($_SESSION["shopping_cart"][$user_id] as $key => $value) {
            if ($value["item_id"] == $product_id) {
                unset($_SESSION["shopping_cart"][$user_id][$key]);

                // Optionally, you may reindex the array after unset
                $_SESSION["shopping_cart"][$user_id] = array_values($_SESSION["shopping_cart"][$user_id]);

                // Remove the item from the database cart table
                $delete_query = "DELETE FROM carts WHERE user_id = $user_id AND plant_id = $product_id";
                $delete_result = mysqli_query($link, $delete_query);
            }
        }
    }
} else {
    echo "User ID not set in the session.";
}



        function generateCart($shoppingCart, $currentPage) {
            $cart = '<div class="cart">';
            $cart .= '<h2 class="cart-title">Your Cart</h2>';
        
            // Check if $shoppingCart is an array and not empty
            if (is_array($shoppingCart) && !empty($shoppingCart)) {
                $total = 0;
        
                foreach ($shoppingCart as $key => $value) {
                    $cart .= '<div class="product">';
                    $cart .= '<div class="cart-box">';
        
                    if (isset($value["image1_path"])) {
                        $cart .= '<img src="' . $value["image1_path"] . '" class="cart-img">';
                    // } else {
                    //     $cart .= '<img src="placeholder-image.jpg" class="cart-img">';
                    }
        
                    $cart .= '<div class="detail-box">';
                    
                    // Check if keys exist before using them
                    $cart .= isset($value["item_name"]) ? '<p class="cart-product-title">' . $value["item_name"] . '</p>' : '';
                    $cart .= isset($value["item_price"]) ? '<h6 class="product-price">' . $value["item_price"] . ' SR</h6>' : '';
                    $cart .= isset($value["item_quantity"]) ? '<input type="number" value="' . $value["item_quantity"] . '" class="cart-quantity">' : '';
                    
                    $cart .= '</div>';
                    $cart .= '<div>';
                    
                    // Check if keys exist before using them
                    $cart .= isset($value["item_id"]) ? '<a href="' . $currentPage . '?action=delete&id=' . $value["item_id"] . '" class="crat-remove">' : '';
                    $cart .= isset($value["item_id"]) ? '<img src="bxs-trash.svg" class="crat-remove">' : '';
                    $cart .= isset($value["item_id"]) ? '</a>' : '';
                    
                    $cart .= '</div>';
                    $cart .= '</div>';
                    $cart .= '</div>';
                    $total = $total + (isset($value["item_quantity"]) && isset($value["item_price"]) ? ($value["item_quantity"] * $value["item_price"]) : 0);
                }
        
                $cart .= '<div class="total">';
                $cart .= '<div class="total-title">Total</div>';
                $cart .= '<div class="total-price">'. number_format($total, 2) . 'SR'.'</div>';
                $cart .= '</div>';
                $cart .= '<button type="button" class="btn-buy" onclick="displayThankYouAndTotal(' . $total . ')">Buy Now</button>';
                $cart .= '<img src="bx-x (1).svg" class="close-cart" onclick="displayThankYouAndTotal(' . $total . ')">';
            }
        
            $cart .= '</div>';
            $cart .= '</main>';
        
            return $cart;
        }      
?>
