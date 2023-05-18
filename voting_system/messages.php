<?php

use App\Database\Models\Message;
use App\Http\Requests\Validation;

include "templates/header.php";
include "App/Http/Middlewares/Auth.php";
include "templates/navbar.php";

$validation = new Validation;

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    echo 1;
    $validation->setInput('title')->setValue($_POST['title'])->required()->min(2)->max(60);
    $validation->setInput('message')->setValue($_POST['message'])->required()->min(2);

    if(empty($validation->getErrors()))
    {
        echo 2;
        $error = "<div class='alert alert-primary text-center fw-bold fs-4 p-0' role='alert'>Done !</div>";
        $message = new Message();
        $message->setTitle($_POST['title'])->setMessage($_POST['message'])->setUser_id($_SESSION['user']->id);
        if ($message->create()) {
            header("location:my_messages.php");
            die;
        } else {
            $error = "<div class='alert alert-danger text-center fw-bold fs-4 p-0' role='alert'>Something Went Rong</div>";
        }
    }

}

?>


<section class="messages py-5 container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5 col-sm-10 p-3 mt-5">
            <img src="<?= $imagesPath ?>undraw_Mail_sent_re_0ofv.png" alt="" class="w-100 h-100">
        </div>
        <form action="" method="POST" class="col-sm-7 p-3 ">
            <h2 class="text-center col-12 pt-5  pb-3">Send A Message</h2>
            <?= $error ?? '' ;?>
            <div class="col-12 form-group mb-3">
                <input class="form-control" name="title" type="text" placeholder="Title...">
                <?= $validation->getMessage('title'); ?>
            </div>

            <div class="col-12 form-group mb-5">
                <div class="form-floating">
                    <textarea class="form-control" name="message" placeholder="Leave a message here" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Message</label>
                </div>
                <?= $validation->getMessage('message'); ?>

            </div>
            <div class="col-12 form-group mb-3 text-center ">
                <button type="submit" class="btn btn-outline-dark py-2 px-4">Send</button>
            </div>
            <p class="text-center py-2">Keep In Touch With Us</p>
        </form>
    </div>
</section>


<?php
include "templates/footer.php";