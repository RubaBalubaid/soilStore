<?php

// Create connection
try {
    $dsn = "mysql:host=localhost;dbname=soil_store";
    $username = "root";
    $password = "";

    // Create a new PDO instance
    $pdo = new PDO($dsn, $username, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Function to sanitize input
    function testInput($input)
    {
        $input = trim($input);
        $input = stripslashes($input);
        return $input;
    }

    $message = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if 'name' and 'email' keys are set in $_POST array
        if (!empty($_POST['name']) && !empty($_POST['email'])) {
            $name = testInput($_POST['name']);
            $email = testInput($_POST['email']);

            // Prepare SQL statement to check for the existence of the user
            $sql = "SELECT id FROM users WHERE name = :name AND email = :email";

            // Prepare the SQL statement
            $stmt = $pdo->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            // Execute the statement
            $stmt->execute();

            // Fetch the user ID if the user exists
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // User exists, delete the row from the database
                $userId = $user['id'];

                // Prepare SQL statement to delete the row
                $deleteSql = "DELETE FROM users WHERE id = :id";

                // Prepare the SQL statement
                $deleteStmt = $pdo->prepare($deleteSql);

                // Bind parameters
                $deleteStmt->bindParam(':id', $userId, PDO::PARAM_INT);

                // Execute the statement
                $deleteStmt->execute();

                // Check if any rows were affected
                if ($deleteStmt->rowCount() > 0) {
                    $message = "Account was deleted";
                } else {
                    $message = "Error deleting account";
                }
            } else {
                // User does not exist
                $message = "User does not exist";
            }
        } else {
            $message = "Name and email are required";
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>