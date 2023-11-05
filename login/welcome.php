<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    session_start();
    if (isset($_SESSION['username'])) {
        $logged_in_username = $_SESSION['username'];
        echo "<h1 style='color: white;'>Hello, " . $logged_in_username . "! You have successfully logged in.</h1>";
        echo "<p><a href='index.php' style='color: #61dafb;'>Return to Registration Page</a></p>";
    } else {
        header("Location: login.php"); // Redirect to the login page if not logged in
    }
    ?>
</body>
</html>
