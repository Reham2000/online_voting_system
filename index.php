<?php

use App\Database\Models\Vote;

include "templates/header.php";
include "templates/navbar.php";

$vote = new Vote;
$votes = $vote->read()->fetch_all(); 

if(isset($_GET['like']) && is_numeric($_GET['like']))
{
    $vote->setId($_GET['like'])->setLike($votes[$_GET['like']][4])->likes();
    $votes = $vote->read()->fetch_all();
}
if(isset($_GET['dislike']) && is_numeric($_GET['dislike']))
{
    $vote->setId($_GET['dislike'])->setLike($votes[$_GET['dislike']][5])->dislikes();
    $votes = $vote->read()->fetch_all();
}


?>


<section class="home bg-danger vh-100 d-flex justify-content-start align-items-center bg-img">
    <h1 class="font2 ms-5 ps-5 fs-8">Let’s Vote</h1>
</section>
<?php //print_r($votes);die; ?>
<section class="votes py-5 ">
    <div class="container">
        <div class="row py-5">
            <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php
                foreach($votes as $singleVote){
                    $singleVote[2] = str_split($singleVote[2],60);
                    $singleVote[7] = explode(' ',$singleVote[7]);
                    $singleVote[7] = $singleVote[7][0];
                    $singleVote[8] = explode(' ',$singleVote[8]);
                    $singleVote[8] = $singleVote[8][0];
                    // print_r($singleVote);die;
            ?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card">
                        <img src="layouts/images/votes/<?= $singleVote[3] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $singleVote[1] ?></h5>
                            <p class="card-text"><?= $singleVote[2][0] ?> <a
                                    href="details.php?id=<?= $singleVote[0] ?>">More..</a></p>
                                    <p class="card-text"><small class="text-muted"><?= empty($singleVote[8]) ? "Created at ". $singleVote[7]  : "Last updated ".$singleVote[8] ?></small></p>
                            <p class="float-end fs-6"><?= $singleVote[4] ?> <i class="far fa-thumbs-up  text-primary"></i> <?= $singleVote[5] ?> <i
                                    class="far fa-thumbs-down text-danger"></i></p>
                            <?php
                            if(isset($_SESSION['user']) && $_SESSION['user']->id != $singleVote[6] )
                            { ?>
                                <a href="index.php?like=<?= $singleVote[0] ?>" class="btn btn-primary mt-2">Like</a>
                                <a href="index.php?dislike=<?= $singleVote[0] ?>" class="btn btn-danger mt-2">Dislike</a>
                            <?php }elseif(isset($_SESSION['user'])){ ?>
                                <a href="makeVote.php?vote=<?= $singleVote[0] ?>" class="btn btn-outline-dark  mt-2">Update</a>
                            <?php }else{ ?>
                                <a href="login.php" class="btn btn-primary mt-2">Like</a>
                                <a href="login.php" class="btn btn-danger mt-2">Dislike</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            <?php } ?>
                <!-- <div class="col-lg-4 col-md-6 col-sm-12">
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
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
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
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
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
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
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
            </div>

        </div>
    </div>
</section>




<?php
include "templates/footer.php";