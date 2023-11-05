<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>User Registration</h2>
    <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>
        
        <input type="submit" name="register" value="Register">
    </form>

    
</body>
</html>

<?php
session_start(); // Start a new session or resume the existing session

// Replace with your database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pro";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // You should add validation and hashing for the password before storing it in the database.

    // Check if the username already exists
    $check_sql = "SELECT username FROM users WHERE username = '$username'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "Username already exists. Please choose a different username.";
    } else {
        // Username is not found; proceed with registration
        $insert_sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";

        if ($conn->query($insert_sql) === TRUE) {
            $_SESSION['username'] = $username; // Create a session for the registered user
            header("Location: welcome.php"); // Redirect to a welcome page or another appropriate destination
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>

