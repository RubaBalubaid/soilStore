<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    

    <!--Google font-->
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">

     <!-- css style -->
     <style>
     * {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
}

.container {
	max-width: 1200px;
	margin: 0 auto;
	padding: 45px;
}

header {
	background-color: white;
	padding: 10px;
	box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
}

header h1 {
	font-size: 40px;
	font-family: "Sofia", sans-serif;
	text-shadow: 3px 3px 3px #ababab;
	color: #416d3e;
	float: left;
}

nav {
	float: right;
}

nav ul {
	list-style: none;
}

nav ul li {
	float: left;
	margin-left: 20px;
}

nav ul li a {
	display: block;
	padding: 10px;
	font-size: 18px;
	font-family: "Trirong", serif;
	color: #333;
	text-decoration: none;
	transition: all 0.3sease;
}

nav ul li a:hover {
	background-color: #416d3e;
	color: white;
}

nav ul li:nth-child(7) a, nav ul li:nth-child(8) a {
	background-color: white;
}


 nav .dropdown:hover ul {
  display: block;
}

nav .dropdown ul {
  display: none;
  position: absolute;
  background-color: #fff;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
  padding: 10px;
}

 nav .dropdown ul li {
  display: block;
  margin: 10px 0;
}

nav .dropdown ul li a {
  display: block;
  color: #333;
  text-decoration: none;
  padding: 5px 10px 0;
}

 nav .dropdown ul li a:hover {
  display: block;
	background-color: #416d3e;
	color: white;
  text-decoration: none;
  padding: 5px 10px 0;
}


 nav .dropdown2:hover ul {
  display: block;
}

nav .dropdown2 ul {
  display: none;
  position: absolute;
  background-color: #fff;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
  padding: 10px;
}

 nav .dropdown2 ul li {
  display: block;
  margin: 10px 0;
}

nav .dropdown2 ul li a {
  display: block;
  color: #333;
  text-decoration: none;
  padding: 5px 10px 0;
}

 nav .dropdown2 ul li a:hover {
  display: block;
	background-color: #416d3e;
	color: white;
  text-decoration: none;
  padding: 5px 10px 0;
}

main {
	position: relative;
}

.whychooseus {
  color: #60a05b;
   box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
   padding: 20px;
   text-align: center;
   margin-top: 60px;
   margin-left: 60px;
   width: 800px;
}

  img {
  float: right;
}

.whychooseus p {
	font-family: "Trirong", serif;
	  font-weight: bold;
	padding: 10px;
}

.whychooseus h2 {
	font-family: "Cursive", Lucida Handwriting;
	font-size: 25px;
	text-shadow: 3px 3px 3px #ababab;
}

 th{
 	padding-top: 30px;
  padding-left: 100px;
  padding-right: 100px;
}

 td{
  text-align: center;
	font-family: "Cursive", Lucida Handwriting;
text-shadow: 3px 3px 3px #ababab;
}

form {
	padding: 50px;
}

fieldset{
	font-family: "Cursive", Lucida Handwriting;
  padding: 10px;
  font-size: 18px;
  text-shadow: 3px 3px 3px #ababab;
  background-color: white;
  width: 1000px;
  border: 1px dashed #60a05b;
  margin: 0 auto;
  bottom: 0;

  color: #60a05b;
}
button[type="submit"] {
    font-family: "Cursive", Lucida Handwriting;
    font-size: 18px;
    background-color: #60a05b;
    border: 1px dashed #60a05b;
    color: white;
    padding: 10px 20px;
    cursor: pointer;
    text-shadow: 3px 3px 3px #ababab;
}

form fieldset label {
	padding: 10px;
}

form fieldset input[type="text"],
form fieldset input[type="email"],
form fieldset textarea {
width: 100%;
padding: 8px;
border: 1px solid #60a05b;
margin-bottom: 10px;
font-size: 16px;
}

form fieldset input[type="submit"] {
font-family: "Cursive", Lucida Handwriting;
background-color: #60a05b;
color: white;
border: none;
padding: 10px 20px;
border-radius: 4px;
cursor: pointer;
font-size: 15px;
}

form fieldset input[type="submit"]:hover {
background-color: #92bf8f;
}

.rateForm {
	text-align: center;
}

footer {
	background-color: #416d3e;
	color: white;
	padding: 10px;
	text-align: center;
	z-index: 1;
	position: fixed;
	bottom: 0;
	left: 0;
	right: 0;
	box-shadow: inset 0 5px 5px -5px rgba(0, 0, 0, 0.2);
}

footer p {
	font-size: 14px;
	line-height: 1.5;
}
/* Cart Styles */
.cart {
	position: fixed;
	top: 0;
	right: -100%;
	width: 360px;
	min-height: 100vh;
	padding: 20px;
	background: white;
	box-shadow: -2px 0 4px hsl(0 4% 15% / 10%);
	transition: 0.3s;
  }
  
  .cart.active {
	right: 0;
  }
  
  .cart-title {
	text-align: center;
	font-size: 1.5rem;
	font-weight: 600;
	margin: 2rem;
  }
  
  .cart-box {
	display: grid;
	grid-template-columns: 32% 50% 18%;
	align-items: center;
	gap: 1rem;
	margin-top: 1rem;
	row-gap: 0.5rem;
  }
  
  .cart-img {
	width: 100px;
	height: 100px;
	object-fit: contain;
	padding: 10px;
  }
  
  .cart-quantity {
	border: 1px solid #60a05b;
	outline-color: #60a05b;
	width: 2.4rem;
	text-align: center;
	font-size: 1rem;
  }
  
  .price {
	font-weight: 500;
  }
  
  .crat-remove {
	font-size: 24px;
	color: #60a05b;
	cursor: pointer;
  }
  
  .total {
	display: flex;
	justify-content: flex-end;
	margin-top: 1.5rem;
	border-top: 1px solid var(--text-color--);
  }
  
  .total-title {
	font-size: 1rem;
	font-weight: 600;
	border-top: 1.5px solid black;
	padding: 5px 0px;
  }
  
  .total-price {
	margin-left: 0.5rem;
  }
  
  .btn-buy {
	display: flex;
	margin: 1.5rem auto 0 auto;
	padding: 12px 20px;
	border: none;
	background: #60a05b;
	color: var(--bg-color);
	font-size: 1rem;
	font-weight: 500;
	cursor: pointer;
  }
  
  .btn-buy:hover {
	background: #c4dcc3;
  }
  
  .close-cart {
	position: absolute;
	top: 1rem;
	right: 0.8rem;
	font-size: 2rem;
	cursor: pointer;
  }
  
  .cart-product-title {
	font-size: 1rem;
	text-transform: uppercase;
  }
  
  .detail-box {
	display: grid;
	row-gap: 0.5rem;
  } </style>
    <!-- JavaScript to redirect after form submission -->
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete your account?');
        }
    </script>

</head>
<body>
    <header>
        <div class="container">
            <h1>Soil Store</h1>
            <nav>
                <ul>
                    <li><a href="Home.html">Home</a></li>
                    <li class="dropdown">
                        <a href="#">Plants</a>
                    <li><a href="vases.html">Vases</a></li>
                    <li><a href="giftr2.html">Gifts</a></li>
                    <li><a href="ShowYourProduct.html">Show my product</a></li>
                    <li><a href="php/AboutUs.php">My profile</a></li>
                    <li><a href="#" class="cart-icon" ><img src="https://image.pngaaa.com/58/293058-middle.png" width="50" height="25"></a>
                    </li>
                    <li class="dropdown2">
                        <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/8801/8801434.png" width="30"
                                height="25"></a>
                        <ul>
                            <li><a href="sign.html">Sign Up</a></li>
                            <li><a href="login.html">Log In</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
    <div class="user-profile-container">
    <?php if (!empty($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <fieldset class="Feedback">
            <legend>My Account</legend>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            <button type="submit"> Delete</button>
        </fieldset>
    </form>
</div>

        <?php 
        
         $message = "";

         if ($_SERVER["REQUEST_METHOD"] == "POST") {
             include_once 'saveProduct.php';
        }
        ?> 
	
    </div>
                </fieldset>
            </form>
        </div>           
    </main>
    <footer>
        <p>&copy;2023 Soil Store. All rights reserved.</p>
    </footer>
</body>
</html>


