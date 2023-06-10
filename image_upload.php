<?php // Check if there's an error message in the URL parameters
$error = isset($_GET['error']) ? $_GET['error'] : null;
session_start();
if (isset($_SESSION["superuser"])) {
  header("Location: dashboard.php");
  // code...
}
if (isset($_SESSION["student"])) {
  if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    header("Location: login.php");
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
}
else
{
  header("Location: login.php");
}



?>
<!DOCTYPE html>
<html>
<head>
  <title>Image Upload</title>
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

  .image-label {
    background-color: #fff;
    color: #000;
    font-size: 14px;
    text-align: center;
    padding: 5px;
    margin-top: 5px;
    font-weight: bold;
  }

  </style>
</head>
<body>

    <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">Biskra univ</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="image_upload.php">Upload</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About & Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./controller/logout_process.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
    <div class="banner">
      <img src="Banner.png" alt="Banner Image" class="img-fluid">
    </div>
  </header>
  <main>

  <div class="container mt-5">
    <h2>Image Upload</h2>
    <?php if (isset($error)) { ?>
              <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
              </div>
    <?php } ?>
    <form action="./controller/upload.php" method="POST" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-3">
          <div class="mb-3">
            <label for="frontImage">Front Image:</label>
            <input type="file" class="form-control" id="frontImage" name="frontImage" accept="image/jpeg, image/png" required>
          </div>
        </div>
        <div class="col-md-3">
          <div class="mb-3">
            <label for="rightImage">Right Image:</label>
            <input type="file" class="form-control" id="rightImage" name="rightImage" accept="image/jpeg, image/png" required>
          </div>
        </div>
        <div class="col-md-3">
          <div class="mb-3">
            <label for="leftImage">Left Image:</label>
            <input type="file" class="form-control" id="leftImage" name="leftImage" accept="image/jpeg, image/png" required>
          </div>
        </div>
        <div class="col-md-3">
          <div class="mb-3">
            <label for="farImage">Far Image:</label>
            <input type="file" class="form-control" id="farImage" name="farImage" accept="image/jpeg, image/png" required>
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Upload</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
  </main>
  <footer>
    <div class="container text-center">
      <p>&copy; 2023 biskra univ. All rights reserved.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>
