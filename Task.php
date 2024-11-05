<?php

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