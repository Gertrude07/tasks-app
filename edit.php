<?php
require "db.php";

$id = intval($_GET["id"] ?? 0);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $status = $_POST["status"];
    $post_id = intval($_POST["id"]);

    $stmt = $conn->prepare("UPDATE tasks SET title=?, description=?, status=? WHERE id=?");
    $stmt->bind_param("sssi", $title, $description, $status, $post_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: index.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM tasks WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$task = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$task) { die("Task not found."); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit task</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrap">
    <h2>Edit task</h2>
    <form method="POST" action="edit.php">
        <input type="hidden" name="id" value="<?php echo $task['id']; ?>">

        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>

        <label for="description">Description</label>
        <textarea id="description" name="description"><?php echo htmlspecialchars($task['description']); ?></textarea>

        <label for="status">Status</label>
        <select id="status" name="status">
            <option value="pending" <?php echo $task['status']==='pending'?'selected':''; ?>>Pending</option>
            <option value="in_progress" <?php echo $task['status']==='in_progress'?'selected':''; ?>>In progress</option>
            <option value="done" <?php echo $task['status']==='done'?'selected':''; ?>>Done</option>
        </select>

        <button type="submit">Update task</button>
    </form>
    <a class="back" href="index.php">Back to tasks</a>
</div>
</body>
</html>
