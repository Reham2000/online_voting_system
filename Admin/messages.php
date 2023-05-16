<?php

use App\Database\Models\User;
use App\Database\Models\Admin;
use App\Database\Models\Message;
use App\Http\Requests\Validation;

include "includes/header.php";
include "App/Http/Middlewares/Auth.php";
include "includes/navbar.php";
include "includes/sidebar.php";



$message = new Message;
$admin = new Admin;
$user = new User;
$validation = new Validation;
$messages = $message->read()->fetch_all();

if($_SERVER['REQUEST_METHOD'] == "POST")
{
  $validation->setInput("reply")->setValue($_POST['reply'])->required()->min(2);

  if(empty($validation->getErrors()))
  {
    date_default_timezone_set("Africa/Cairo");
    $message->setId($_POST['id'])->setReply($_POST['reply'])->setReply_at(date("Y-m-d h:i:sa"))->setAdmin_id($_SESSION['admin']->id)->reply();
    $messages = $message->read()->fetch_all();
  }
}
if(isset($_GET['delete']) && is_numeric($_GET['delete'])){
  $message->setId($_GET['delete'])->delete();
  header("location:messages.php");
}

?>



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Messages</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Messages</li>
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
      <?php
        foreach($messages as $messageDate){
      ?>
      <div class="card my-2 mx-5">
        <div class="card-header">
          <p class="fs-4 pt-2 text-info"><i class="fas fa-user mx-2"></i><?= $user->setId($messageDate[6])->getUserById()->fetch_object()->username ?></p>
        </div>
        <div class="card-body">
          <h5 class="card-title mb-2"><?= ucwords($messageDate[1]) ?></h5>
          <p class="card-text ms-5 fs-4"><i class="fas fa-envelope-open-text text-primary mx-2"></i> <?= ucfirst($messageDate[2]) ?></p>
          <p class="text-muted"><small><?= $messageDate[3] ?></small></p>
          <p class="fw-bold fst-italic ">Reply: </p>
          <?php if($messageDate[4] == ''){ ?>
            <div class="shadow p-3">
            <p class="card-text px-3 fs-5 text-danger ms-3">No Reply</p>
            <form action="" method="POST" enctype="multipart/form-data" class="col-sm-11 mt-5 ">
              <div class="input-group mb-3">
                  <textarea type="text" class="form-control" name="reply" aria-describedby="button-addon2"><?= $messageDate[4] ?? '' ?></textarea>
                  <input type="text" name="id" id="" class="d-none" value="<?= $messageDate[0] ?>">
                  <button class="btn btn-info rounded-end " type="submit" id="button-addon2">Send <i class="fas fa-paper-plane"></i></button>
              </div>
              <?= $validation->getMessage('reply') ?>
            </form>
            </div>
          <?php  }else{ ?>
            <div class="shadow p-3 rounded">
            <p class="fs-4 text-info"><i class="fas fa-user-cog px-2"></i><?= $admin->setId($messageDate[7])->getAdminById()->fetch_object()->username ?></p>
            <p class="card-text text-muted fs-6 ms-5"><i class="fas fa-reply text-success mx-2"></i><?= $messageDate[4] ?>
            <p><small class=" text-muted"><?= $messageDate[5] ?></small></p>
            </div>
          <?php } ?>
          </p>
          <a href="messages.php?delete=<?= $messageDate[0] ?>" class="ml-2 btn btn-danger">Delete</a>
        </div>
      </div>
      <?php } ?>
    </div>
    <!-- </div> -->
  </section>
</div>


<?php



include "includes/footer.php";
