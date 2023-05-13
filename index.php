<?php

use App\Database\Models\User;
use App\Database\Models\Vote;
use App\Database\Models\Users_votes;

include "templates/header.php";
include "templates/navbar.php";
define('LIKE', 1);
define('DISLIKE', 0);
define('ACTIVE', 1);
define('NOT_ACTIVE', 0);

$vote = new Vote;
$users_votes = new Users_votes;
$user = new User;

$votes = $vote->read()->fetch_all();

if (isset($_GET['like']) && is_numeric($_GET['like'])) {

    $users_votes->setUserId($_SESSION['user']->id)->setVoteId($_GET['like'])->setVote(LIKE);
    $data = [$users_votes->getUserId(), $users_votes->getVoteId(), $users_votes->getVote()];

    if ($users_votes->voteForOnce()->num_rows == 0) {

        // first time to vote
        $users_votes->create();
        $voteData = $vote->setId($_GET['like'])->getVoteById()->fetch_object();
        $vote->setUser_id($_SESSION['user']->id)->setLike($voteData->like)->likes();
        if ($_SESSION['user']->status == 0) {
            $user->setId($_SESSION['user']->id)->updateColumn('status', ACTIVE);
        }
        $votes = $vote->read()->fetch_all();
        header("location:index.php");
    } else {
        $message[$_GET['like']] = "<i class='fas fa-exclamation-triangle'></i> You can vote only once";
        header("refresh:5 ;url=index.php");
    }
}
if (isset($_GET['dislike']) && is_numeric($_GET['dislike'])) {
    $users_votes->setUserId($_SESSION['user']->id)->setVoteId($_GET['dislike'])->setVote(DISLIKE);
    $data = [$users_votes->getUserId(), $users_votes->getVoteId(), $users_votes->getVote()];

    if ($users_votes->voteForOnce()->num_rows == 0) {

        // first time to vote
        $users_votes->create();
        $voteData = $vote->setId($_GET['dislike'])->getVoteById()->fetch_object();
        $vote->setUser_id($_SESSION['user']->id)->setLike($voteData->dislike)->dislikes();
        if ($_SESSION['user']->status == 0) {
            $user->setId($_SESSION['user']->id)->updateColumn('status', ACTIVE);
        }
        $votes = $vote->read()->fetch_all();
        header("location:index.php");
    } else {
        $message[$_GET['dislike']] = "<i class='fas fa-exclamation-triangle'></i> You can vote only once";
        header("refresh:5 ;url=index.php");
    }
}
if (isset($_GET['vote']) && is_numeric($_GET['vote'])) {

    $thisVote = $vote->setId($_GET['vote'])->getVoteById()->fetch_object();
    $vote->setId($_GET['vote'])->delete();
    unlink("layouts/images/votes/{$thisVote->image}");
    $votes = $vote->read()->fetch_all();
    if($_GET['from'] == 'profile'){
        header("location:profile.php");
    }
}


?>


<section class="home bg-danger vh-100 d-flex justify-content-start align-items-center bg-img">
    <h1 class="font2 ms-5 ps-5 fs-8">Let’s Vote</h1>
</section>
<section class="votes py-5 ">
    <div class="container">
        <div class="row py-5">
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php
                foreach ($votes as $singleVote) {

                    $singleVote[2] = str_split($singleVote[2], 60);
                    $singleVote[7] = explode(' ', $singleVote[7]);
                    $singleVote[7] = $singleVote[7][0];
                    $singleVote[8] = explode(' ', $singleVote[8]);
                    $singleVote[8] = $singleVote[8][0];
                ?>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <?php
                        if (empty($message[$singleVote[0]])) {
                            $display = "d-none";
                        } else {
                            $display = "d-block";
                        }
                        ?>
                        <div class="card">
                            <div class="alert alert-danger p-2 position-absolute w-100 text-center <?= $display ?>" role="alert">
                                <?= $message[$singleVote[0]] ?? '' ?>
                            </div>
                            <img src="layouts/images/votes/<?= $singleVote[3] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?= $singleVote[1] ?></h5>
                                <p class="card-text"><?= $singleVote[2][0] ?> <a href="details.php?id=<?= $singleVote[0] ?>">More..</a></p>
                                <p class="card-text"><small class="text-muted"><?= empty($singleVote[8]) ? "Created at " . $singleVote[7]  : "Last updated " . $singleVote[8] ?></small></p>
                                <p class="float-end fs-6"><?= $singleVote[4] ?> <i class="far fa-thumbs-up  text-primary"></i> <?= $singleVote[5] ?> <i class="far fa-thumbs-down text-danger"></i></p>
                                <?php
                                $votingNum = $users_votes->setUserId($_SESSION['user']->id)->setVoteId($singleVote[0])->voteForOnce()->num_rows;
                                if(isset($_SESSION['user']) && $_SESSION['user']->id != $singleVote[6] && $votingNum > 0){
                                    $voteData = $users_votes->setUserId($_SESSION['user']->id)->setVoteId($singleVote[0])->voteForOnce()->fetch_object();
                                    if ($voteData->vote == 1) { ?>
                                        <p class="text-primary fs-5"> <i class="fas fa-thumbs-up"></i> I Like that </p>
                                    <?php 
                                    } else { ?>
                                        <p class="text-danger fs-5"> <i class="fas fa-thumbs-up"></i> I Don’t Like that </p>
                                    <?php
                                    }
                                } elseif (isset($_SESSION['user']) && $_SESSION['user']->id != $singleVote[6]) { ?>
                                    <a href="index.php?like=<?= $singleVote[0] ?>" class="btn btn-primary mt-2"> <i class="far fa-thumbs-up"></i> Like</a>
                                    <a href="index.php?dislike=<?= $singleVote[0] ?>" class="btn btn-danger mt-2"><i class="far fa-thumbs-down"></i> Dislike</a>

                                <?php
                                } elseif (isset($_SESSION['user']) && $_SESSION['user']->id == $singleVote[6]) { ?>
                                    <a href="index.php?vote=<?= $singleVote[0] ?>" class="btn btn-outline-danger  mt-2">Delete</a>
                                <?php 
                                } else { ?>
                                    <a href="login.php" class="btn btn-primary mt-2"><i class="far fa-thumbs-up"></i> Like</a>
                                    <a href="login.php" class="btn btn-danger mt-2"><i class="far fa-thumbs-down"></i> Dislike</a>
                                <?php } ?>
                            </div>
                        </div>

                    </div>

                <?php } ?>

            </div>

        </div>
    </div>
</section>




<?php
include "templates/footer.php";
