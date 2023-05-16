<?php
include "includes/header.php";
include "includes/navbar.php";
include "includes/sidebar.php";

use App\Database\Models\Admin;
use App\Http\Requests\Validation;

$validation = new Validation;
$admin = new Admin;

if(isset($_GET['delete']) && is_numeric($_GET['delete'])){
  $admin->setId($_GET['delete'])->delete();
  header("location:admins.php");

}


if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if(isset($_GET['update']) && is_numeric($_GET['update'])){
    $adminData = $admin->setId($_GET['update'])->getAdminById()->fetch_object();
    $validation->setInput('username')->setValue($_POST['username'])->isChanged($adminData->username);
    if($validation->getChanged() == 1){
      $validation->required()->min(2)->unique('admins', 'username');
    }
    if(isset($_POST['password']) && $_POST['confirm_password']){
      $validation->setInput('password')->setValue($_POST['password'])->required()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/', 'mini 8 chars max 32 ,mini one number , one character , one uppercase letter , one lowercase letter , one specidal char')->confirmed($_POST['confirm_password']);
      $validation->setInput('confirm_password')->setValue($_POST['confirm_password'])->required();

    }
    $validation->setInput('role')->setValue($_POST['role'])->required();



    if (empty($validation->getErrors())) {
      if(isset($_POST['password']) && isset($_POST['confirm_assword'])){
        $admin->setId($_GET['update'])->setUsername($_POST['username'])->setPassword($_POST['password'])->setRole($_POST['role'])->ChangePassword();
      }else{
        $admin->setId($_GET['update'])->setUsername($_POST['username'])->setRole($_POST['role'])->update();
      }
      header("location:admins.php");
    }
  }else{
    $validation->setInput('username')->setValue($_POST['username'])->required()->min(2)->unique('admins', 'username');
    $validation->setInput('password')->setValue($_POST['password'])->required()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/', 'mini 8 chars max 32 ,mini one number , one character , one uppercase letter , one lowercase letter , one specidal char')->confirmed($_POST['confirm_password']);
    $validation->setInput('confirm_password')->setValue($_POST['confirm_password'])->required();
    $validation->setInput('role')->setValue($_POST['role'])->required();



    if (empty($validation->getErrors())) {
      $admin->setUsername($_POST['username'])->setPassword($_POST['password'])->setRole($_POST['role'])->create();
      header("location:admins.php");
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
    <div class="container">
      <!-- <div class="row shadow"> -->
      <div class="row">
        <div class="col-4 page_logo text-center w-25 m-auto">
          <img src="images/add_user.png" class="rounded-circle" alt="Add Admin">
        </div>
        <?php
        if (isset($_GET['update']) && is_numeric($_GET['update'])) {
          $adminData = $admin->setId($_GET['update'])->getAdminById()->fetch_object();
        ?>
          <div class="col-md-8 col-sm-12">
            <h2 class="text-center col-12 pt-3 pb-2">Update Admin</h2>
            <form action="" method="POST" class="w-75 mx-auto">
              <div class="col-12 form-group mb-1">
                <input class="form-control" type="text" name="username" value="<?= $adminData->username ?>" placeholder="Enter Your Username...">
                <?= $validation->getMessage('username') ?>
              </div>
              <div class="col-12 form-group mb-1">
                <input class="form-control" type="password" name="password" value="" placeholder="Change The Password...">
                <?= $validation->getMessage('password') ?>
              </div>
              <div class="col-12 form-group mb-1">
                <input class="form-control" type="password" name="confirm_password" value="" placeholder="Confirm The Password...">
                <?= $validation->getMessage('confirm_password') ?>
              </div>
              <div class="col-12 form-group mb-1">
                <select class="form-control" name="role" id="">
                  <option disabled selected value>Choose Admin Role...</option>
                  <option <?= $adminData->role == 1 ? 'selected' : '' ?> value="1">Super Admin</option>
                  <option <?= $adminData->role == 2 ? 'selected' : '' ?> value="2">Admin</option>
                </select>
                <?= $validation->getMessage('role'); ?>
              </div>
              <button type="submit" class="btn btn-primary mx-3">Update <i class="fas fa-pencil-alt"></i></button>
            </form>
          </div>
        <?php } elseif (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
          header("location:admins.php");
      } else { ?>
          <div class="col-md-8 col-sm-12">
            <h2 class="text-center col-12 pt-3 pb-2">Add Admin</h2>
            <form action="" method="POST" class="w-75 mx-auto">
              <div class="col-12 form-group mb-1">
                <input class="form-control" type="text" name="username" value="<?= $validation->getOldValue('username') ?>" placeholder="Enter Your Username...">
                <?= $validation->getMessage('username') ?>
              </div>
              <div class="col-12 form-group mb-1">
                <input class="form-control" type="password" name="password" value="" placeholder="Enter Your Password...">
                <?= $validation->getMessage('password') ?>
              </div>
              <div class="col-12 form-group mb-1">
                <input class="form-control" type="password" name="confirm_password" value="" placeholder="Confirm Your Password...">
                <?= $validation->getMessage('confirm_password') ?>
              </div>
              <div class="col-12 form-group mb-1">
                <select class="form-control" name="role" id="">
                  <option disabled selected value>Choose Admin Role...</option>
                  <option value="1">Super Admin</option>
                  <option value="2">Admin</option>
                </select>
                <?= $validation->getMessage('role'); ?>
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


include "includes/footer.php";
