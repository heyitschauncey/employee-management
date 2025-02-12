<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $position = $_POST['position'];

    $sql = "INSERT INTO employees (name, email, position) VALUES ('$name', '$email', '$position')";
    if ($conn->query($sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn.error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Add Employee</title>
</head>
<body>
    <h2>Add Employee</h2>
    <a href="index.php">Go Back</a>
    <form method="post">
        <p>
            Name: <input type="text" name="name" required>
        </p>
        <p>
            Email: <input type="text" name="email" required>
        </p>
        <p>
            Position: <input type="text" name="position" required>
        </p>
        <button>Add</button>
    </form>
</body>
</html>
