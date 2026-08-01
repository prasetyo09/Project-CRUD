<?php
include "config/koneksi.php";
session_start();
session_regenerate_id();

if (isset($_POST['login'])) {
  $email = trim($_POST['email']); 
  $pass = sha1($_POST['password']);
  $login = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
  $row = mysqli_fetch_assoc($login);

  if ($email == $row['email'] && $pass == $row['password']) {
    $_SESSION['NAME'] = $row['name'];
    // KALAU BERHASIL MASUK KE DASHBOARD
    header("location:dashboard.php");
    exit();
  } else {
    // KALAU GAGAL TETAP DI LOGIN
    header("location:index.php");
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Signin - InApp Inventory Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" sizes="180x180" href="assets/inapp-1.0.0/src/assets/images/favicon_io/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/inapp-1.0.0/src/assets/images/favicon_io/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/inapp-1.0.0/src/assets/images/favicon_io/favicon-16x16.png">
  <link rel="manifest" href="assets/inapp-1.0.0/src/assets/images/favicon_io/site.webmanifest">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">



</head>

<body>


  <div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card " style="max-width:420px; width:100%;">
      <div class="card-body p-5">
        <div class="text-center mb-3">
          <a href="index.html" class="mb-4 d-inline-block"><img src="assets/inapp-1.0.0/src/assets/images/logo-icon.svg" alt="" width="36">
            <span class=" ms-2"> <img src="assets/inapp-1.0.0/src/assets/images/logo.svg" alt=""></span>
          </a>
          <h1 class="card-title mb-5 h5">Sign in to your account</h1>

        </div>

        <form method="POST" class="needs-validation mt-3" novalidate>
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input name="email" id="email" type="email" class="form-control" placeholder="name@example.com" required autofocus>
            <div class="invalid-feedback">Please enter a valid email.</div>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label d-flex justify-content-between">
              <span>Password</span>
              <a href="#" class="small link-primary">Forgot Password?</a>
            </label>
            <input name="password" id="password" type="password" class="form-control" placeholder="Password" required minlength="6">
            <div class="invalid-feedback">Please provide a password (min 6 characters).</div>
          </div>

          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
              <input id="remember" class="form-check-input" type="checkbox">
              <label class="form-check-label small" for="remember">Remember me</label>
            </div>
          </div>

          <button class="btn btn-primary w-100" type="submit" name="login">Sign in</button>
        </form>

        <div class="text-center mt-3 small text-muted">
          Don't have an account? <a href="signup.html" class="link-primary">Sign up</a>
        </div>
      </div>
    </div>
  </div>



  <!-- Bootstrap JS -->
  <script src="assets/inapp-1.0.0/src/assets/js/main.js" type="module"></script>


</body>

</html>""