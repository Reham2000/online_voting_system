<?php
include "templates/header.php";
include "App/Http/Middlewares/Auth.php";
include "templates/navbar.php";

use App\Services\Media;
use App\Database\Models\User;
use App\Http\Requests\Validation;

$validation = new Validation;
$user = new User;
$error = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['username'])) {
        $validation->setInput('username')->setValue($_POST['username'])->required()->min(2)->isChanged($_SESSION['user']->username)->unique('users', 'username');
        if ($validation->getChanged() == 1) {
            if (empty($validation->getErrors())) {
                $user->setId($_SESSION['user']->id)->setUsername($_POST['username'])->updateColumn('username', $_POST['username']);
                $_SESSION['user'] = $user->setId($_SESSION['user']->id)->getUserById()->fetch_object();
                header("location:update-profile.php");
            }
        }
    }
    if (isset($_POST['phone'])) {
        $validation->setInput('phone')->setValue($_POST['phone'])->required()->unique('users', 'phone')->regex('/^01[0125][0-9]{8}$/')->isChanged($_SESSION['user']->phone);
        if ($validation->getChanged() == 1) {
            if (empty(empty($validation->getErrors()))) {
                $user->setId($_SESSION['user']->id)->setPhone($_POST['phone'])->updateColumn('phone', $_POST['phone']);
                $_SESSION['user'] = $user->setId($_SESSION['user']->id)->getUserById()->fetch_object();
                header("location:update-profile.php");
            }
        }
    }
    if (isset($_FILES['photo'])) {
        $validation->setInput('photo')->setValue($_FILES['photo']['name'])->required();
        if (isset($_FILES['photo'])) {
            if ($_FILES['photo']['error'] == 0) {
                $imageService = new Media;
                $imageService->setFile($_FILES['photo'])->size(1024 * 1024)->extension(['png', 'jpg', 'jpeg']);
                if (empty($imageService->getErrors()) && empty($validation->getErrors())) {
                    $imageService->upload('layouts/images/users/');
                    if($_SESSION['user']->photo != 'default.png'){
                        $imageService->delete("layouts/images/users/{$_SESSION['user']->photo}");
                    }
                    $user->setId($_SESSION['user']->id)->setPhoto($imageService->getFileName())->updateColumn('photo', $imageService->getFileName());
                    $_SESSION['user'] = $user->setId($_SESSION['user']->id)->getUserById()->fetch_object();
                    $_SESSION['user']->photo = $imageService->getFileName();
                    header("location:update-profile.php");
                }
            }
        }
    }
    if(isset($_POST['password']) && isset($_POST['confirm_password']))
    {
        $validation->setInput('password')->setValue($_POST['password'])->required()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/','mini 8 chars max 32 ,mini one number , one character , one uppercase letter , one lowercase letter , one specidal char')->confirmed($_POST['confirm_password']);
        $validation->setInput('confirm_password')->setValue($_POST['confirm_password'])->required();
        if(empty($validation->getErrors()))
        {
            $user->setId($_SESSION['user']->id)->setPassword($_POST['password'])->updateColumn('password', password_hash($_POST['password'],PASSWORD_BCRYPT));
            $_SESSION['user'] = $user->setId($_SESSION['user']->id)->getUserById()->fetch_object();
            header("location:update-profile.php");
        }
    }

}
?>


<!-- Start Body Section -->
<section class="login">
    <div class="container ">
        <div class="row vh-100 align-items-center ">
            <div class="col-md-6 col-sm-12 updateLogo h-50">
            </div>
            <div class="col-md-6 col-sm-12 p-3 pt-5 mt-5 shadow position-relative">
                <div class="position-absolute updeted_img">
                    <div class="profile-img">
                        <img draggable=false src="layouts/images/users/<?= $_SESSION['user']->photo ?>" alt="women" class="shadow">
                    </div>
                </div>
                <form action="" method="POST" enctype="multipart/form-data" class="col-sm-11 mt-5 ">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" value="<?= $_SESSION['user']->username ?>" aria-describedby="button-addon2">
                        <button class="btn btn-warning rounded-end" type="submit" id="button-addon2">Change</button>
                    </div>
                </form>
                <?= "<div class='col-sm-11'>" . $validation->getMessage('username') . "</div>" ?>
                <form action="" method="POST" enctype="multipart/form-data" class="col-sm-11 mt-2">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="phone" value="0<?= $_SESSION['user']->phone ?>" aria-describedby="button-addon2">
                        <button class="btn btn-warning rounded-end" type="submit" id="button-addon2">Change</button>
                        <?= $validation->getMessage('phone'); ?>
                    </div>
                </form>
                <form action="" method="POST" enctype="multipart/form-data" class="col-sm-11 mt-2 ">
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" name="photo" aria-describedby="button-addon2">
                        <button class="btn btn-warning rounded-end" type="submit" id="button-addon2">Change</button>
                        <?= $validation->getMessage('photo'); ?>
                    </div>
                </form>
                <form action="" method="POST" enctype="multipart/form-data" class="col-sm-11 mt-2">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 form-group mb-1">
                            <input class="form-control" type="password" name="password" placeholder="Enter Your Password...">
                            <?= $validation->getMessage('password'); ?>
                        </div>
                        <div class="col-md-6 col-sm-12 form-group mb-1">
                            <input class="form-control" type="password" name="confirm_password" placeholder="Confirm Your Password...">
                            <?= $validation->getMessage('confirm_password'); ?>
                        </div>
                        <div class="col-12 form-group mb-3 text-center ">
                            <button type="submit" class="btn btn-warning py-2 px-3">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>




        </div>
    </div>
</section>
<!-- End Body Section -->


<?php


include "templates/footer.php";
