<?php
require "DataBaseConfig.php";

class DataBase
{
    public $connect;
    public $data;
    private $sql;
    protected $servername;
    protected $username;
    protected $password;
    protected $databasename;

    public function __construct()
    {
        $this->connect = null;
        $this->data = null;
        $this->sql = null;
        $dbc = new DataBaseConfig();
        $this->servername = $dbc->servername;
        $this->username = $dbc->username;
        $this->password = $dbc->password;
        $this->databasename = $dbc->databasename;
    }

    function dbConnect()
    {
        $this->connect = mysqli_connect($this->servername, $this->username, $this->password, $this->databasename);
        return $this->connect;
    }

    function prepareData($data)
    {
        return mysqli_real_escape_string($this->connect, stripslashes(htmlspecialchars($data)));
    }

    public function studentLogin($card_id, $date)
{
    $card_id = $this->prepareData($card_id);
    $date = $this->prepareData($date);

    $this->sql = "SELECT * FROM student WHERE card_id = '" . $card_id . "' AND birthday = '" . $date . "'";
    $result = mysqli_query($this->connect, $this->sql);
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) != 0) {
        // Login successful
        return $row;
    } else {
        // Login failed
        return false;
    }
}


public function selectStudent($id)
{
    $id = $this->prepareData($id);
    $this->sql = "SELECT * FROM student WHERE id = '" . $id . "'";
    $result = mysqli_query($this->connect, $this->sql);
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) != 0) {
        $this->sql1 = "SELECT * FROM image WHERE id = '" . $row['imageid'] . "'";
        $result1 = mysqli_query($this->connect, $this->sql1);
        $row1 = mysqli_fetch_assoc($result1);
    if (mysqli_num_rows($result1) != 0) {
        return $row1; // Return the student image as an associative array
    } else return false; // image not found
    } else return false; // Student not found

}


public function superuserLogin($username, $password)
    {
        $username = $this->prepareData($username);
        $password = $this->prepareData($password);

        $this->sql = "SELECT * FROM super_user WHERE username = '" . $username . "'";
        $result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);

        if (mysqli_num_rows($result) != 0 && password_verify($password, $row['password'])) {
            // Login successful
            return $row;
        } else {
            // Login failed
            return false;
        }
    }
public function createSuperuser($username, $password)
    {
        $username = $this->prepareData($username);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $this->sql = "INSERT INTO super_user (username, password) VALUES ('" . $username . "', '" . $hashedPassword . "')";

        if (mysqli_query($this->connect, $this->sql)) {
            return true; // Superuser created successfully
        } else {
            return false; // Failed to create superuser
        }
    }

public function getAllStudents()
{
    $this->sql = "SELECT * FROM student";
    $result = mysqli_query($this->connect, $this->sql);
    $students = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $students[] = $row;
    }

    return $students;
}





































}

?>
