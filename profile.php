<?php
  include_once "navbars/navbar.php";
?>

  <section class="container">
    <div class="jumbotron">
      <h2 class="centre">Your Profile</h2>
      <?php
        if (isset($_SESSION['u_id'])) {
          echo nl2br("\n<strong>Your User ID: </strong>"),$_SESSION['u_id'];
          echo nl2br("\n<strong>Your Email: </strong>"),$_SESSION['u_email'];
          echo nl2br("\n<strong>Account Type: </strong>"),$_SESSION['account_type'];
        }
      ?>
      <form class="form-inline my-2 my-lg-0" action="includes/changePassword.inc.php" method="POST">
        <input type="password" required name="old_password" id="old_password" placeholder="Current Password" class="form-control mr-sm-2" />
        <input type="password" required name="new_password" id="new_password" placeholder="New Password" class="form-control mr-sm-2" />
        <input type="password" required name="confirm_new_password" id="confirm_new_password" placeholder="Confirm New Password" class="form-control mr-sm-2" />
        <button type="submit" name="change" id="change" class="btn btn-secondary my-2 my-sm-0">Change Password</button>
      </form>
    </div>
  </section>

<?php
  include_once "footer.php";
?>
