<?php

use App\Database\Models\Vote;
use App\Services\Media;
use App\Http\Requests\Validation;

include "templates/header.php";
include "App/Http/Middlewares/Auth.php";
include "templates/navbar.php";
$main = "Create";
$validation = new Validation;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $validation->setInput('title')->setValue($_POST['title'])->required()->min(2);
    $validation->setInput('description')->setValue($_POST['description'])->required()->min(20);
    $validation->setInput('image')->setValue($_FILES['image']['name'])->required();
    if (isset($_FILES['image'])) {
        if ($_FILES['image']['error'] == 0) {
            $imageService = new Media;
            $imageService->setFile($_FILES['image'])->size(1024 * 1024)->extension(['png', 'jpg', 'jpeg']);
            if (empty($imageService->getErrors()) && empty($validation->getErrors())) {
                $imageService->upload('layouts/images/votes/');
                $vote = new Vote;
                $vote->setTitle($_POST['title'])->setDescription($_POST['description'])->setUser_id($_SESSION['user']->id)->setImage($imageService->getFileName());
                if ($vote->create()) {
                    header("location:profile.php");
                    die;
                } else {
                    $error = "<div class='alert alert-danger text-center fw-bold fs-4 p-0' role='alert'>Something Went Rong</div>";
                }
            }
        }
    }
}


?>



<section class="messages py-5 container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5 col-sm-10 p-3 mt-5">
            <img src="<?= $imagesPath ?>vote2.png" alt="" class="w-100 h-100">
        </div>
        <form action="" method="POST" class="col-sm-7 p-3 " enctype="multipart/form-data">
            <h2 class="text-center col-12 pt-5  pb-3"><?= $main ?> A Vote</h2>
            <div class="col-12 form-group mb-3">
                <input class="form-control" type="text" name="title" placeholder="Title..." value="<?= $validation->getOldValue('title') ?>">
                <?= $validation->getMessage('title'); ?>
            </div>

            <div class="col-12 form-group mb-5">
                <div class="form-floating">
                    <textarea class="form-control" name="description" rows="10" placeholder="Leave a description here" id="floatingTextarea"><?= $validation->getOldValue('description') ?></textarea>
                    <label for="floatingTextarea">Description</label>
                    <?= $validation->getMessage('description'); ?>
                </div>
            </div>
            <div class="col-12 form-group mb-5">
                <div class="input-group">
                    <input type="file" name="image" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    <?= isset($imageService) && $imageService->getError('size') ?>
                    <?= isset($imageService) && $imageService->getError('extension') ?>
                    <?= $successfullUpload ?? "" ?>
                    <?= $failedUpload ?? "" ?>
                </div>
                <?= $validation->getMessage('image'); ?>
            </div>
            <div class="col-12 form-group mb-3 text-center ">
                <button type="submit" class="btn btn-outline-dark py-2 px-4"><?= $main ?></button>
            </div>
        </form>
    </div>
</section>



<?php
include "templates/footer.php";
