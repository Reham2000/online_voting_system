<?php 
include "templates/header.php";
include "templates/navbar.php";

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
            <div class="col-12 row my-5 vh-100">
                <div class="col-4 h-100">
                    <img src="layouts/images/vote.jpg" alt="" class="w-100 h-100">
                </div>
                <div class="col-8 p-5">
                    <h2 class="card-title my-3">Card title</h2>
                    <p class="card-text">A book is a medium for recording information in the form of writing or images, typically composed of many pages (made of papyrus, parchment, vellum, or paper) bound together and protected by a cover.[1] The technical term for this physical arrangement is codex (plural, codices). In the history of hand-held physical supports for extended written compositions or records, the codex replaces its predecessor, the scroll. A single sheet in a codex is a leaf and each side of a leaf is a page.

As an intellectual object, a book is prototypically a composition of such great length that it takes a considerable investment of time to compose and still considered as an investment of time to read. In a restricted sense, a book is a self-sufficient section or</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    <p class="float-end fs-4">100 <i class="far fa-thumbs-up  text-primary"></i> 50 <i
                            class="far fa-thumbs-down text-danger"></i></p>
                    <a href="index.php?get=like" class="btn btn-primary mt-2">Like</a>
                    <a href="index.php?get=dislike" class="btn btn-danger mt-2">Dislike</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Details Section -->


<?php

include "templates/footer.php";