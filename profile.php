<?php

use App\Database\Models\Vote;

include "templates/header.php";
include "App/Http/Middlewares/Auth.php";
include "templates/navbar.php";

// if(empty($_SESSION['user']->photo))
// {
//     $_SESSION['user']->photo = "default.png";
// }
$vote = new Vote;
$votes = $vote->setUser_id($_SESSION['user']->id)->getAllVotesByUserId()->fetch_all();

?>

<section class="profile container mt-5">
    <div class="row">
        <div class="col-md-3 col-sm-8 shadow px-3 text-center py-5 position-fixed vh-100">
            <div class="profile-img d-flex justify-content-center mt-5">
                <img draggable=false src="layouts/images/users/<?= $_SESSION['user']->photo ?>" alt="women" class="shadow">
            </div>
            <h3 class="fw-bolder text-center pt-3"><?= $_SESSION['user']->username ?></h3>
            <h6 class="fw-bold text-center pt-1 text-muted">0<?= $_SESSION['user']->phone ?></h6>

            <a href="update-profile.php" class="btn btn-dark my-3"><i class="fas fa-cog"></i> Settings</a>
        </div>
        
        <div class="col-md-8 col-sm-12 mb-5 p-3 py-5 ms-auto shadow">
        <?php
            if(empty($votes)){?>
                <div class="alert alert-danger " role="alert">
                <i class="fas fa-exclamation-triangle mx-3"></i> No Votes To Show Here
                </div>
            <?php }
        ?>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php
                foreach ($votes as $singleVote) {
                    $singleVote[2] = str_split($singleVote[2], 60);
                    $singleVote[7] = explode(' ', $singleVote[7]);
                    $singleVote[7] = $singleVote[7][0];
                    $singleVote[8] = explode(' ', $singleVote[8]);
                    $singleVote[8] = $singleVote[8][0];
                ?>
                    <div class="col-lg-6 col-sm-12">
                        <div class="card">
                            <img src="layouts/images/votes/<?= $singleVote[3] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?= $singleVote[1] ?></h5>
                                <p class="card-text"><?= $singleVote[2][0] ?> <a href="details.php?id=<?= $singleVote[0] ?>">More..</a></p>
                                <p class="card-text"><small class="text-muted"><?= empty($singleVote[8]) ? "Created at " . $singleVote[7]  : "Last updated " . $singleVote[8] ?></small></p>
                                <p class="float-end fs-6"><?= $singleVote[4] ?> <i class="far fa-thumbs-up  text-primary"></i> <?= $singleVote[5] ?> <i class="far fa-thumbs-down text-danger"></i></p>
                                <a href="index.php?from=profile&vote=<?= $singleVote[0] ?>" class="btn btn-outline-danger  mt-2">Delete</a>

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
