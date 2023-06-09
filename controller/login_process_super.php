<?php
require "../model/DataBase.php";
$db = new DataBase();

if (isset($_POST['username']) && isset($_POST['password'])) {
    if ($db->dbConnect()) {
        $login = $db->superuserLogin($_POST['username'], $_POST['password']);
        if ($login) {
            session_start();
            $_SESSION["superuser"] = $login;
            $_SESSION['LAST_ACTIVITY'] = time();
            header("Location: ../dashboard.php");
            exit();
        } else {
            $error = "Authentication failed. Please check your username and password.";
            header("Location: ../admin.php?error=" . urlencode($error));
            exit();
        }
    } else {
        $error = "Error: Database connection";
        header("Location: ../admin.php?error=" . urlencode($error));
        exit();
    }
} else {
    $error = "All fields are required";
    header("Location: ../admin.php?error=" . urlencode($error));
    exit();
}
