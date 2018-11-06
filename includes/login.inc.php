<?php
  session_start();

  if (isset($_POST['submit'])){
    include 'dbconn.inc.php';

    $uid = $conn->real_escape_string($_POST['uid']);
    $password = $conn->real_escape_string($_POST['password']);

    // Error handlers
    // Check if inputs are empty
    if (empty($uid) || empty($password)){
      header("Location: ../index.php?login=empty"); // returns to home page if route typed in URL
      exit();
    } else{
      $sql = "SELECT *
              FROM students s
              WHERE s.studentID='$uid'
              OR s.studentEmail='$uid'";
      $result = $conn->query($sql);
      if ($result->num_rows < 1){
        $sql = "SELECT *
                FROM teachers t
                WHERE t.teacherInitials='$uid'
                OR t.teacherEmail='$uid'";
        $result = $conn->query($sql);
        if ($result->num_rows < 1){
          header("Location: ../index.php?login=error");
          exit();
        } else{
          $row = $result->fetch_assoc();
          // De-hashing PASSWORD_DEFAULT
          $hashedPasswordCheck = password_verify($password,$row['teacherPassword']);
          if ($hashedPasswordCheck == false){
            header("Location: ../index.php?login=error");
            exit();
          } elseif ($hashedPasswordCheck == true) {
            $_SESSION['u_id'] = $row['teacherInitials'];
            $_SESSION['u_first'] = $row['teacherFirstname'];
            $_SESSION['u_last'] = $row['teacherSurname'];
            $_SESSION['u_email'] = $row['teacherEmail'];
            $_SESSION['u_year'] = "Teacher";
            $_SESSION['u_gender'] = $row['teacherGender'];
            $_SESSION['account_type'] = "Teacher";
            header("Location: ../index.php?login=success"); // send user to logged in page
            exit();
          }
        }
      } else{
        $row = $result->fetch_assoc();
        // De-hashing PASSWORD_DEFAULT
        $hashedPasswordCheck = password_verify($password,$row['studentPassword']);
        if ($hashedPasswordCheck == false){
          header("Location: ../index.php?login=error");
          exit();
        } elseif ($hashedPasswordCheck == true) {
          $_SESSION['u_id'] = $row['studentID'];
          $_SESSION['u_first'] = $row['studentFirstName'];
          $_SESSION['u_last'] = $row['studentSurname'];
          $_SESSION['u_email'] = $row['studentEmail'];
          $_SESSION['u_year'] = $row['studentYear'];
          $_SESSION['u_gender'] = $row['studentGender'];
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
