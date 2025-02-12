<?php
include "db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // TODO: What is htmlspecialchars()
    $username = htmlspecialchars($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashed_password);

    if ($stmt->fetch() && password_verify($password, $hashed_password)) {
        $_SESSION["user_id"] = $id;
        $_SESSION["username"] = $username;
        header("Location: index.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }
}
?>

<h2>Login</h2>
<a href="register.php">register</a>
<form method="post">
    <div>
        <label for="username">Username: </label>
        <input type="text" name="username" id="username" required>
    </div>
    <div>
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" required>
    </div>

    <button>Login</button>
</form>
