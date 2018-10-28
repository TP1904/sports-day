<?php
  include_once "navbars/navbar.php";
?>

  <section class="container">
    <div class="jumbotron">
      <h2 class="centre">Signup</h2>
      <form class="form my-2 my-lg-0 col-md-4 row centre" action="includes/signup.inc.php" method="POST">
        <input type="text" name="first" placeholder="First Name" class="form-control mr-sm-2" />
        <input type="text" name="last" placeholder="Last Name" class="form-control mr-sm-2" />
        <input type="text" name="email" placeholder="Email" class="form-control mr-sm-2" />
        <input type="text" name="uid" placeholder="Username" class="form-control mr-sm-2" />
        <input type="password" name="password" placeholder="Password" class="form-control mr-sm-2" />
        <button type="submit" name="submit" class="btn btn-secondary my-2 my-sm-0">Sign up</button>
    </div>
  </section>

<?php
  include_once "footer.php";
?>
