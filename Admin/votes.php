<?php
include "includes/header.php";
include "includes/navbar.php";
include "includes/sidebar.php";

use App\Database\Models\Vote;


$vote = new Vote;
$votes = $vote->read()->fetch_all();
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
      <!-- <div class="row shadow"> -->
      <div class="row  g-4">
        <?php
          foreach ($votes as $singleVote) {
              $singleVote[7] = explode(' ', $singleVote[7]);
              $singleVote[7] = $singleVote[7][0];
              $singleVote[8] = explode(' ', $singleVote[8]);
              $singleVote[8] = $singleVote[8][0];
        ?>
        <div class="col-6 row border p-2">
          <div class="col-4 m-auto">
            <img src="../layouts/images/votes/<?= $singleVote[3] ?>" class="card-img-top" alt="<?= $singleVote[1] ?>">
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
      <!-- </div> -->
  </section>
</div>

<!-- <div class="col-lg-6 col-sm-12">
          <div class="card">
            <img src="../layouts/images/votes/<?= $singleVote[3] ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title py-2 fw-bolder fs-3"><?= $singleVote[1] ?></h5>
              <p class="card-text"><?= $singleVote[2][0] ?> <a href="details.php?id=<?= $singleVote[0] ?>">More..</a>
              </p>
              <p class="card-text"><small
                  class="text-muted"><?= empty($singleVote[8]) ? "Created at " . $singleVote[7]  : "Last updated " . $singleVote[8] ?></small>
              </p>
              <p class="float-end fs-6"><?= $singleVote[4] ?> <i class="far fa-thumbs-up  text-primary"></i>
              <?= $singleVote[5] ?> <i class="far fa-thumbs-down text-danger"></i></p>
              <a href="index.php?from=profile&vote=<?= $singleVote[0] ?>"
                class="btn btn-outline-danger  mt-2">Delete</a>

            </div>
          </div>
        </div> -->
<?php


include "includes/footer.php";
