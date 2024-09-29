<?php

session_start();
require_once("dbc.php");

if($_SERVER['REQUEST_METHOD'] != "POST" || !isset($_POST['processType'])) {
    header("Location: dashboard.php");
    exit;
}


class Task {
    public $task_id;
    public $task_title;
    public $task_desc;
// give example
    public $table_name = "tasks";

    private $conn;

    private function __construct($serverName, $userName, $password, $databaseName) {
    
    $this->conn = mysqli_connect($serverName, $userName, $password, $databaseName);
    if(!conn) {
        header("Location: index.php");
    }
    }
    
    public function addTask() {
        $query = "INSERT INTO $this->$table_name (task_title, task_description, user_id)
    VALUES ('$this->task_title', '$this->task_desc', '1')";

    if (mysqli_query($this->conn, $query)) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $addsql . "<br>" . mysqli_error($conn);
    }
    }

}


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

        if (mysqli_query($conn, $addsql)) {
        header("Location: dashboard.php");
        exit;
        } else {
        echo "Error: " . $addsql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    case 'updateTask':
        $id = $_POST['taskId'];
        $title = $_POST['title'];
        $desc = $_POST['description'];

        $updatesql = "UPDATE tasks SET task_title='$title', task_description='$desc' WHERE task_id=$id";
        if (mysqli_query($conn, $updatesql)) {
        header("Location: dashboard.php");
        exit;
        } else {
        echo "Error updating record: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    case 'deleteTask':
        $id = $_POST['taskId'];

        // sql to delete a record
        $deletesql = "DELETE FROM tasks WHERE task_id=$id";

        if (mysqli_query($conn, $deletesql)) {
            header("Location: dashboard.php");
            exit;
        } else {
        echo "Error deleting record: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    case 'login':
        $id = $_POST['user_id'];

        $findUserQuery = "SELECT * FROM users WHERE user_id=$id";
        // echo $findUserQuery;die;
        $response = mysqli_query($conn, $findUserQuery);
        // echo mysqli_num_rows($response);die;

        if(mysqli_num_rows($response) > 0) {
            $_SESSION['userLoggedID'] = $id;
            header("Location: dashboard.php");
            exit;
        } else {
            header("Location: index.php");
        }
    case 'logout':
        unset($_SESSION['userLoggedID']);
        header("Location: index.php");
        exit;

}
?>




