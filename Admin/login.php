<?php

use App\Database\Models\Admin;
use App\Http\Requests\Validation;

include "includes/header.php";

include "App/Http/Middlewares/Guest.php";

$validation = new Validation;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $validation->setInput('username')->setValue($_POST['username'])->required()->exists('admins', 'username');
    $validation->setInput('password')->setValue($_POST['password'])->required()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/', "Wrong Email Or Password");

    if (empty($validation->getErrors())) {
        $admin = new Admin;
        $result = $admin->setUsername($_POST['username'])->getAdminByUsername()->fetch_object();
        if (password_verify($_POST['password'], $result->password)) {
            $_SESSION['admin'] = $result;
            header("location:index.php");
            die;
        } else {
            $error = "<div class='alert alert-danger text-center fw-bold fs-4 p-0' role='alert'>Something Went Rong</div>";
        }
    }
}

?>

<!-- Start Body Section -->
<section class="login">
    <div class="container ">
        <div class="row vh-100 align-items-center">
            <div class="col-md-6 col-sm-12 signupLogo h-50">
            </div>
            <form action="" method="POST" class="col-md-6 col-sm-12 p-3 ">
                <h1 class="text-center  text-info col-12 pt-5  pb-4">Online Voting System Dashbourd</h1>
                <h2 class="text-center col-12  pb-3">Login</h2>
                <div class="col-12 form-group mb-3">
                    <input class="form-control" name="username" value="<?= $validation->getOldValue('username') ?>" type="text" placeholder="Enter Your Username...">
                    <?= $validation->getMessage('username') ?>
                    <?= $error ?? "" ?>
                </div>
                <div class="col-12 form-group mb-5">
                    <input class="form-control" name="password" type="password" placeholder="Enter Your Password...">
                    <?= $validation->getMessage('password') ?>

                </div>
                <div class="col-12 form-group mb-3 text-center ">
                    <button type="submit" class="btn btn-outline-dark py-2 px-4">Login</button>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- End Body Section -->


<?php


include "templates/footer.php";
