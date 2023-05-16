<?php
include "includes/header.php";
include "includes/navbar.php";
include "includes/sidebar.php";

use App\Database\Models\User;

$user = new User;
$users = $user->read()->fetch_all();


?>



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Users</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
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
                    <h3 class="card-title">All Users In Our System</h3>
                  </div>
                  <a href="user_operations.php" class=" mx-5 w-25 btn btn-success  mt-2"> Add New User <i class="fas fa-user-plus pl-3"></i></a>
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
                          <th>Phone</th>
                          <th>Photo</th>
                          <th>status</th>
                          <th>Created At</th>
                          <th>Updated At</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach ($users as $userData) {?>
                        <tr class="text-center">
                          <td><?= $userData[0] ?></td>
                          <td><?= $userData[1] ?></td>
                          <td>0<?= $userData[2] ?></td>
                          <td><img src="../layouts/images/users/<?= $userData[4] ?? 'default.png' ?>" alt="<?= $userData[1] ?>" class="w-25 rounded-circle"></td>
                          <td>
                            <?php
                            if($userData[5] == 1){echo "Active";}
                            else{echo "Not Active";}
                            ?>
                          </td>
                          <td><?= $userData[6] ?></td>
                          <td><?= $userData[7] ?? 'Not Updated yet' ?></td>

                          <td>
                            <a href="user_operations.php?delete=<?= $userData[0] ?>" class="btn btn-danger  mt-2">Delete</a>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                      <tfoot>
                        <tr class="text-center">
                          <th>Id</th>
                          <th>Username</th>
                          <th>Phone</th>
                          <th>Photo</th>
                          <th>status</th>
                          <th>Created At</th>
                          <th>Updated At</th>
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

