
<?php 
include "templates/header.php";
include "templates/navbar.php";

?>

<!-- Start Body Section -->
<section class="login">
    <div class="container ">
        <div class="row vh-100 align-items-center">
            <div class="col-md-6 col-sm-12 signupLogo h-50">
            </div>
            <form action="" class="col-md-6 col-sm-12 p-3 ">
            <h2 class="text-center col-12 pt-5  pb-3">Login</h2>
                <div class="col-12 form-group mb-3">
                    <input class="form-control" name="username" type="text" placeholder="Enter Your Username...">
                </div>
                <div class="col-12 form-group mb-5">
                    <input class="form-control" name="password" type="password" placeholder="Enter Your Password...">
                </div>
                <div class="col-12 form-group mb-3 text-center ">
                    <button type="submit" class="btn btn-outline-dark py-2 px-4">Login</button>
                </div>
                <p class="text-center">Create an Account <a href="signup.php" class="text-decoration-none">Signup Now</a></p>
            </form>
        </div>
    </div>
</section>
<!-- End Body Section -->


<?php

include "templates/footer.php";


