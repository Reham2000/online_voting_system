<?php
include "includes/header.php";
include "App/Http/Middlewares/Auth.php";
include "includes/navbar.php";
include "includes/sidebar.php";

use App\Database\Models\Vote;


$vote = new Vote;
$votes = $vote->read()->fetch_all();
if(isset($_GET['delete']) && is_numeric($_GET['delete'])){
  $vote->setId($_GET['delete'])->delete();
  header("location:votes.php");die;
}
?>



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Votes</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Votes</li>
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
      <div class="row  g-4">
        <?php
          foreach ($votes as $singleVote) {
              $singleVote[7] = explode(' ', $singleVote[7]);
              $singleVote[7] = $singleVote[7][0];
              $singleVote[8] = explode(' ', $singleVote[8]);
              $singleVote[8] = $singleVote[8][0];
        ?>
        <div class="col-6 row border p-2 mb-3 border-0 shadow-sm">
          <div class="col-4 m-auto">
            <img src="<?= $votesImagesPath . $singleVote[3] ?>" class="card-img-top" alt="<?= $singleVote[1] ?>">
          </div>
          <div class="col-8 p-2 pl-3 pr-2">
            <h5 class="title"><?= $singleVote[1] ?></h5>
            <p class="desc py-2"><?= $singleVote[2] ?></p>
            <p>Created At :
              <small class="text-muted"><?= $singleVote[8] ?></small>
            </p>
            <div class="row">
              <div class="col-6">
                <a href="votes.php?delete=<?= $singleVote[0] ?>" class="btn btn-outline-danger  mt-2">Delete</a>
              </div>
              <div class="col-6 m-auto pt-4 ">
                <p class="float-end fs-6"><?= $singleVote[4] ?> <i class="far fa-thumbs-up  text-primary"></i>
                  <?= $singleVote[5] ?> <i class="far fa-thumbs-down text-danger"></i></p>
              </div>

            </div>

          </div>
        </div>
        <?php } ?>

      </div>
  </section>
</div>


<?php


include "includes/footer.php";
