<?php 
include "templates/header.php";
include "templates/navbar.php";

?>

<!-- Start Body Section -->
<section class="login">
    <div class="container ">
        <div class="row vh-100 align-items-center ">
            <div class="col-md-6 col-sm-12 updateLogo h-50">
            </div>
            <form action="" class="col-md-6 col-sm-12 p-3 shadow">
                <h2 class="text-center col-12 pt-5  pb-3">Update My Profile</h2>
                <div class="col-12 form-group mb-3">
                    <input class="form-control" type="text" value="username">
                </div>
                <div class="col-12 form-group mb-3">
                    <input class="form-control" type="tel" value="0125">
                </div>
                <div class="col-12 form-group mb-3">
                    <input class="form-control" type="password" placeholder="Enter Your Password...">
                </div>
                <div class="col-12 form-group mb-3">
                    <input class="form-control" type="confirm_password" placeholder="Confirm Your Password...">
                </div>
                <div class="col-12 form-group mb-5">
                    <div class="input-group">
                        <input type="file" class="form-control" id="inputGroupFile04"
                            aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    </div>
                </div>
                <div class="col-12 form-group mb-3 text-center ">
                    <button type="submit" class="btn btn-outline-dark py-2 px-4">Update</button>
                </div>
            </form>

        </div>
    </div>
</section>
<!-- End Body Section -->


<?php

include "templates/footer.php";