<?php
include "includes/header.php";
include "App/Http/Middlewares/Auth.php";
include "includes/navbar.php";
include "includes/sidebar.php";

use App\Database\Models\Admin;

$admin = new Admin;
$admins = $admin->read()->fetch_all();


?>



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Admins</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Admins</li>
          </ol>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <section class="content">
  <div class="container-fluid ">
    <!-- <div class="row shadow"> -->
    <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">All Admins In Our System</h3>
                  </div>
                  <a href="admin_operations.php" class=" mx-5 w-25 btn btn-success  mt-2"> Add New Admin <i class="fas fa-user-plus pl-3"></i></a>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table
                      id="example1"
                      class="table table-bordered table-striped"
                    >
                      <thead>
                        <tr class="text-center">
                          <th>Id</th>
                          <th>Username</th>
                          <th>Role</th>
                          <th>Created At</th>
                          <th>Updated At</th>
                          <th>Update</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach ($admins as $adminDate) {?>
                        <tr class="text-center">
                          <td><?= $adminDate[0] ?></td>
                          <td><?= $adminDate[1] ?></td>
                          <td>
                            <?php
                            if($adminDate[3] == 1){echo "Super Admin";}
                            else{echo "Admin";}
                            ?>
                          </td>
                          <td><?= $adminDate[4] ?></td>
                          <td><?= $adminDate[5] ?? 'Not Updated yet' ?></td>
                          <td>
                            <a href="admin_operations.php?update=<?= $adminDate[0] ?>" class="btn btn-info  mt-2">Update</a>
                          </td>
                          <td>
                            <a href="admin_operations.php?delete=<?= $adminDate[0] ?>" class="btn btn-danger  mt-2">Delete</a>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                      <tfoot>
                        <tr class="text-center">
                          <th>Id</th>
                          <th>Username</th>
                          <th>Role</th>
                          <th>Created At</th>
                          <th>Updated At</th>
                          <th>Update</th>
                          <th>Delete</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
  <!-- </div> -->
  </section>
</div>


<?php


include "includes/footer.php";

