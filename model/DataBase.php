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
public function selectimage($id)
{
    $id = $this->prepareData($id);

    $this->sql = "SELECT * FROM image WHERE id = '" . $id . "'";
    $result = mysqli_query($this->connect, $this->sql);
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) != 0) {
        return $row; // Return the student image as an associative array
    } else return false; // image not found
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

public function uploadImages($Files, $studentName,$studentid,$id)
{
    $id = $this->prepareData($id);
    // Define the target directory to save the uploaded images
    $targetDirectory = "../student-images/" . $studentName . "/";
    if (!is_dir($targetDirectory)) {
        mkdir($targetDirectory, 0777, true);
    }
    else {
        // Empty the directory if it already exists
        $this->emptyDirectory($targetDirectory);
    }
    // Array to store the file names of the uploaded images
    $uploadedImages = array();

    // Loop through the uploaded files
    foreach ($Files as $file) {
        // Check if the file type is JPG or PNG
        $fileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        // Generate a unique file name to avoid conflicts
        $fileName = uniqid() . '.' . $fileType;

        // Set the target path to save the uploaded file
        $targetPath = $targetDirectory . $fileName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            // File uploaded successfully
            $uploadedImages[] = $fileName;
        } else {
            // Error occurred while uploading the file
            // Handle the error accordingly
        }
    }

    // Update the image paths in the database
    $frontImage = isset($uploadedImages[0]) ? $uploadedImages[0] : '';
    $leftImage = isset($uploadedImages[1]) ? $uploadedImages[1] : '';
    $rightImage = isset($uploadedImages[2]) ? $uploadedImages[2] : '';
    $farImage = isset($uploadedImages[3]) ? $uploadedImages[3] : '';
    if($id!=null){
        $this->sql="UPDATE `image` SET `front` = '" .$studentName."/". $frontImage . "', `left` = '".$studentName."/" . $leftImage . "', `right` = '".$studentName."/" . $rightImage . "', `far` = '".$studentName."/" . $farImage . "' WHERE `id` ='".$id."' ;";
    if (mysqli_query($this->connect, $this->sql)) {
        // Update successful
        $images=$this->selectimage($id);
        return $images;
    } else {
        // Error occurred while updating the image paths in the database
        // Handle the error accordingly
        return false;
    }
}else
{
// Insert a new image to the table
    $this->sql = "INSERT INTO `image` (`front`, `left`, `right`, `far`) VALUES ('" .$studentName."/". $frontImage . "', '".$studentName."/" . $leftImage . "', '".$studentName."/" . $rightImage . "', '".$studentName."/" . $farImage . "');";
    
    if (mysqli_query($this->connect, $this->sql)) {
        // Insertion successful
        $newId = mysqli_insert_id($this->connect);
        
        $this->sql ="UPDATE `student` SET `imageid` = '" .$newId. "' WHERE `id` ='".$studentid."' ;";
        if (mysqli_query($this->connect, $this->sql)) {
        // Update successful
        $images = $this->selectimage($newId);
        return $images;
    } else {
        // Error occurred while updating the image paths in the database
        // Handle the error accordingly
        return false;
    }
        
    } else {
        // Error occurred while inserting the image into the database
        // Handle the error accordingly
        return false;
    }


} 
}
// Function to empty a directory
private function emptyDirectory($directory)
{
    $files = glob($directory . '*');
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
}

public function insertStudent($studentData)
{
    // Prepare the student data for insertion
    $firstname = $this->prepareData($studentData['firstname']);
    $lastname = $this->prepareData($studentData['lastname']);
    $email = $this->prepareData($studentData['email']);
    $birthday = $this->prepareData($studentData['birthday']);
    $place = $this->prepareData($studentData['place']);
    $univname = $this->prepareData($studentData['univname']);
    $department = $this->prepareData($studentData['department']);
    $specialty = $this->prepareData($studentData['specialty']);
    $card_id = $this->prepareData($studentData['card_id']);
    

    // Insert the student data into the database
    $this->sql = "INSERT INTO student (firstname, lastname, email, birthday, place, univname, department, specialty, card_id) VALUES ('".$firstname."', '".$lastname."', '".$email."', '".$birthday."', '".$place."', '".$univname."', '".$department."', '".$specialty."', '".$card_id."')";
    if (mysqli_query($this->connect, $this->sql)) {
        // Student inserted successfully
        return true;
    } else {
        // Error occurred while inserting the student
        // Handle the error accordingly
        return false;
    }
}

































}

?>
