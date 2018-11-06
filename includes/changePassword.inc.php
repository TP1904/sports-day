<?php
  session_start();

  if(isset($_POST['change'])){ // ensures submit button has been clicked
    include_once 'dbconn.inc.php';
    $password = $conn->real_escape_string($_POST['old_password']); // stops code from being added
    $new_pass = $conn->real_escape_string($_POST['new_password']);
    $confirm_pass = $conn->real_escape_string($_POST['confirm_new_password']);

    // Error handlers
    // Check for empty fields
    if (empty($password) || empty($new_pass) || empty($confirm_pass)){
      header("Location: ../profile.php?password=empty"); // reloads page with error message in URL
      exit(); // stops script from running
    } else{
      if ($_SESSION['account_type'] == 'Teacher'){
        $sql = "SELECT teacherPassword
                FROM teachers
                WHERE teacherInitials = '{$_SESSION['u_id']}'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $hashedPasswordCheck = password_verify($password,$row['teacherPassword']);
      } elseif ($_SESSION['account_type'] == 'Student'){
        $sql = "SELECT studentPassword
                FROM students
                WHERE studentID = '{$_SESSION['u_id']}'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $hashedPasswordCheck = password_verify($password,$row['studentPassword']);
        echo $hashedPasswordCheck;
      }
      if ($hashedPasswordCheck == false){
        header("Location: ../profile.php?password=error");
        exit();
      } elseif ($new_pass == $confirm_pass){
        // Hashing Password
        $hashedPassword = password_hash($new_pass,PASSWORD_DEFAULT);
        if ($_SESSION['account_type'] == "Teacher"){
          $sql = "UPDATE teachers
                  SET teacherPassword = '$hashedPassword'
                  WHERE teacherInitials = '{$_SESSION['u_id']}'";
          $result = $conn->query($sql);
        } elseif ($_SESSION['account_type'] == "Student"){
          $sql = "UPDATE students
                  SET studentPassword = '$hashedPassword'
                  WHERE studentID = '{$_SESSION['u_id']}'";
          $result = $conn->query($sql);
        }
        header("Location: ../?change_password=success");
        exit();
      }
    }
  } else{
    header("Location: ../index.php"); // returns to home page if route typed in URL
    exit();
  }
?>
