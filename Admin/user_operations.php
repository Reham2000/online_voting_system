<?php
include "includes/header.php";
include "includes/navbar.php";
include "includes/sidebar.php";

use App\Database\Models\User;
use App\Http\Requests\Validation;

$validation = new Validation;
$user = new User;

if(isset($_GET['delete']) && is_numeric($_GET['delete'])){
  $user->setId($_GET['delete'])->delete();
  header("location:users.php");die;

}


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $validation->setInput('username')->setValue($_POST['username'])->required()->min(2)->max(32)->unique('users','username');
    $validation->setInput('phone')->setValue($_POST['phone'])->required()->regex('/^01[0125][0-9]{8}$/')->unique('users','phone');
    $validation->setInput('password')->setValue($_POST['password'])->required()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/','mini 8 chars max 32 ,mini one number , one character , one uppercase letter , one lowercase letter , one specidal char')->confirmed($_POST['confirm_password']);
    $validation->setInput('confirm_password')->setValue($_POST['confirm_password'])->required();



    if (empty($validation->getErrors())) {
      $user->setUsername($_POST['username'])->setPhone($_POST['phone'])->setPassword($_POST['password']);
      if($user->create())
      {
          header("location:users.php");die;
      }
      else
      {
          $error = "<div class='alert alert-danger text-center fw-bold fs-4 p-0' role='alert'>Something Went Rong</div>";
      }
    }
  }



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
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
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
    <div class="container">
      <!-- <div class="row shadow"> -->
      <div class="row">
        <div class="col-4 page_logo text-center w-25 m-auto">
          <img src="images/add_user.png" class="rounded-circle" alt="Add Admin">
        </div>
        <?php
        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
          header("location:admins.php");
      } else { ?>
        <div class="col-md-8 col-sm-12">
          <h2 class="text-center col-12 pt-3 pb-2">Add User</h2>
          <?= $error ?? '' ?>
          <form action="" method="POST" class="w-75 mx-auto">
            <div class="col-12 form-group mb-1">
              <input class="form-control" type="text" name="username"
                value="<?= $validation->getOldValue('username') ?>" placeholder="Enter Your Username...">
              <?= $validation->getMessage('username') ?>
            </div>
            <div class="col-12 form-group mb-1">
              <input class="form-control" type="text" name="phone" value="<?= $validation->getOldValue('phone') ?>"
                placeholder="Enter Your Phone...">
              <?= $validation->getMessage('phone') ?>
            </div>
            <div class="col-12 form-group mb-1">
              <input class="form-control" type="password" name="password" value="" placeholder="Enter Your Password...">
              <?= $validation->getMessage('password') ?>
            </div>
            <div class="col-12 form-group mb-1">
              <input class="form-control" type="password" name="confirm_password" value=""
                placeholder="Confirm Your Password...">
              <?= $validation->getMessage('confirm_password') ?>
            </div>
            <button type="submit" class="btn btn-primary mx-3">Add <i class="fas fa-user-plus pl-3"></i></button>
          </form>
        </div>
        <?php } ?>

      </div>

      <div class="col-12">

      </div>
      <!-- </div> -->
  </section>
</div>


<?php


i