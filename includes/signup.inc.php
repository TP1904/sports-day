<?php
  if(isset($_POST['submit'])){ // ensures submit button has been clicked
    include_once 'dbconn.inc.php';
    $first = mysqli_real_escape_string($conn,$_POST['first']); // stops code from being added
    $last = mysqli_real_escape_string($conn,$_POST['last']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $uid = mysqli_real_escape_string($conn,$_POST['uid']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    // Error handlers
    // Check for empty fields
    if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($password)){
      header("Location: ../signup.php?signup=empty"); // reloads page with error message in URL
      exit(); // stops script from running
    } else{
      // Check if input characters are valid
      if (!preg_match("/^[a-zA-Z]*$/",$first) || !preg_match("/^[a-zA-Z]*$/",$last)){ // Checks if characters other than alpha in first
        header("Location: ../signup.php?signup=invalid");
        exit();
      } else{
        // Check if email is valid
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)){ // Checks if is invalid email
          header("Location: ../signup.php?signup=email");
          exit();
        } else{
          // Check if username is original
          $sql = "SELECT * FROM users WHERE user_uid = '$uid'";
          $result = mysqli_query($conn,$sql);
          $resultCheck = mysqli_num_rows($result);
          if ($resultCheck > 0){
            header("Location: ../signup.php?signup=usertaken");
            exit();
          } else{
            // Hashing Password
            $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
            // Insert the user into the database
            $sql = "INSERT INTO users (user_first,user_last,user_email,user_uid,user_password) VALUES ('$first','$last','$email','$uid','$hashedPassword');";
            $result = mysqli_query($conn,$sql);
            header("Location: ../?signup=success");
            exit();
          }
        }
      }
    }

  } else{
    header("Location: ../signup.php"); // returns to signup page if route typed in URL
    exit();
  }
?>
