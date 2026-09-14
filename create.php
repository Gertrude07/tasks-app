<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $status = $_POST["status"];

    $stmt = $conn->prepare("INSERT INTO tasks (title, description, status) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $description, $status);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add a task</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrap">
    <h2>Add a task</h2>
    <form method="POST" action="create.php">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description</label>
        <textarea id="description" name="description"></textarea>

        <label for="status">Status</label>
        <select id="status" name="status">
            <option value="pending">Pending</option>
            <option value="in_progress">In progress</option>
            <option value="done">Done</option>
        </select>

        <button type="submit">Save task</button>
    </form>
    <a class="back" href="index.php">Back to tasks</a>
</div>
</body>
</html>
