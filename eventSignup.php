<?php
  include_once "navbars/navbar.php";
?>

<section class="container">
  <div class="jumbotron">
    <h2 class="centre">Sign up</h2>

    <?php
    include './includes/dbconn.inc.php';

    if (isset($_SESSION['u_id'])){
      $year = $_SESSION['u_year'];
      $gender = $_SESSION['u_gender'];
      if ($year == "11" || $year == "12" || $year == "13"){
        $year = "Senior";
      }
      $sql = "SELECT e.eventID,s.sportName,e.eventYear,e.eventLevel,s.sportType,e.eventGender FROM events e,sports s WHERE e.eventYear = '$year' AND (e.eventGender = '$gender' OR e.eventgender = 'Both') GROUP BY e.eventID";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo nl2br('<div class="row">
            <div class="col-md-2">' . $row["eventID"] . '</div>
            <div class="col-md-3">' . $row["sportName"] . '</div>
            <div class="col-md-1">' . $row["eventYear"] . '</div>
            <div class="col-md-1">' . $row["eventLevel"] . '</div>
            <div class="col-md-2">' . $row["sportType"] . '</div>
            <div class="col-md-1">' . $row["eventGender"] . '</div>
            <a class="col-md-2" id=' . $row["eventID"] . ' href="eventSignup.php?signup=true">Sign up</a>
            </div>');
          }
        }
        if ($_SESSION['account_type'] == 'Student'){
          if (isset($_GET['signup'])){
            $studentID = $_SESSION['u_id'];
            $eventID = 1;
            $sql = "INSERT INTO `eventstudents`(`eventID`,`studentID`) VALUES ('$eventID','$studentID')";
            $result = $conn->query($sql);
            header("Location: eventSignup.php");
          }
        } elseif ($_SESSION['account_type'] == 'Teacher'){
          if (isset($_GET['signup'])){
            $teacherID = $_SESSION['u_id'];
            $eventID = 1;
            $sql = "INSERT INTO `staffroles`(`eventID`,`teacherInitials`) VALUES ('$eventID','$teacherID')";
            $result = $conn->query($sql);
            header("Location: eventSignup.php");
          }
        }
      }
    ?>

  </div>
</section>


<script src="scripts/jquery-3.3.1.min.js"></script>
<script>
  $("#eventSignup").addClass("active");
</script>

<?php
  include_once "footer.php";
?>
