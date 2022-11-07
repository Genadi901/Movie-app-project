<?php include('PHP/server.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="bootstrap-5.2.2/scss/bootstrap.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js
    "></script>
  <script src="JS/app.js" defer></script>
  <link rel="stylesheet" href="CSS/style.css">
  <title>Movies App</title>
</head>

<body>

  <nav class="navbar bg-dark mb-5">
    <div class="container-fluid ">
      <a class="navbar-brand text-light" href="#">Movies app</a>
      <button type="button" class="btn btn-secondary " id="loginBtn">Log In</button>
      <button type="button" class="btn btn-secondary " id="regBtn">Register</button>

      <button type="button" class="btn btn-primary hidden" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add movie</button>
    </div>
  </nav>

  <!-- Log in form -->
  <section class="hidden" id="login-form">
    <div class="logInForm" id="logIn">
      <form method="POST">

        <!-- To show errors is user put wrong data -->
        <div class="error"> <?php echo $error2 ?> </div>

        <!-- To check the user loged In status -->
        <p>
          <?php
          if (!isset($_SESSION["id"])) {
            echo "<p>Please first log in to proceed.</p>";
          }
          ?>
        </p>

        <div class="form-floating mb-3">
          <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Email">
          <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating">
          <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword">Password</label>
        </div>
        <div class="form-floating mt-2">
          <input type="submit" name="logIn" value="Log In" class="btn btn-primary">
        </div>
      </form>
    </div>

  </section>

  <!-- Register form -->
  <section class="hidden" id="regForm">

    <div class="form" id="signUp">
      <form method="POST">
        <div class="error"> <?php echo $error ?> </div>

        <!--------- To check user regidtration status ------->
        <p>
          <?php
          if (!isset($_SESSION["id"])) {
            echo "Please first register to proceed.";
          }
          ?>
        </p>
        <div class="form-floating">
          <input type="text" name="name" placeholder="User Name" class="form-control" id="floatingInput" placeholder="Username"> <br> <br>
          <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating">
          <input type="email" name="email" class="form-control" id="floatingInput" placeholder="example@example.com"> <br><br>
          <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="password">
          <label for="floatingPassword">Password</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" name="confirmPassword" class="form-control" id="floatingPassword" placeholder="password">
          <label for="floatingPassword">Confirm Password</label>
        </div>
        <div class="form-floating">
          <input type="submit" name="signUp" value="Sign Up" class="btn btn-primary" id="signup">
        </div>

      </form>
    </div>


  </section>


  <script>
    let regform = $("#regForm");
    let regformBtn = $("#regBtn");
    let loginform = $("#login-form");
    let loginBtn = $("#loginBtn");

    $(regformBtn).click(() => {
      regform.removeClass('hidden');
      loginform.addClass("hidden");
    });

    $(loginBtn).click(() => {
      loginform.removeClass('hidden');
      regform.addClass("hidden");
    });

  </script>
</body>

</html>