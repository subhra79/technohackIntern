<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>User Login</h2>
    <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        
        <input type="submit" name="login" value="Login">
    </form>
</body>
</html>
<?php
session_start();

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

if (isset($_POST['login'])) {
    $login_username = $_POST['username'];
    $login_password = $_POST['password'];

    // You should add validation and hashing for the password before comparing it to the database.

    $login_sql = "SELECT * FROM users WHERE username = '$login_username' AND password = '$login_password'";
    $login_result = $conn->query($login_sql);

    if ($login_result->num_rows == 1) {
        $user_data = $login_result->fetch_assoc();
        $_SESSION['username'] = $user_data['username'];
        header("Location: welcome.php"); // Redirect to a welcome page
    } else {
        echo "Login failed. Invalid username or password.";
    }
}

$conn->close();
?>
