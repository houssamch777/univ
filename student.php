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
            <form action="./controller/process-student.php" method="post" class="mt-4">
    <div class="form-group">
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="birthday">Birthday:</label>
        <input type="date" id="birthday" name="birthday" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="place">Place:</label>
        <input type="text" id="place" name="place" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="univname">University Name:</label>
        <input type="text" id="univname" name="univname" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="department">Department:</label>
        <input type="text" id="department" name="department" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="specialty">Specialty:</label>
        <input type="text" id="specialty" name="specialty" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="card_id">Card ID:</label>
        <input type="text" id="card_id" name="card_id" class="form-control" required>
    </div>
    
    
    <button type="submit" class="btn btn-primary">Add Student</button>
</form>

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


