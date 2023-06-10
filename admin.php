<?php // Check if there's an error message in the URL parameters
$error = isset($_GET['error']) ? $_GET['error'] : null;

session_start();
if (isset($_SESSION["superuser"])&&isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] < 1800)) {
  header("Location: dashboard.php");
  exit();
  // code...
}
else
{session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
    .banner img {
      width: 100%;
      height: auto;
    }
  </style>
</head>
<body>
  <header>
    <div class="banner">
      <img src="Banner.png" alt="Banner Image" class="img-fluid">
    </div>
  </header>
  
  <main>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <form action="./controller/login_process_super.php" method="POST" >
            <h3 class="mb-4">Superuser Login</h3>
            <?php if (isset($error)) { ?>
              <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
              </div>
            <?php } ?>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary">log In</button>
          </form>
        </div>
      </div>
    </div>
  </main>
  
  <footer class="mt-auto">
    <div class="container text-center">
      <p>&copy; 2023 biskra univ. All rights reserved.| <a href="index.php">Home</a></p></p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>