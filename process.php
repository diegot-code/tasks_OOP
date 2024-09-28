<?php

session_start();
require_once("dbc.php");


if(isset($_POST['addTask'])) {
    $title = $_POST['title'];
    $desc = $_POST['description'];

    $addsql = "INSERT INTO tasks (task_title, task_description, user_id)
    VALUES ('$title', '$desc', '1')";

    if (mysqli_query($conn, $addsql)) {
    header("Location: dashboard.php");
    } else {
    echo "Error: " . $addsql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}

if(isset($_POST['updateTask'])) {
    $id = $_POST['taskId'];
    $title = $_POST['title'];
    $desc = $_POST['description'];

    $updatesql = "UPDATE tasks SET task_title='$title', task_description='$desc' WHERE task_id=$id";
    if (mysqli_query($conn, $updatesql)) {
     header("Location: dashboard.php");
    } else {
    echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

if(isset($_POST['deleteTask'])) {
    $id = $_POST['taskId'];

    // sql to delete a record
    $deletesql = "DELETE FROM tasks WHERE task_id=$id";

    if (mysqli_query($conn, $deletesql)) {
        header("Location: dashboard.php");
    } else {
    echo "Error deleting record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}



?>




