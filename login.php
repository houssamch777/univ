<?php
session_start();

if (isset($_SESSION["student"]) && isset($_SESSION["student_image"])) {
  if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] < 1800)) {
    header("Location: index.php");
}
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
      background-image: url("Banner.png");
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }
    main {
      flex: 1;
    }

    footer {
      background-color: #f8f9fa;
      padding: 10px 0;
    }
  </style>
</head>
<body>
  <header>
    <!-- Your header code here -->
  </header>
  
  <main>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <form action="./controller/login_process.php" method="POST">
            <h3 class="mb-4">Student Login</h3>
            <div class="mb-3">
              <label for="cardid" class="form-label">Card ID</label>
              <input type="text" class="form-control" id="cardid" name="cardid" placeholder="Enter your card ID" required>
            </div>
            <div class="mb-3">
              <label for="imageid" class="form-label">birth date</label>
              <input type="date" class="form-control" id="date" name="date"  required>
            </div>
            <button type="submit" class="btn btn-primary">Log In</button>
          </form>
        </div>
      </div>
    </div>
  </main>
  
  <footer class="mt-auto">
    <div class="container text-center">
      <p>&copy; 2023 biskra univ. All rights reserved. | <a href="admin.php">Admin Page</a></p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
