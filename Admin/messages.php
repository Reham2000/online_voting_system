<?php

use App\Database\Models\Message;
use App\Http\Requests\Validation;

include "includes/header.php";
include "includes/navbar.php";
include "includes/sidebar.php";



$message = new Message;
$validation = new Validation;
$messages = $message->read()->fetch_all();

if($_SERVER['REQUEST_METHOD'] == "POST")
{
  $validation->setInput("reply")->setValue($_POST['reply'])->required()->min(2);

  if(empty($validation->getErrors()))
  {
    $message->setId($_POST['id'])->setReply($_POST['reply'])->reply();
    $messages = $message->read()->fetch_all();
  }
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
          Message:<?= $messageDate[0] ?>
        </div>
        <div class="card-body">
          <h5 class="card-title"><?= $messageDate[1] ?></h5>
          <p class="card-text ms-5 fs-4"><i class="fas fa-envelope-open-text text-primary mx-2"></i> <?= $messageDate[2] ?></p>
          <p class="text-muted"><small><?= $messageDate[3] ?></small></p>
          <p class="fw-bold fst-italic ">Reply: </p>
          <?php if($messageDate[4] == ''){ ?>
            <p class="card-text shadow p-3 fs-5 text-danger ms-3">No Reply</p>
            <form action="" method="POST" enctype="multipart/form-data" class="col-sm-11 mt-5 ">
              <div class="input-group mb-3">
                  <textarea type="text" class="form-control" name="reply" aria-describedby="button-addon2"><?= $messageDate[4] ?? '' ?></textarea>
                  <input type="text" name="id" id="" class="d-none" value="<?= $messageDate[0] ?>">
                  <button class="btn btn-info rounded-end " type="submit" id="button-addon2">Send <i class="fas fa-paper-plane"></i></button>
              </div>
              <?= $validation->getMessage('reply') ?>
            </form>
          <?php  }else{ ?>

            <p class="card-text text-muted fs-6 ms-5"><i class="fas fa-reply text-success mx-2"></i><?= $messageDate[4] ?>
            <p><small class=" text-muted"><?= $messageDate[5] ?></small></p>
          <?php } ?>
          </p>
          <a href="my_messages.php?delete=<?= $messageDate[0] ?>" class="btn btn-outline-danger">Delete</a>
        </div>
      </div>
      <?php } ?>
    </div>
    <!-- </div> -->
  </section>
</div>


<?php



include "includes/footer.php";
