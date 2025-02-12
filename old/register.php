<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST["username"]);
    // TODO: What is the default php hashing algo. how do I use bcrypt?
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<h2>Register</h2>
<a href="login.php">login</a>
<form method="post">
    <div>
        <label for="username">Username: </label>
        <input type="text" name="username" id="username" required>
    </div>
    <div>
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" required>
    </div>

    <button>Register</button>
</form>
