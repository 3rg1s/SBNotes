  <?php
  session_start();
  ?>
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href=".">SBnotes</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li> 
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo $_SESSION["username"]; ?><span class="caret glyphicon"></span></a>
        <ul class="dropdown-menu">
                <?php
       if ($_SESSION["username"] === "admin") { 
      echo '<li><a href="javascript:void(0);" onclick="confirmcreate()">Create Invite code</a></li>';
  }else {

  }
  ?>
          <li><a href="actions/encnot.php">Encrypt Notes</a></li>
          <li><a href="view.php">View Notes</a></li>
          <li><a href="actions/setpassword.php">Set Notes Password</a></li>
          <li><a href="actions/reset-password.php">Reset Account Password</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
