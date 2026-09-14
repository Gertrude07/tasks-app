<?php
require "db.php";
$result = $conn->query("SELECT * FROM tasks ORDER BY created_at DESC");

function status_label($status) {
    $labels = [
        'pending' => 'Pending',
        'in_progress' => 'In progress',
        'done' => 'Done'
    ];
    return $labels[$status] ?? $status;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Tasks</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrap">
    <h1>My Tasks</h1>
    <a class="add-link" href="create.php">Add a task</a>

    <?php if ($result->num_rows === 0): ?>
        <div class="empty">No tasks yet. Add your first one above.</div>
    <?php endif; ?>

    <?php while ($row = $result->fetch_assoc()): ?>
    <div class="task">
        <h3><?php echo htmlspecialchars($row['title']); ?></h3>
        <?php if (trim($row['description']) !== ''): ?>
            <p><?php echo htmlspecialchars($row['description']); ?></p>
        <?php endif; ?>
        <div class="task-actions">
            <span class="status status-<?php echo $row['status']; ?>"><?php echo status_label($row['status']); ?></span>
            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
            <a class="delete" href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this task?');">Delete</a>
        </div>
    </div>
    <?php endwhile; ?>
</div>
</body>
</html>
<?php $conn->close(); ?>
