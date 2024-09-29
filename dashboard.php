<?php

session_start();

// echo $_SESSION['userLoggedID'];

if(!isset($_SESSION['userLoggedID'])) {
  header("Location: index.php");
  exit;
}

require_once("dbc.php");

$sql = "SELECT * FROM tasks WHERE user_id = {$_SESSION['userLoggedID']}";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <header>
      <h1>Task Dashboard</h1>
      <form action="process.php" method="POST">
        <button type="submit" id="logoutBtn" name="processType" value="logout">Logout</button>
      </form>
      <button id="addTaskBtn">Add Task</button>
    </header>

    <section class="task-list">
      <?php
      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
      ?>
        <div class="task-card">
            <h3><?= $row['task_title'] ?></h3>
            <p><?= $row['task_description'] ?></p>
            <form action="editTask.php" method="POST">
              <input type="hidden" name="taskId" value="<?= $row['task_id'] ?>">
              <input type="hidden" name="taskTitle" value="<?= $row['task_title'] ?>">
              <input type="hidden" name="taskDescription" value="<?= $row['task_description'] ?>">
              <input type="hidden" name="userId" value="<?= $row['user_id'] ?>">
              <button type="submit" class="view-task" name="editTask">Edit Task</button>
            </form>
        </div>
      <?php
        }
      }
      ?>
    </section>
  </div>

  <!-- Task Modal -->
  <div id="taskModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Add New Task</h2>
      <form id="taskForm" method="POST" action="process.php">
        <label for="title">Task Title</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4" required></textarea>

        <button name="processType" value="addTask" type="submit">Add Task</button>
      </form>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>
