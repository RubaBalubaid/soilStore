<?php 
$cclore=$_COOKIE['BGcolor'];
include 'Connection.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>soil store</title>
    <!--Google font-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/chevron-double-down-o.css' rel='stylesheet'>

    <link rel="stylesheet" href="all.min.css">
    <link rel="stylesheet" href="styleShahd.css">
    <script>

        function toggleAside() {
            var aside = document.getElementById("myAside");
            var icon = document.querySelector(".toggle-icon i");

            if (aside.style.display === "none")
                aside.style.display = "block";

            else
                aside.style.display = "none";


        }
        function displayData(event) {
            event.preventDefault(); // Prevent form submission and page refresh

            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var message = document.getElementById("message").value;

            var displayArea = document.getElementById("display-area");
            displayArea.innerHTML = "Name: " + name + "<br><br>Email: " + email + "<br><br>Message: " + message;

            // Clear form fields
            document.getElementById("name").value = "";
            document.getElementById("email").value = "";
            document.getElementById("message").value = "";
        }

        window.addEventListener('DOMContentLoaded', function () {
            var myAside = document.getElementById('myAside');
            myAside.style.display = 'none';
        });
    </script>
    <script src="purchase.js" async></script>


</head>

<body style="background-color:<?php echo $cclore; ?>">

    <header class="header1">
        <div class="container2">
            <h1>Soil Store</h1>
            <nav class="nav1">
                <ul>
                    <li><a href="Home.php">Home</a></li>
                    <li class="dropdown">
                        <a href="#">Plants</a>
                        <ul>
                            <li><a href="indoor.php">Indoor Plants</a></li>
                            <li><a href="OutDoorProduct.php">Outdoor Plants</a></li>
                            <li><a href="aromatic.php">Aromatic Plants</a></li>
                            <li><a href="takeCare.php">Plant care</a></li>
                        </ul>

                    <li><a href="giftr2.php">Gifts</a></li>
                    <li><a href="ShowYourProduct.php">Show Your Products</a></li>
                    <li><a href="php/AboutUs.php">My profile</a></li>
                    <li><a href="#" class="cart-icon"><img src="https://image.pngaaa.com/58/293058-middle.png"
                                width="50" height="25"></a>
                    </li>
                    <li class="dropdown2">
                        <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/8801/8801434.png" width="30"
                                height="25"></a>
                        <ul>
                            <li><a href="signUp.php">Sign Up</a></li>
                            <li><a href="login.html">Log In</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container4">
        <div class="toggle-icon" onclick="toggleAside()">

            <p> <img src="down-arrow.png"> Tell us about your opinion </p>



        </div>
        <aside id="myAside">

            <form onsubmit="displayData(event)">
                <label for="name">Name:</label>
                <input type="text" id="name">

                <label for="email">Email:</label>
                <input type="email" id="email">

                <label for="message">Message:</label>
                <textarea id="message" rows="4" cols="50"></textarea>

                <button type="submit" class="button">Submit</button>


                <div id="display-area"> </div>
        </aside>
    </div>



    <header class="container3">
        <img src="header4.webp">
    </header>
    <hr>

    <nav>
        <ul class="navbar">
            <li class="nav-item"><a href="OutDoorProduct.php">outdoor</a></li>
            <li class="nav-item"><a href="indoor.php">Indoor</a></li>
            <li class="nav-item"><a href="aromatic.php">Aromatic</a></li>

        </ul>
    </nav>

   
    <div class="container">
        <?php
       if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_to_cart"])) {
        // Sanitize input to prevent SQL injection
        $product_id = mysqli_real_escape_string($link, $_GET["id"]);
        $user_id = mysqli_real_escape_string($link, $_SESSION["user_id"]);
        $quantity = mysqli_real_escape_string($link, $_POST["quantity"]);
    
        // Check if the shopping cart session is set for the user
        if (isset($_SESSION["shopping_cart"][$user_id])) {
            $item_array_id = array_column($_SESSION["shopping_cart"][$user_id], "item_id");
    
            // Check if the product is not already in the cart
            if (!in_array($product_id, $item_array_id)) {
                // Add the item to the shopping cart session
                array_push($_SESSION["shopping_cart"][$user_id], [
                    'item_id' => $product_id,
                    'item_name' => $_POST["hidden_name"],
                    'item_price' => $_POST["hidden_price"],
                    'item_quantity' => $quantity,
                    'image1_path' => $_POST["image1_path"]
                ]);
    
                // Insert the item into the database cart table
                $insert_query = "INSERT INTO carts (user_id, plant_id, quantity) VALUES ($user_id, $product_id, $quantity)";
                $insert_result = mysqli_query($link, $insert_query);
    
                if ($insert_result) {
                    echo "Item added to the cart successfully.";
                } else {
                    echo "Error adding item to the cart: " . mysqli_error($link);
                }
            } else {
                // Product is already in the cart
                echo '<script>alert("Item Already Added")</script>';
            }
        } else {
            // Shopping cart session is not set for the user, create it
            $_SESSION["shopping_cart"][$user_id] = [
                [
                    'item_id' => $product_id,
                    'item_name' => $_POST["hidden_name"],
                    'item_price' => $_POST["hidden_price"],
                    'item_quantity' => $quantity,
                    'image1_path' => $_POST["image1_path"]
                ]
            ];
    
        }
    }
       
        $sql = "SELECT * FROM `plant`.`plants` WHERE category = 'aromatic'";
        $result = mysqli_query($link, $sql);

             if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="box">';
                        echo '<div class="ui-card">';
                        echo '<img src="' . $row["image1_path"] . '">';
                        echo '<div class="description">';
                        echo '<h3>' . $row["name"] . '</h3>';
                        echo '<p>' . $row["description"] . '</p>';
                        echo '<p>' . $row["price"] . ' SR</p>';
                        echo '<form method="post" action="aromatic.php?action=add&id=' . $row["plant_id"] . '">';
                        echo '<input type="hidden" name="hidden_name" value="' . $row["name"] . '" />';
                        echo '<input type="hidden" name="hidden_price" value="' . $row["price"] . '" />';
                        echo '<input type="hidden" name="hidden_id" value="' . $row["plant_id"] . '" />'; // Add this line
                        echo '<input type="hidden" name="image1_path" value="' . $row["image1_path"] . '" />';
                        echo '<input type="number" name="quantity" value="1" />';
                        echo '<input type="submit" name="add_to_cart" class="btn-buy" value="Add to Cart" />';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "Query failed: " . mysqli_error($link);
                }
        
                ?>
 </div>
    <footer>
        <p>&copy;2023 soil store. All rights reserved.</p>
    </footer>
    <!------------------------------------CART--------------------------------------->
    <main>
    <?php
    echo generateCart($_SESSION["shopping_cart"],'aromatic.php');
    ?>
<main>
</body>

</html>