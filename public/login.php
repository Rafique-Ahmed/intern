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
session_start(); // Start the session
require '../config/database.php';

function login($username, $password, $conn) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            // Redirect to welcome.php
            header("Location: welcome.php");
            exit();
        } else {
            echo "Invalid password.\n";
        }
    } else {
        echo "No user found with that username.\n";
    }
    $stmt->close();
}

if (PHP_SAPI === 'cli') {
    // Running from the command line
    if ($argc < 3) {
        die("Usage: php login.php <username> <password>\n");
    }
    $username = $argv[1];
    $password = $argv[2];
    login($username, $password, $conn);
} else {
    // Running from a web server
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        login($username, $password, $conn);
    } else {
        die("Invalid request method");
    }
}

$conn->close();
?>
</body>
</html>
