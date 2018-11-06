<?php
  if(isset($_POST['submit'])){ // ensures submit button has been clicked
    include_once 'dbconn.inc.php';
    $first = $conn->real_escape_string($_POST['first']); // stops code from being added
    $last = $conn->real_escape_string($_POST['last']);
    $email = $conn->real_escape_string($_POST['email']);
    $uid = $conn->real_escape_string($_POST['uid']);
    $password = $conn->real_escape_string($_POST['password']);

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
          $sql = "SELECT *
                  FROM users
                  WHERE user_uid = '$uid'";
          $result = $conn->query($sql);
          if ($result->num_rows > 0){
            header("Location: ../signup.php?signup=usertaken");
            exit();
          } else{
            // Hashing Password
            $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
            // Insert the user into the database
            $sql = "INSERT INTO users (user_first,user_last,user_email,user_uid,user_password)
                    VALUES ('$first','$last','$email','$uid','$hashedPassword')";
            $result = $conn->query($sql);
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
