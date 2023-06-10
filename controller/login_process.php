<?php
require "../model/DataBase.php";
$db = new DataBase();

if (isset($_POST['cardid']) && isset($_POST['date'])) {
    
    if ($db->dbConnect()) {

        $login=$db->studentLogin( $_POST['cardid'], $_POST['date']);
        if ($login) {
            session_start();
            $_SESSION["student"] = $login;
            if($images=$db->selectStudent($login["id"])){
                $_SESSION["student_image"]=$images;
            }
            
            $_SESSION['LAST_ACTIVITY'] = time();
            header("Location: ../index.php");

        } else {
            echo "auth wrong";
            echo $_POST['date'];
            $error = "Authentication failed. Please check your username and password.";
            header("Location: ../login.php?error=" . urlencode($error));
    }
    } else {echo "Error: Database connection";
            $error = "Error: Database connection";
            header("Location: ../login.php?error=" . urlencode($error));
            }
} else {echo "All fields are required";
$error = "All fields are required";
        header("Location: ../login.php?error=" . urlencode($error));
        };

?>