<?php
include "templates/header.php";
include "templates/navbar.php";

use App\Database\Models\User;
use App\Http\Requests\Validation;

$validation = new Validation;
$test = "Errors";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validation
    $validation->setInput('username')->setValue($_POST['username'])->required()->min(2)->max(32);
    $validation->setInput('phone')->setValue($_POST['phone'])->required()->regex('/^01[0125][0-9]{8}$/')->unique('users','phone');
    $validation->setInput('password')->setValue($_POST['password'])->required()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/','mini 8 chars max 32 ,mini one number , one character , one uppercase letter , one lowercase letter , one specidal char')->confirmed($_POST['confirm_password']);
    $validation->setInput('confirm_password')->setValue($_POST['confirm_password'])->required();
    $validation->setInput('image')->setValue('image')->required();
    // [
    //     'username' => ['required', 'string', 'min:2', 'max:32'],
    //     'phone' => ['required', 'regex:/^01[0125][0-9]{8}$/', 'unique:users,phone'],
    //     'password' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/', 'confirmed'],
    //     'confirm_password' => ['required'],
    //     'photo' => ['required']
    // ];


    if(empty($validation->getErrors()))
    {
        // No Validation Errors
        $test = "<div class='alert alert-primary text-center fw-bold fs-4 p-0' role='alert'>Done !</div>";
        $user =new User;
        $user->setUsername($_POST['username'])->setPhone($_POST['phone'])->setPassword($_POST['password'])->setPhoto($_POST['image']);
        if($user->create())
        {
            header("location:login.php");die;
        }
        else
        {
            $test = "<div class='alert alert-danger text-center fw-bold fs-4 p-0' role='alert'>Something Went Rong</div>";
        }

    }
    // print_r($validation->getError('username'));
}


// if (isset($_FILES['image'])) {
//     $errors = array();
//     $file_name = $_FILES['image']['name'];
//     $file_size = $_FILES['image']['size'];
//     $file_tmp = $_FILES['image']['tmp_name'];
//     $file_type = $_FILES['image']['type'];
//     $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

//     $expensions = array("jpeg", "jpg", "png");

//     if (in_array($file_ext, $expensions) === false) {
//         $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
//     }

//     if ($file_size > 2097152) {
//         $errors[] = 'File size must be excately 2 MB';
//     }

//     if (empty($errors) == true) {
//         move_uploaded_file($file_tmp, "layouts/images/users/" . $file_name);
//         echo "Success";
//     } else {
//         print_r($errors);
//     }
// }

?>

<!-- Start Body Section -->
<section class="signup">
    <div class="container ">
        <div class="row vh-100 align-items-center">
            <form action="" method="POST" class="col-md-6 col-sm-12 p-3" enctype="multipart/form-data">
                <h2 class="text-center col-12 pt-5  pb-3">Signup</h2>
                <?= $test ?>
                <div class="col-12 form-group mb-3">
                    <input class="form-control" type="text" name="username" value="<?= $validation->getOldValue('username'); ?>" placeholder="Enter Your Username...">
                    <?= $validation->getMessage('username'); ?>
                </div>
                <div class="col-12 form-group mb-3">
                    <input class="form-control" type="tel" name="phone" value="<?= $validation->getOldValue('phone') ?? ""; ?>" placeholder="Enter Your Phone Number...">
                    <?= $validation->getMessage('phone'); ?>
                </div>
                <div class="col-12 form-group mb-3">
                    <input class="form-control" type="password" name="password" placeholder="Enter Your Password...">
                    <?= $validation->getMessage('password'); ?>
                </div>
                <div class="col-12 form-group mb-3">
                    <input class="form-control" type="password" name="confirm_password" placeholder="Confirm Your Password...">
                    <?= $validation->getMessage('confirm_password'); ?>
                </div>
                <div class="col-12 form-group mb-5">
                    <div class="input-group">
                        <input type="file" name="image" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    <?= $validation->getMessage('image'); ?>
                    </div>
                </div>
                <div class="col-12 form-group mb-3 text-center ">
                    <button type="submit" class="btn btn-outline-dark py-2 px-4">Signup</button>
                </div>
                <p class="text-center">Already have an Account <a href="login.php" class="text-decoration-none">Login
                        Now</a></p>
            </form>
            <div class="col-md-6 col-sm-12 signupLogo h-50">
            </div>
        </div>
    </div>
</section>
<!-- End Body Section -->


<?php


include "templates/footer.php";
