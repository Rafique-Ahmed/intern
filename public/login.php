<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <?php
require '../config/database.php';

if (PHP_SAPI === 'cli') {
    // Running from the command line
    if ($argc < 3) {
        die("Usage: php login.php <username> <password>\n");
    }
    $username = $argv[1];
    $password = $argv[2];
} else {
    // Running from a web server
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
    } else {
        die("Invalid request method");
    }
}

$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        echo "Login successful!\n";
    } else {
        echo "Invalid password.\n";
    }
} else {
    echo "No user found with that username.\n";
}

$conn->close();
?>

</body>
</html>
