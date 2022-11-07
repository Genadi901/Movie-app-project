<?php 
session_start();
// registration
$error = "";

if (array_key_exists("signUp", $_POST)) {
    $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/"; 
    $email_validation_regex = '/^\\S+@\\S+\\.\\S+$/'; 


     // Db link
    include('./PHP/linkDB.php');  
 
    //taking form data
    $name = mysqli_real_escape_string($linkDB, $_POST['name']);
    $email = mysqli_real_escape_string($linkDB, $_POST['email']);
    $password = mysqli_real_escape_string($linkDB,  $_POST['password']); 
    $confirmPassword = mysqli_real_escape_string($linkDB,  $_POST['confirmPassword']); 
     
    // form validation
    if (!$name) {
      $error .= "Name is required <br>";
     }
     
    if ( !(preg_match($email_validation_regex, $email)) or !$email ) {
        $error .= "Email is invalid or empty! <br>";
     }
    if ( !(preg_match($password_regex, $password)) or !$password) {
        $error .= "Password is invalid or required!  <br>";
     } 
     if ($password !== $confirmPassword) {
        $error .= "Password does not match <br>";
     }
     if ($error) {
        $error = "<b>There were error(s) in your form!</b> <br>".$error;
     }  else {
       
        
        // if email exists
        $query = "SELECT id FROM users WHERE email = '$email' ";
        $result = mysqli_query($linkDB, $query);
        if (mysqli_num_rows($result) > 0) {
            $error .="<p>Your email has taken already!</p>";
        } else {
 
            //pass encryption
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 
            $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";
             
            if (!mysqli_query($linkDB, $query)){
                $error ="<p>Could not sign you up - please try again.</p>";
                } else {
 
                    // session variables to keep user logged in
                $_SESSION['id'] = mysqli_insert_id($linkDB);  
 
                header("Location: MovieApp/PHP/loggedInPage.php ");  
             
                }
             
            }
 
        }  
    }



    // user log in
      $error2 = ""; 
if (array_key_exists("logIn", $_POST)) {
     
    include('./PHP/linkDB.php'); 
 
      $email = mysqli_real_escape_string($linkDB, $_POST['email']);
      $password = mysqli_real_escape_string($linkDB,  $_POST['password']); 
       
      if (!$email) {
          $error2 .= "Email is required <br>";
       }
      if (!$password) {
          $error2 .= "Password is required <br>";
       } 
       if ($error2) {
          $error2 = "<b>There were error(s) in your form!</b><br>".$error2;
       }
        
      else {        
          //matching email and password
 
            $query = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($linkDB, $query);
            $row = mysqli_fetch_array($result);
         
            if (isset($row)) {
                 
                if (password_verify($password, $row['password'])) {
 
                    //session variables to keep user logged in
                    $_SESSION['id'] = $row['id'];  
 
                    header("Location: PHP/loggedInPage.php ");
 
                } else {
                    $error2 = "Combination of email/password does not match!";
                     }
   
            }  else {
                $error2 = "Combination of email/password does not match!";
                 }
        }
}



