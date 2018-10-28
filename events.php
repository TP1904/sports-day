<?php
  include_once "navbars/navbar.php";
?>
<section class="container">
  <div class="jumbotron">
    <h2 class="centre">Events</h2>

<?php
include './includes/dbconn.inc.php';

if (isset($_SESSION['u_id'])){
  echo nl2br('<div class="row">
        <a class="col-md-2" href="events.php?eventNo=true"><h5>Event No.</h5></a>
        <a class="col-md-4" href="events.php?event=true"><h5>Event</h5></a>
        <a class="col-md-1" href="events.php?year=true"><h5>Year</h5></a>
        <a class="col-md-1"><h5>Level</h5></a>
        <a class="col-md-2" href="events.php?type=true"><h5>Type</h5></a>
        <a class="col-md-2" href="events.php?gender=true"><h5>Gender</h5></a>
        </div>');
  if (isset($_GET['year'])){

    $sql = "SELECT e.eventID,s.sportName,e.eventYear,e.eventLevel,s.sportType,e.eventGender FROM events e,sports s GROUP BY e.eventID ORDER BY e.eventYear, e.eventID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo nl2br('<div class="row">
        <div class="col-md-2">' . $row["eventID"] . '</div>
        <div class="col-md-4">' . $row["sportName"] . '</div>
        <div class="col-md-1">' . $row["eventYear"] . '</div>
        <div class="col-md-1">' . $row["eventLevel"] . '</div>
        <div class="col-md-2">' . $row["sportType"] . '</div>
        <div class="col-md-2">' . $row["eventGender"] . '</div>
        </div>');
      }
    }
  } elseif (isset($_GET['type'])){
        $sql = "SELECT e.eventID,s.sportName,e.eventYear,e.eventLevel,s.sportType,e.eventGender FROM events e,sports s GROUP BY e.eventID ORDER BY s.sportType DESC, e.eventID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo nl2br('<div class="row">
        <div class="col-md-2">' . $row["eventID"] . '</div>
        <div class="col-md-4">' . $row["sportName"] . '</div>
        <div class="col-md-1">' . $row["eventYear"] . '</div>
        <div class="col-md-1">' . $row["eventLevel"] . '</div>
        <div class="col-md-2">' . $row["sportType"] . '</div>
        <div class="col-md-2">' . $row["eventGender"] . '</div>
        </div>');
      }
    }
  } elseif (isset($_GET['gender'])){
      $sql = "SELECT e.eventID,s.sportName,e.eventYear,e.eventLevel,s.sportType,e.eventGender FROM events e,sports s GROUP BY e.eventID ORDER BY e.eventGender DESC, e.eventID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo nl2br('<div class="row">
        <div class="col-md-2">' . $row["eventID"] . '</div>
        <div class="col-md-4">' . $row["sportName"] . '</div>
        <div class="col-md-1">' . $row["eventYear"] . '</div>
        <div class="col-md-1">' . $row["eventLevel"] . '</div>
        <div class="col-md-2">' . $row["sportType"] . '</div>
        <div class="col-md-2">' . $row["eventGender"] . '</div>
        </div>');
      }
    }
  } else {
    $sql = "SELECT e.eventID,s.sportName,e.eventYear,e.eventLevel,s.sportType,e.eventGender FROM events e,sports s GROUP BY e.eventID ORDER BY e.eventID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo nl2br('<div class="row">
          <div class="col-md-2">' . $row["eventID"] . '</div>
          <div class="col-md-4">' . $row["sportName"] . '</div>
          <div class="col-md-1">' . $row["eventYear"] . '</div>
          <div class="col-md-1">' . $row["eventLevel"] . '</div>
          <div class="col-md-2">' . $row["sportType"] . '</div>
          <div class="col-md-2">' . $row["eventGender"] . '</div>
          </div>');
        }
      }
    }
  }
?>

  </div>
</section>

<script src="scripts/jquery-3.3.1.min.js"></script>
<script>
  $("#events").addClass("active");
</script>

<?php
  include_once "footer.php";
?>
