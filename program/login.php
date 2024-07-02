<?php
session_start();

// Database configuration for XAMPP
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "soil_store"; // Replace with your actual database name

try {
    // Create a PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // LOGIN
        if (isset($_POST["login"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            
            // Validate data
            // Add more validation rules as needed
            if (empty($username) || empty($password)) {
                echo '<script>alert("Please fill in all fields.");</script>';
            } else {
                // Check if user is registered
                $stmt = $conn->prepare("SELECT * FROM users WHERE name = :username AND password = :password");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);
                $stmt->execute();

                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    // Start a session and set session variables
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['username'] = $user['name'];

                    // Set a cookie to remember user's login state
                    setcookie('id', $user['id'], time() + (86400 * 30), "/"); // Cookie expires in 30 days
                    setcookie('username', $user['name'], time() + (86400 * 30), "/"); // Cookie expires in 30 days

                    echo '<script>';
                    echo 'alert("Login successful!");';
                    echo 'window.location.href = "../Home.html";';
                    echo '</script>';
                    exit();
                } else {
                    echo '<script>';
                    echo 'alert("Incorrect username or password.");';
                    echo 'window.location.href = "../login.html";';
                    echo '</script>';
                    exit();
                }
            }
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

?>
