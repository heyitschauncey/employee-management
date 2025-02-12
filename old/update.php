<?php
include "auth.php";
include "db.php";

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM employees WHERE id=$id");
$employee = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $name_err = "Name is required.";
    } else {
        $name = htmlspecialchars($_POST["name"]);
        $name_err = "";
    }


    if (empty($_POST["email"])) {
        $email_err = "Email is required.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $email = htmlspecialchars($_POST["email"]);
        $email_err = "";
    }


    if (empty($_POST["position"])) {
        $position_err = "Position is required.";
    } else {
        $position = htmlspecialchars($_POST["position"]);
        $position_err = "";
    }

    if (empty($name_err) && empty($email_err) && empty($position_err)) {
        $stmt = $conn->prepare("UPDATE employees SET name=?, email=?, position=? WHERE id=$id");
        $stmt->bind_param("sss", $name, $email, $position);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $stmt.error;
        }
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
            <?php if (!empty($email_err)): ?>
            Error: <?= $email_err ?>
            <?php endif; ?>
        </p>
        <p>
            Position: <input type="text" name="position" value="<?= $employee['position'] ?>" required>
        </p>
        <button>Update</button>
    </form>
</body>
</html>
