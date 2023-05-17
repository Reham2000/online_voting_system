<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: 0.8" /> -->
    <span class="brand-text font-weight-light">Online Voting System</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="images/admin.png" class="img-circle elevation-2 h-100" alt="User Image" />
      </div>
      <div class="info">
        <a href="profile.php" class="d-block"><?= $_SESSION['admin']->username ?></a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <!-- <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search" />
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div> -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Departments</li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <!-- <i class="nav-icon fas fa-chart-pie"></i> -->
            <i class="nav-icon fas fa-users-cog"></i>
            <p>
              Admins
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="admins.php" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>All Admins</p>
              </a>
            </li>
            <?php if($_SESSION['admin']->role == 1){ ?>
            <li class="nav-item">
              <a href="admin_operations.php" class="nav-link">
                <i class="fas fa-user-plus nav-icon"></i>
                <p>Add Admin</p>
              </a>
            </li>
            <?php } ?>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-users nav-icon"></i>
            <p>
              Users
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="users.php" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>All Users</p>
              </a>
            </li>
            <?php if($_SESSION['admin']->role == 1){ ?>
            <li class="nav-item">
              <a href="user_operations.php" class="nav-link">
                <i class="fas fa-user-plus nav-icon"></i>
                <p>Add User</p>
              </a>
            </li>
            <?php } ?>
          </ul>
        </li>
        <li class="nav-header">EXAMPLES</li>
        <li class="nav-item">
          <a href="messages.php" class="nav-link">
            <i class="fas fa-comments nav-icon"></i>
            <p>Messages</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="votes.php" class="nav-link">
            <i class="fas fa-vote-yea nav-icon"></i>
            <p>Votes</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="statistics.php" class="nav-link">
            <i class="fas fa-chart-pie nav-icon"></i>
            <p>Statistics</p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>


