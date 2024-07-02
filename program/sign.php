<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "soil_store";

try {
    // Create database if it doesn't exist
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $createDbSql = "CREATE DATABASE IF NOT EXISTS $databaseName";
    $conn->exec($createDbSql);

    // Connect to the database
    $conn = new PDO("mysql:host=$servername;dbname=$databaseName", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create users table if it doesn't exist
    $createTableSql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) PRIMARY KEY,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL
    )";
    $conn->exec($createTableSql);

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // REGISTER
        if (isset($_POST["register"])) {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirmPassword = $_POST["confirm-password"];

            // Validate data
            if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
                echo '<script>alert("Please fill in all fields.");</script>';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo '<script>alert("Invalid email address.");</script>';
            } elseif (strlen($password) < 3 || strlen($password) > 10) {
                echo '<script>alert("Password must be between 3 and 10 characters.");</script>';
            } elseif ($password !== $confirmPassword) {
                echo '<script>alert("Password confirmation does not match.");</script>';
            } else {
                // Check if email already exists
                $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($existingUser) {
                    echo '<script>alert("Email address is already use.");</script>';
                    echo '<script>window.location.href = "../login.html";</script>';
                    exit();
                } else {
                    // Save user data to the database
                    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':password', $password);
                    $stmt->execute();

                    // Start a session and set session variables
                    $_SESSION['id'] = $conn->lastInsertId();
                    $_SESSION['username'] = $name;

                    // Set a cookie to remember user's login state
                    setcookie('id', $_SESSION['id'], time() + (86400 * 30), "/"); // Cookie expires in 30 days
                    setcookie('username', $name, time() + (86400 * 30), "/"); // Cookie expires in 30 days

                    echo '<script>alert("Registration successful!");</script>';
                    // Redirect to home page after successful registration
                    echo '<script>window.location.href = "../Home.html";</script>';
                    exit(); // Exit to prevent further execution
                }
            }
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
