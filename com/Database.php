<?php
// Establish a database connection (replace with actual database details)
$host = 'localhost';
$db_name = 'your_db_name';
$db_user = 'your_db_user';
$db_password = 'your_db_password';

try {
    $db = new PDO("mysql:host=$host;dbname=$db_name", $db_user, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate user input
    if (empty($username) || empty($password)) {
        header("Location: login.html?error=empty_fields");
        exit();
    } else {
        // Check user credentials in the database
        $query = "SELECT * FROM users WHERE username = :username AND password = :password";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            // Successful login
            session_start();
            $_SESSION["username"] = $username;
            header("Location: dashboard.php");
        } else {
            // Invalid credentials
            header("Location: login.html?error=invalid_credentials");
            exit();
        }
    }
}
?>
Database.php