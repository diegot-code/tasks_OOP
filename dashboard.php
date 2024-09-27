<?php

session_start();

// if(!isset($_SESSION['user-id'])) {
//   header("Location: index.php");
// }

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
      <button id="addTaskBtn">Add Task</button>
    </header>

    <section class="task-list">
      <!-- Task cards will be dynamically populated by your backend -->
    </section>
  </div>

  <!-- Task Modal -->
  <div id="taskModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Add New Task</h2>
      <!-- Form method is POST to handle PHP backend -->
      <form id="taskForm" method="POST" action="process.php">
        <label for="title">Task Title</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4" required></textarea>

        <button type="submit">Add Task</button>
      </form>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>
