<?php
  include_once "navbar.php";
?>
<section class="container">
  <div class="jumbotron">
    <h2 class="centre">Events</h2>

<div class="row">
  <div class="col-md-2"><h5>Event No.</h5></div>
  <div class="col-md-4"><h5>Event</h5></div>
  <div class="col-md-2"><h5>Year</h5></div>
  <div class="col-md-2"><h5>Type</h5></div>
  <div class="col-md-2"><h5>Gender</h5></div>
</div>
<?php
include './includes/dbconn.inc.php';

if (isset($_SESSION['u_id'])){
  $sql = "SELECT * FROM events";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo nl2br('<div class="row">
        <div class="col-md-2">' . $row["eventID"] . '</div>
        <div class="col-md-4">' . $row["eventName"] . '</div>
        <div class="col-md-2">' . $row["eventYear"] . '</div>
        <div class="col-md-2">' . $row["eventType"] . '</div>
        <div class="col-md-2">' . $row["eventGender"] . '</div>
      </div>');
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
