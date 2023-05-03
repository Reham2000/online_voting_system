<?php 

use App\Database\Models\User;
use App\Http\Requests\Validation;

include "templates/header.php";
include "App/Http/Middlewares/Guest.php";
include "templates/navbar.php";

$validation = new Validation;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $validation->setInput('username')->setValue($_POST['username'])->required()->exists('users','username');
    $validation->setInput('password')->setValue($_POST['password'])->required()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/',"Wrong Email Or Password");

    if(empty($validation->getErrors()))
    {
        $user = new User;
        $result = $user->setUsername($_POST['username'])->getUerByUsername()->fetch_object();
        if(password_verify($_POST['password'],$result->password))
        {
            $_SESSION['user'] = $result;
            header("location:index.php");die;
        }else
        {
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
            <h2 class="text-center col-12 pt-5  pb-3">Login</h2>
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
                <p class="text-center">Create an Account <a href="signup.php" class="text-decoration-none">Signup Now</a></p>
            </form>
        </div>
    </div>
</section>
<!-- End Body Section -->


<?php


include "templates/footer.php";


