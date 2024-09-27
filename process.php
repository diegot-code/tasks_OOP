<?php

session_start();
require_once("dbc.php");

$title = $_POST['title'];
$desc = $_POST['description'];

$sql = "INSERT INTO tasks (task_title, task_description, user_id)
VALUES ('$desc', '$title', '1')";

echo $sql;die;

if (mysqli_query($conn, $sql)) {
  header("Location: dashboard.php");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);


?>




