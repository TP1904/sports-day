<?php
  session_start();

  if (isset($_POST['submit'])){
    include 'dbconn.inc.php';

    $uid = mysqli_real_escape_string($conn,$_POST['uid']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    // Error handlers
    // Check if inputs are empty
    if (empty($uid) || empty($password)){
      header("Location: ../index.php?login=empty"); // returns to home page if route typed in URL
      exit();
    } else{
      $sql = "SELECT * FROM students s WHERE s.studentID='$uid' OR s.studentEmail='$uid'";
      $result = mysqli_query($conn,$sql);
      $resultCheck = mysqli_num_rows($result);
      if ($resultCheck < 1){
        $sql = "SELECT * FROM teachers t WHERE t.teacherInitials='$uid' OR t.teacherEmail='$uid'";
        $result = mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1){
          header("Location: ../index.php?login=error3");
          exit();
        } else{
          $row = mysqli_fetch_assoc($result);
          // De-hashing PASSWORD_DEFAULT
          $hashedPasswordCheck = password_verify($password,$row['teacherPassword']);
          if ($hashedPasswordCheck == false){
            header("Location: ../index.php?login=error2");
            exit();
          } elseif ($hashedPasswordCheck == true) {
            $_SESSION['u_id'] = $row['teacherInitials'];
            $_SESSION['u_first'] = $row['teacherFirstname'];
            $_SESSION['u_last'] = $row['teacherSurname'];
            $_SESSION['u_email'] = $row['teacherEmail'];
            $_SESSION['account_type'] = "Teacher";
            header("Location: ../index.php?login=success"); // send user to logged in page
            exit();
          }
        }
      } else{
        $row = mysqli_fetch_assoc($result);
        // De-hashing PASSWORD_DEFAULT
        $hashedPasswordCheck = password_verify($password,$row['studentPassword']);
        if ($hashedPasswordCheck == false){
          header("Location: ../index.php?login=error2");
          exit();
        } elseif ($hashedPasswordCheck == true) {
          $_SESSION['u_id'] = $row['studentID'];
          $_SESSION['u_first'] = $row['studentFirstname'];
          $_SESSION['u_last'] = $row['studentSurname'];
          $_SESSION['u_email'] = $row['studentEmail'];
          $_SESSION['account_type'] = "Student";
          header("Location: ../index.php?login=success"); // send user to logged in page
          exit();
        }
      }
    }

  } else{
    header("Location: ../index.php?login=error"); // returns to home page if route typed in URL
    exit();
  }
?>
