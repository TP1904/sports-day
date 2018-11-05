<?php
  include_once "navbars/navbar.php";
?>
<section class="container">
  <div class="jumbotron">
    <h2 class="centre">Scores</h2>

<?php
  include './includes/dbconn.inc.php';

  if (isset($_SESSION["u-id"])){

  } else {
    header("Location: index.php");
  }
?>

  </div>
</section>

<script src="scripts/jquery-3.3.1.min.js"></script>
<script>
  $("#scores").addClass("active");
</script>

<?php
  include_once "footer.php";
?>
