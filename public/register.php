<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Register">
    </form>
    <?php
require '../config/database.php';

if (PHP_SAPI === 'cli') {
    // Running from the command line
    if ($argc < 4) {
        die("Usage: php register.php <username> <email> <password>\n");
    }
    $username = $argv[1];
    $email = $argv[2];
    $password = password_hash($argv[3], PASSWORD_BCRYPT);
} else {
    // Running from a web server
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    } else {
        die("Invalid request method");
    }
}

$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!\n";
} else {
    echo "Error: " . $sql . "\n" . $conn->error;
}

$conn->close();
?>

</body>
</html>
