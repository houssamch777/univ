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
            <a class="navbar-brand" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
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
                    <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2>Student Table</h2>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-primary">Add New Student</button>
                    </div>
                     </div>
                    
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search by student name">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button">Search</button>
                        </div>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Birth date</th>
                                <th>Palce of birth</th>
                                <th>Univertiy</th>
                                <th>Department</th>
                                <th>Specialty</th>
                                <th>Card id</th>
                                <th>Edit</th>
                                <th>delete</th>
                                <!-- Add more columns as needed -->
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Display student data here -->
                            <?php include 'controller/show_student_table.php'; ?>
                        </tbody>
                    </table>
                    
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
