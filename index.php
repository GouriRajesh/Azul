<?php

  // Start session
  session_start();
  
  // Connect to AZUL Database base in phpmyadmin
  $conn = mysqli_connect("localhost","root","","azul_mini_project");

  //Check connection succesful or not
  if(!$conn)
  {
    echo "Database Connection Error: " . mysqli_connect_error();
  }

  //PHP script for signup page
  if(isset($_POST["signup_button"]))
  {

    // New user signup update to database if not already exists and redirect to home page
    $full_name = mysqli_real_escape_string($conn, $_POST['signup_name']);
    $email = mysqli_real_escape_string($conn, $_POST['signup_email']);
    $password = mysqli_real_escape_string($conn, $_POST['signup_password']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['signup_pno']);
    $country = mysqli_real_escape_string($conn, $_POST['signup_country']);
    $gender = mysqli_real_escape_string($conn, $_POST['signup_gender']);
    
    // Checking if user already exists in the database
    $check="SELECT * FROM student_signup WHERE email = '$_POST[signup_email]' ";
    $res = mysqli_query($conn,$check);
    $data = mysqli_fetch_array($res, MYSQLI_NUM);

    //if($data[0] > 1 or !$data){
    if($data != null) {
        echo '<script> alert("This user already exists! Try signing-in instead if you already have an account.") </script>';
    }
    else
    {
      $newusersql = "INSERT INTO student_signup(full_name,email,password,phone_number,country,gender) VALUES ('$full_name','$email','$password','$phone_number','$country','$gender')";
        if (mysqli_query($conn,$newusersql))
        {   
          echo '<script> alert("Congratulations! You have successfully signed-up for AZUL!") </script>';
          //Move to Home Page
          $_SESSION["user_email"] = $email;
          header('refresh: 2; url=home.php');
          exit;
        }
        else
        { 
            echo '<script> alert("Error adding user in the database!") </script>';
        }
    }
    mysqli_free_result($res);
  }

  //PHP script for signin page
  elseif(isset($_POST["signin_button"]))
  {
    $semail= mysqli_real_escape_string($conn, $_POST['signin_email']);
    $spassword = mysqli_real_escape_string($conn, $_POST['signin_password']);

    $passsql= "SELECT * FROM student_signup WHERE email = '$_POST[signin_email]' ";
    $r= mysqli_query($conn,$passsql);
    $passdata = mysqli_fetch_assoc($r);

    if($passdata['password'] == $spassword)
    {
      echo '<script> alert("Congratulations! You have successfully signed into AZUL!") </script>';
      $_SESSION["user_email"] = $semail;
      header('refresh: 2; url=home.php');
      exit;
    }
    else
    {
      echo '<script> alert("Signin Failed! Please make sure that you enter the correct details and that you have activated your account.") </script>';
    }

    mysqli_free_result($r);
  }
  mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./startstyle.css" />
    <link rel="icon" type="image/png" href="./elements/asmallest.png"/>
    <title>AZUL LOGIN & SIGNUP</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="index.php" class="sign-in-form" method="POST">
            <h2 class="title">SIGN IN TO AZUL</h2>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" name="signin_email" placeholder="Email ID" required />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="signin_password" placeholder="Password" required />
            </div>
            <input type="submit" value="SIGNIN" class="btn solid" name="signin_button"/>
          </form>
          
          <form action="index.php" class="sign-up-form" method="POST">
            <h2 class="title">SIGN UP FOR AZUL</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Full Name" name="signup_name" required>
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="signup_email" required>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="signup_password" required>
            </div>
            <div class="input-field">
              <i class="fas fa-phone"></i>
              <input type="tel" placeholder="Phone Number" name="signup_pno" pattern="[1-9]{1}[0-9]{9}" required>
            </div>
            <div class="drop-box">
              <select name="signup_country">
              <option value="" disabled selected>Choose Country</option>
              <option value="india">INDIA</option>
              <option value="australia">AUSTRALIA</option>
              <option value="usa">USA</option>
              <option value="japan">JAPAN</option>
              <option value="spain">SPAIN</option>
              </select>
            </div>
            <div class="radio-btn">
              <input type="radio" id="male" name="signup_gender" value="male">
              <label for="male">MALE</label>
              <input type="radio" id="female" name="signup_gender" value="female">
              <label for="female">FEMALE</label>
              <input type="radio" id="other" name="signup_gender" value="other">
              <label for="other">OTHER</label>
            </div>
            <div class="check-box">
              <input type="checkbox" name="signup_tandc" value="yes" required></input>
              <label for="tandc">I AGREE TO THE TERMS AND CONDITIONS</label>
            </div>
            <div>
              <input type="reset" class="btn" value="CLEAR" >
              <input type="submit" class="btn" value="SIGN UP" name="signup_button">
          </div>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>ARE YOU NEW HERE?</h3>
            <p>
              Join Azul today to experience a seamless online study environment and many more functions!
            </p>
            <button class="btn transparent" id="sign-up-btn">Sign up</button>
          </div>
          <img src="./elements/login.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>ALREADY HAVE AN ACCOUNT?</h3>
            <p>
              Login to your account using your email and password to access all the operations of Azul.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="./elements/sign-up.svg" class="image" alt="" />
        </div>
      </div>
    </div>
    <script src="./startscript.js"></script>
  </body>
</html>
