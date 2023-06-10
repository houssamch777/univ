<?php
require "../model/DataBase.php";
$db = new DataBase();
if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['birthday'], $_POST['place'], $_POST['univname'], $_POST['department'], $_POST['specialty'], $_POST['card_id'])) {
    // Process the student data here
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $place = $_POST['place'];
    $univname = $_POST['univname'];
    $department = $_POST['department'];
    $specialty = $_POST['specialty'];
    $card_id = $_POST['card_id'];
    // Get the form data

    $studentData = array(
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'email' => $_POST['email'],
        'birthday' => $_POST['birthday'],
        'place' => $_POST['place'],
        'univname' => $_POST['univname'],
        'department' => $_POST['department'],
        'specialty' => $_POST['specialty'],
        'card_id' => $_POST['card_id']
    );
    if ($db->dbConnect()) {
        // Perform further validation and database operations
    // ...
        if ($db->insertStudent($studentData)) {
            // code...
            echo "success";
        }
        else{

        }
    
    // Redirect or display success message
    // ...
}else{

}
    
} else {
    // Handle the case where the required form fields are not set
    // ...
}
