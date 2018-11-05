<?php
  include_once "navbars/navbar.php";
?>
<section class="container">
  <div class="jumbotron">
    <h2 class="centre">Competitors</h2>

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

    $sql = "SELECT s.studentFirstName,s.studentSurname,s.studentID,sp.sportName,e.eventYear,e.eventLevel FROM students s,eventstudents es,events e,sports sp WHERE s.studentID = es.studentID AND e.eventID = es.eventID AND e.eventSportID = sp.sportID";
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
