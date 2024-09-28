<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Task</title>
  <link rel="stylesheet" href="edit.css">
</head>
<body>
  <div class="edit-task-container">
    <div class="edit-task-box">
      <h2>Edit Task</h2>
      <!-- Form to edit task -->
      <form id="editTaskForm" method="POST" action="process.php">
        <label for="title">Task Title</label>
        <input type="hidden" name="taskId" value="<?= $_POST['taskId'] ?>" required>
        <input type="text" id="title" name="title" value="<?= $_POST['taskTitle'] ?>" required>

        <label for="description">Task Description</label>
        <textarea id="description" name="description" rows="4" required><?= $_POST['taskDescription'] ?></textarea>

        <button name="updateTask" type="submit">Save Changes</button>
      </form>

      <!-- Delete Task button -->
      <form id="deleteTaskForm" method="POST" action="delete_task.php">
        <!-- You may pass the task ID in a hidden input -->
        <input type="hidden" name="task_id" value="">
        <button type="submit" class="delete-btn">Delete Task</button>
      </form>
    </div>
  </div>
</body>
</html>
