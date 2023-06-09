<?php
require "../model/DataBase.php";
$db = new DataBase();
if (isset($_POST['cardid']) && isset($_POST['imageid'])) {
    if ($db->dbConnect()) {
        $login=$db->studentLogin( $_POST['cardid'], $_POST['imageid']);
        if ($login) {
            session_start();
            $_SESSION["student"] = $login;
            $_SESSION["student_image"]=$db->selectStudent($login["id"]);
            $_SESSION['LAST_ACTIVITY'] = time();
            header("Location: ../index.php");

        } else {
            echo "auth wrong";
            header("Location: ../login.php");
    }
    } else {echo "Error: Database connection";
            header("Location: ../login.php");
            }
} else {echo "All fields are required";
        header("Location: ../login.php");
        };

?>