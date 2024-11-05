<?php

session_start();
require_once("dbc.php");

if($_SERVER['REQUEST_METHOD'] != "POST" || !isset($_POST['processType'])) {
    header("Location: dashboard.php");
    exit;
}


// echo $_POST['user_id'] . " " . $_POST['processType']; die;

class Task {
    public $id;
    public $title;
    public $desc;
// give example
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
        $query = "INSERT INTO $this->table_name (task_title, task_description, user_id)
                  VALUES ('$this->title', '$this->desc', '1')";
                  
        if ($this->conn->query($query)) {
            header("Location: dashboard.php");
        } else {
            echo "Error: " . $query . "<br>" . $this->conn->error;
        }
    }

}

// class User {
//     public $UID;
//     public $username;
//     public $email;

//     public function whoAmI() {
//         echo $this->UID . " " . $this->username . " " . $this->email;
//     }

// }

// if(isset($_POST['updateTask'])) {
//     $id = $_POST['taskId'];
//     $title = $_POST['title'];
//     $desc = $_POST['description'];

//     $updatesql = "UPDATE tasks SET task_title='$title', task_description='$desc' WHERE task_id=$id";
//     if (mysqli_query($conn, $updatesql)) {
//      header("Location: dashboard.php");
//     } else {
//     echo "Error updating record: " . mysqli_error($conn);
//     }

//     mysqli_close($conn);
// }

// if(isset($_POST['deleteTask'])) {
//     $id = $_POST['taskId'];

//     // sql to delete a record
//     $deletesql = "DELETE FROM tasks WHERE task_id=$id";

//     if (mysqli_query($conn, $deletesql)) {
//         header("Location: dashboard.php");
//     } else {
//     echo "Error deleting record: " . mysqli_error($conn);
//     }

//     mysqli_close($conn);
// }


// echo $_POST['processType'];die;

switch($_POST['processType']) {
    case 'addTask':
        $title = $_POST['title'];
        $desc = $_POST['description'];

        $addsql = "INSERT INTO tasks (task_title, task_description, user_id)
        VALUES ('$title', '$desc', '1')";

        if ($conn->query($addsql) === TRUE) {
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Error: " . $addsql . "<br>" . $conn->error;
        }

        mysqli_close($conn);
        // $task = new Task($servername, $username, $password, $dbname);
        // $task->title = $_POST['title'];
        // $task->desc = $_POST['description'];
        // echo $task->title;die;



    case 'updateTask':
        $id = $_POST['taskId'];
        $title = $_POST['title'];
        $desc = $_POST['description'];

        $updatesql = "UPDATE tasks SET task_title='$title', task_description='$desc' WHERE task_id=$id";
        if ($conn->query($updatesql) === TRUE) {
        header("Location: dashboard.php");
        exit;
        } else {
        echo "Error updating record: " . $conn->error;
        }

        mysqli_close($conn);
    case 'deleteTask':
        $id = $_POST['taskId'];

        // sql to delete a record
        $deletesql = "DELETE FROM tasks WHERE task_id=$id";

        if ($conn->query($deletesql) === TRUE) {
            header("Location: dashboard.php");
            exit;
        } else {
        echo "Error deleting record: " . $conn->error;
        }

        mysqli_close($conn);
    case 'login':
        $id = $_POST['user_id'];

        $findUserQuery = "SELECT * FROM users WHERE user_id=$id";
        // echo $findUserQuery;die;
        $response = $conn->query($findUserQuery);
        // echo mysqli_num_rows($response);die;

        if ($response->num_rows > 0) {
            $_SESSION['userLoggedID'] = $id;
            header("Location: dashboard.php");
            exit;
        } else {
            header("Location: index.php");
            exit;
        }
    case 'logout':
        unset($_SESSION['userLoggedID']);
        header("Location: index.php");
        exit;

}
?>




