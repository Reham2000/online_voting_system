<?php

use App\Database\Models\Vote;

include "templates/header.php";
include "templates/navbar.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $vote = new Vote;
    $voteDate = $vote->setId($_GET['id'])->getVoteById()->fetch_object();
} else {
    header("location:index.php");
    die;
}

?>

<!-- Start Details Section -->
<section class="item-details py-5 my-5 vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <!-- <div class="col-sm-10">
                <div class="card">
                    <img src="layouts/images/vote.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below <a
                                href="details.php">More..</a></p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        <p class="float-end fs-6">100 <i class="far fa-thumbs-up  text-primary"></i> 50 <i
                                class="far fa-thumbs-down text-danger"></i></p>
                        <a href="index.php?get=like" class="btn btn-primary mt-2">Like</a>
                        <a href="index.php?get=dislike" class="btn btn-danger mt-2">Dislike</a>
                    </div>
                </div>
            </div> -->
            <?php //print_r($voteDate);die; 
            ?>
            <div class="col-12 row my-5 vh-100">
                <div class="col-4 h-100">
                    <img src="layouts/images/votes/<?= $voteDate->image ?>" alt="" class="w-100 h-100">
                </div>
                <div class="col-8 p-5">
                    <h2 class="card-title my-3"><?= $voteDate->title ?></h2>
                    <p class="card-text"><?= $voteDate->description ?></p>
                    <p class="card-text"><small class="text-muted">
                            <?php
                            if ($voteDate->updated_at == "") {
                                echo "Created at " . $voteDate->created_at;
                            } else {
                                echo "Last update at " . $voteDate->updated_at;
                            }
                            ?>
                        </small></p>
                    <p class="float-end fs-4"><?= $voteDate->like ?> <i class="far fa-thumbs-up  text-primary mx-2"></i>
                        <?= $voteDate->dislike ?> <i class="far fa-thumbs-down text-danger mx-2"></i></p>
                    <?php
                    if (isset($_SESSION['user']) && $_SESSION['user']->id != $voteDate->user_id) { ?>
                        <a href="index.php?get=like" class="btn btn-primary mt-2">Like</a>
                        <a href="index.php?get=dislike" class="btn btn-danger mt-2">Dislike</a>

                    <?php    }elseif(isset($_SESSION['user']) && $_SESSION['user']->id != $voteDate->user_id){ ?>
                        <a href="makeVote.php?vote=<?= $voteDate->id ?>" class="btn btn-outline-dark  mt-2">Update</a>

                    <?php }else{ ?>
                        <a href="login.php" class="btn btn-primary mt-2">Like</a>
                        <a href="login.php" class="btn btn-danger mt-2">Dislike</a>
                    <?php }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Details Section -->


<?php


include "templates/footer.php";
