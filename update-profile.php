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
$test = [];
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $username = $validation->setInput('username')->setValue($_POST['username'])->isChanged($_SESSION['user']->username);
    $phone = $validation->setInput('phone')->setValue($_POST['phone'])->isChanged($_SESSION['user']->phone);
    $password = $validation->setInput('password')->setValue($_POST['password'])->isChanged($_SESSION['user']->password);
    $image = $validation->setInput('image')->setValue($_FILES['image']['name'])->isChanged($_SESSION['user']->photo);
    $test[0]= 0;
    print_r($username);die;
    if($username->getChanged() == 1 )
    {
    $test[1]= 1;

        $validation->setInput('username')->setValue($_POST['username'])->required()->min(2)->max(32)->unique('users','username');
    $test[2]= 2;
        
        if(empty($validation->getError('username')))
        {
    $test[3]= 3;

            $user->setId($_SESSION['user']->id)->updateColumn('username',$_POST['username']);
            $_SESSION['user']->username = $_POST['username'];
    $test[4]= 4;

        }
    }
    // if($phone->getChanged() == 1 )
    // {
    //     $validation->setInput('phone')->setValue($_POST['phone'])->required()->regex('/^01[0125][0-9]{8}$/')->unique('users','phone');
    //     $user->setId($_SESSION['user']->id)->updateColumn('phone',$_POST['phone']);
    //     $_SESSION['user']->phone = $_POST['phone'];

    // }
    // if($password->getChanged() == 1 )
    // {
    //     $validation->setInput('password')->setValue($_POST['password'])->required()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/','mini 8 chars max 32 ,mini one number , one character , one uppercase letter , one lowercase letter , one specidal char')->confirmed($_POST['confirm_password']);
    //     $validation->setInput('confirm_password')->setValue($_POST['confirm_password'])->required();
    //     $_SESSION['user']->password = password_hash($_POST['password'],PASSWORD_BCRYPT);

    // }
    // if($image->getChanged() == 1 )
    // {
    //     $validation->setInput('image')->setValue($_FILES['image']['name'])->required();
    //     if (isset($_FILES['image'])) {
    //         if ($_FILES['image']['error'] == 0) {
    //             $imageService = new Media;
    //             $imageService->setFile($_FILES['image'])->size(1024 * 1024)->extension(['png', 'jpg', 'jpeg']);
    //             if (empty($imageService->getErrors()) && empty($validation->getErrors())) {
    //                 $imageService->upload('layouts/images/users/');
    //                 $imageService->delete("layouts/images/users/{$_SESSION['user']->photo}");
    //                 $user->setId($_SESSION['user']->id)->updateColumn('photo',$imageService->getFileName());

    //                     header("refresh: 5 ;url=profile.php");
                    
    //                 // if ($vote->create()) {
    //                 //     header("refresh: 5 ;url=profile.php");
    //                 //     die;
    //                 // } else {
    //                 //     $error = "<div class='alert alert-danger text-center fw-bold fs-4 p-0' role='alert'>Something Went Rong</div>";
    //                 // }
    //             }
    //         }
    //     }
    //     $user->setId($_SESSION['user']->id)->updateColumn('username',$_POST['username']);
    //     $_SESSION['user']->photo = $_POST['image'];

    // }

}
?>

<!-- Start Body Section -->
<section class="login">
    <div class="container ">
        <div class="row vh-100 align-items-center ">
            <div class="col-md-6 col-sm-12 updateLogo h-50">
            </div>
            <form action="" method="POST" enctype="multipart/form-data" class="col-md-6 col-sm-12 p-3 shadow">
                <h2 class="text-center col-12 pt-5  pb-3">Update My Profile</h2>
                <?= $error ?>
                <?php //foreach($test as $val) {echo $val; }?>

                <div class="col-12 form-group mb-3">
                    <input class="form-control" type="text" name="username" value="<?= $_SESSION['user']->username ?>">
                    <?= $validation->getMessage('username'); ?>
                </div>
                <div class="col-12 form-group mb-3">
                    <input class="form-control" type="tel" name="phone" value="<?= $_SESSION['user']->phone ?>">
                    <?= $validation->getMessage('phone'); ?>
                </div>
                <div class="col-12 form-group mb-3">
                    <input class="form-control" type="password" name="password" placeholder="Enter Your Password...">
                    <?= $validation->getMessage('password'); ?>
                </div>
                <div class="col-12 form-group mb-3">
                    <input class="form-control" type="confirm_password" name="confirm_password" placeholder="Confirm Your Password...">
                    <?= $validation->getMessage('confirm_password'); ?>
                </div>
                <div class="col-12 form-group mb-5">
                    <div class="input-group">
                        <input type="file" name="image" class="form-control" id="inputGroupFile04"
                            aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        </div>
                        <?= $validation->getMessage('image'); ?>
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