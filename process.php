<?php

session_start();
require_once("dbc.php");

if($_SERVER['REQUEST_METHOD'] != "POST" || !isset($_POST['processType'])) {
    header("Location: dashboard.php");
    exit;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// echo $_POST['user_id'] . " " . $_POST['processType']; die;

class Task {
    public $id;
    public $title;
    public $desc;
    public $tid;
    public $table_name = "tasks";

    private $conn;

    function __construct($serverName, $userName, $password, $databaseName) {
        // Use mysqli::__construct instead of deprecated mysqli_connect
        $this->conn = new mysqli($serverName, $userName, $password, $databaseName);
        
        // Check for connection error
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    
    public function addTask() {
        // MARK: Add Task Method

        // $query = "INSERT INTO $this->table_name (task_title, task_description, user_id) VALUES ('$this->title', '$this->desc', '1')";
                  
        // if ($this->conn->query($query)) {
        //     header("Location: dashboard.php");
        // } else {
        //     echo "Error: " . $query . "<br>" . $this->conn->error;
        // }

        $query = $this->conn->prepare("INSERT INTO $this->table_name (task_title, task_description, user_id) VALUES (?, ?, ?)");
        $user_id = '1';
        $query->bind_param("sss", $this->title, $this->desc, $user_id);

        // echo $query;die;

        if ($query->execute()) {
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Error Encountered: " . $query->error;
        }
        
    }

    public function updateTask() {
        // MARK: Update Task Method

        $query = $this->conn->prepare("UPDATE $this->table_name SET task_title = ?, task_description = ? WHERE task_id = ?");
    
        $query->bind_param("sss", $this->title, $this->desc, $this->tid);

        if ($query->execute()) {
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Error Encountered: " . $query->error;
        }
        
    }

    public function deleteTask() {
        // MARK: Update Task Method
        
        $query = $this->conn->prepare("DELETE FROM $this->table_name WHERE task_id = ?");
        $query->bind_param("s", $this->tid);

        if ($query->execute()) {
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Error Encountered: " . $query->error;
        }
    }


}


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




