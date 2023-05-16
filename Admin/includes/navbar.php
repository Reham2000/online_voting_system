<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="index.php" class="nav-link">Home</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="messages.php" class="nav-link">Contact</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <?php
    if (isset($_SESSION['admin'])) {
    ?>
      <li class="nav-item d-none d-sm-inline-block"><a class="nav-link" href="profile.php">my Profile</a></li>
      <li class="nav-item d-none d-sm-inline-block"><a class="nav-link" href="logout.php">Logout</a></li>
    <?php
    }
    ?>

  </ul>
</nav>
<!-- /.navbar -->
