<?php
  include_once "navbars/navbar.php";
?>

<section class="container">
  <div class="jumbotron">
    <h2 class="centre">Home</h2>
    <?php
      if (isset($_SESSION['u_id'])) {
        echo nl2br("You are logged in!\n");
        echo nl2br("\nYour User ID: "),$_SESSION['u_id'];
        echo nl2br("\nYour Email: "),$_SESSION['u_email'];
        echo nl2br("\nYour Year: "),$_SESSION['u_year'];
        echo nl2br("\nYour Account Type: "),$_SESSION['account_type'];
      }
    ?>
  </div>
</section>


<script src="scripts/jquery-3.3.1.min.js"></script>
<script>
  $("#home").addClass("active");
</script>

<?php
  include_once "footer.php";
?>
