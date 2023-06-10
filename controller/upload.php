<?php
require "../model/DataBase.php";
$db = new DataBase();
session_start();
if (isset($_FILES) && isset($_SESSION["student"])) {
    $student = $_SESSION["student"];
    $studentName = $student["firstname"] . "_" . $student["lastname"];
    if ($db->dbConnect()) {
        if ($_SESSION["student_image"]=$db->uploadImages($_FILES, $studentName,$student["id"],$student["imageid"])) {
            // Images uploaded and paths updated in the database successfully
            header("Location: ../index.php");
            exit;
            echo "success";
        } else {
            // Error occurred while uploading images or updating paths in the database
            // Handle the error accordingly
            echo "Error occurred while uploading images or updating paths.";
            $error = "Error occurred while uploading images or updating paths.";
            header("Location: ../image_upload.php?error=" . urlencode($error));
            exit();
        }
    } else {
        // Error occurred while connecting to the database
        // Handle the error accordingly
        echo "Error: Database connection failed.";
        $error = "Error: Database connection failed.";
            header("Location: ../image_upload.php?error=" . urlencode($error));
            exit();
    }
} else {
    // Invalid request, redirect back to the previous page
    //header("Location: index.php");
    echo "Invalid request, redirect back to the previous page";
    $error = "Error: Invalid request.";
    header("Location: ../image_upload.php?error=" . urlencode($error));
            exit();
}