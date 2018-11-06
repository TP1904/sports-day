<?php
  include_once "navbars/navbar.php";
?>
<section class="container">
  <div class="jumbotron">
    <h2 class="centre">Competitors</h2>

    <div>
      <h4>Your Events</h4>

<?php
include './includes/dbconn.inc.php';

if (isset($_SESSION['u_id'])){
  echo nl2br('<div class="row">
    <div class="col-md-2"><h5>Event No.</h5></div>
    <div class="col-md-3"><h5>Event</h5></div>
    <div class="col-md-1"><h5>Year</h5></div>
    <div class="col-md-1"><h5>Level</h5></div>
    <div class="col-md-2"><h5>Type</h5></div>
    <div class="col-md-1"><h5>Gender</h5></div>
    </div>');

  if ($_SESSION['account_type'] == 'Student'){
    if (isset($_GET['eventID'])){
      $studentID = $_SESSION['u_id'];
      $eventID = $_GET['eventID'];
      $sql = "DELETE FROM eventstudents
              WHERE eventID = '$eventID'
              AND studentID = '$studentID'";
      $result = $conn->query($sql);
    }
  } elseif ($_SESSION['account_type'] == 'Teacher'){
    if (isset($_GET['signup'])){
      $teacherID = $_SESSION['u_id'];
      $eventID = 1;
      $sql = "INSERT INTO `staffroles`(`eventID`,`teacherInitials`)
              VALUES ('$eventID','$teacherID')";
      $result = $conn->query($sql);
    }
  }

  $sql = "SELECT e.eventID,s.sportName,e.eventYear,e.eventLevel,s.sportType,e.eventGender
          FROM events e,sports s,eventstudents es
          WHERE es.studentID = '{$_SESSION['u_id']}'
          AND es.eventID = e.eventID
          AND s.sportID = e.eventSportID";
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
        <a class="col-md-2" href="competitors.php?eventID=' . $row["eventID"] . '">Drop out</a>
        </div>');
      }
    }
  } else {
    header("Location: index.php");
  }
?>

    </div>
    <br>

    <div>
      <h4>Other Competitors</h4>

<?php
  include './includes/dbconn.inc.php';

  if (isset($_SESSION['u_id'])){
    echo nl2br('<div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-3"><h5>Name</h5></div>
          <div class="col-md-1"><h5>ID</h5></div>
          <div class="col-md-2"><h5>Event</h5></div>
          <div class="col-md-1"><h5>Year</h5></div>
          <div class="col-md-1"><h5>Level</h5></div>
          </div>');

    $sql = "SELECT s.studentFirstName,s.studentSurname,s.studentID,sp.sportName,e.eventYear,e.eventLevel
            FROM students s,eventstudents es,events e,sports sp
            WHERE s.studentID = es.studentID
            AND e.eventID = es.eventID
            AND e.eventSportID = sp.sportID
            AND NOT es.studentID = '{$_SESSION['u_id']}'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo nl2br('<div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-3">' . $row["studentFirstName"] . ' ' . $row["studentSurname"] . '</div>
          <div class="col-md-1">' . $row["studentID"] . '</div>
          <div class="col-md-2">' . $row["sportName"] . '</div>
          <div class="col-md-1">' . $row["eventYear"] . '</div>
          <div class="col-md-1">' . $row["eventLevel"] . '</div>
          </div>');
        }
      }
    } else {
      header("Location: index.php");
    }
?>

  </div>
</section>

<script src="scripts/jquery-3.3.1.min.js"></script>
<script>
  $("#competitors").addClass("active");
</script>

<?php
  include_once "footer.php";
?>
