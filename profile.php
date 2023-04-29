<?php
include "templates/header.php";
include "templates/navbar.php";

?>

<section class="profile container mt-5">
    <div class="row">
        <div class="col-md-3 col-sm-8 shadow px-3 text-center py-5 position-fixed vh-100">
            <div class="profile-img d-flex justify-content-center mt-5">
                <img src="layouts/images/person1.jpg" alt="women" class="shadow">
            </div>
            <h3 class="fw-bolder text-center pt-3">UserName</h3>
            <h6 class="fw-bold text-center pt-1 text-muted">01525478965</h6>
            
            <a href="update-profile.php" class="btn btn-outline-dark my-3">Update Profile</a>
        </div>
        <div class="col-md-8 col-sm-12 mb-5 p-3 py-5 ms-auto shadow">
        <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col-lg-6 col-sm-12">
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
                <div class="col-lg-6 col-sm-12">
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
                <div class="col-lg-6 col-sm-12">
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
                <div class="col-lg-6 col-sm-12">
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
                <div class="col-lg-6 col-sm-12">
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
            </div>
        </div>

    </div>
</section>


<?php
include "templates/footer.php";
