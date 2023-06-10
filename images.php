<?php
session_start();

if (isset($_SESSION["superuser"]) ) {
  if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    header("Location: admin.php");
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
}else
{
  header("Location: admin.php");
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
        footer {
            background-color: #f8f9fa;
            padding: 10px 0;
        }
        .sticky-footer {
            flex-shrink: none;
        }
            .card {
        border: 1px solid #ccc;
        margin-bottom: 20px;
    }

    .card-header {
        background-color: #f2f2f2;
        padding: 10px;
        font-weight: bold;
    }

    .card-body {
        padding: 20px;
    }

    .image-line {
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .image-container {
        width: 200px;
        margin-right: 20px;
        margin-bottom: 20px;
    }

    .image-container img {
        width: 100%;
        height: auto;
    }

    .image-label {
        margin-top: 5px;
        text-align: center;
    }

    .subfolder-label {
        font-weight: bold;
        margin-bottom: 10px;
        margin-right: 20px;
    }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link" href="images.php">Images</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="student.php">Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="student.php">Face API</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./controller/logout_process_super.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Main Content -->
    <main>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    <!-- Display student data here -->
                    <?php include 'controller/images.php'; ?>
                </div>
            </div>
        </div>
    </main>

    <!-- Sticky Footer -->
    <footer class="sticky-footer">
        <div class="container text-center">
            <p>&copy; 2023 Your Website. All rights reserved.</p>
        </div>
    </footer>

    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
