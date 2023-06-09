<?php
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
$student=$_SESSION["student"];
$image=$_SESSION["student_image"];
}else
{
  header("Location: login.php");
}


?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
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
  <div class="container mt-4">
    <div class="row align-items-center">
      <div class="col-md-2">
        <div class="image-container">
          <img src="<?php echo $image["front"]; ?>" alt="Front Image" class="img-fluid">
          <div class="image-label">Front</div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="image-container">
          <img src="<?php echo $image["right"]; ?>" alt="Right Image" class="img-fluid">
          <div class="image-label">Right</div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="image-container">
          <img src="<?php echo $image["left"]; ?>" alt="Left Image" class="img-fluid">
          <div class="image-label">Left</div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="image-container">
          <img src="<?php echo $image["far"]; ?>" alt="Far Image" class="img-fluid">
          <div class="image-label">Far</div>
        </div>
      </div>
      <div class="col-md-4">
        <h2><?php echo $student["firstname"]." ".$student["lastname"]; ?></h2>
        <p>
          <strong>Birthday:</strong> <?php echo $student["birthday"]; ?><br>
          <strong>University Name:</strong> <?php echo $student["univname"]; ?><br>
          <strong>Department:</strong> <?php echo $student["department"]; ?><br>
          <strong>Specialty:</strong> <?php echo $student["specialty"]; ?><br>
          <strong>Card ID:</strong> <?php echo $student["card_id"]; ?><br>
        </p>
        <a href="image_upload.php" class="btn btn-primary">Update</a>
      </div>
    </div>
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
