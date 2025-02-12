<?php
include "db.php";

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM employees WHERE id=$id");
$employee = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $position = $_POST['position'];

    $sql = "UPDATE employees SET name='$name', email='$email', position='$position' WHERE id=$id";

    if ($conn->query($sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
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
    <h2>Edit Employee</h2>
    <a href="index.php">Go Back</a>
    <form method="post">
        <p>
            Name: <input type="text" name="name" value="<?= $employee['name'] ?>" required>
        </p>
        <p>
            Email: <input type="text" name="email" value="<?= $employee['email'] ?>" required>
        </p>
        <p>
            Position: <input type="text" name="position" value="<?= $employee['position'] ?>" required>
        </p>
        <button>Update</button>
    </form>
</body>
</html>
