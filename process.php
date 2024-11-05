<?php

session_start();
require_once("dbc.php");
require_once("Task.php");

if($_SERVER['REQUEST_METHOD'] != "POST" || !isset($_POST['processType'])) {
    header("Location: dashboard.php");
    exit;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// echo $_POST['user_id'] . " " . $_POST['processType']; die;




switch($_POST['processType']) {
    case 'addTask':
        // MARK: Add Task

        // Initialising a Task class
        $task = new Task($servername, $username, $password, $dbname);
        
        // Set the title and Desc
        $task->title = $_POST['title'];
        $task->desc = $_POST['description'];

        
        // Call the addTask Method with the title and desc arguments
        if($task->addTask()) {
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Error Occurred";
        }

        // Return to dashboard.php and exit


    case 'updateTask':
        // MARK: Update Task

        $task = new Task($servername, $username, $password, $dbname);
        
        // Set the title and Desc
        $task->title = $_POST['title'];
        $task->desc = $_POST['description'];
        $task->tid = $_POST['taskId'];
            
        if($task->updateTask()) {
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Error Occurred";
        }


    case 'deleteTask':
        // MARK: Delete Task

        $task = new Task($servername, $username, $password, $dbname);
        
        $task->tid = $_POST['taskId'];
            
        if($task->deleteTask()) {
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Error Occurred";
        }
    case 'login':
        // MARK: Login

        $id = $_POST['user_id'];

        $findUserQuery = "SELECT * FROM users WHERE user_id=$id";

        $response = $conn->query($findUserQuery);

        if ($response->num_rows > 0) {
            $_SESSION['userLoggedID'] = $id;
            header("Location: dashboard.php");
            exit;
        } else {
            header("Location: index.php");
            exit;
        }
    case 'logout':
        // MARK: Logout

        unset($_SESSION['userLoggedID']);
        header("Location: index.php");
        exit;

}
?>




