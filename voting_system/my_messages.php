<?php

use App\Database\Models\Message;

include "templates/header.php";
include "App/Http/Middlewares/Auth.php";
include "templates/navbar.php";

$message = new Message; 
$messages = $message->setUser_id($_SESSION['user']->id)->read()->fetch_all();
if(isset($_GET['delete']) && is_numeric($_GET['delete']))
{
    $message->setId($_GET['delete']);
    if ($message->delete()) {
        header("location:my_messages.php");
        die;
    } else {
        $error = "<div class='alert alert-danger text-center fw-bold fs-4 p-0' role='alert'>Something Went Rong</div>";
    }
}

?>


<section class="messages py-5">
    <div class="container py-5">
        <a href="messages.php" class="btn btn-success mb-4 mx-5"><i class="far fa-envelope"></i> Send New Message</a>
        <?php
            if(empty($messages)){
?>
    <div class="alert alert-danger" role="alert">
    <i class="fas fa-exclamation-triangle mx-3"></i> No Messages You Send To Show Here 
    </div>
<?php
            }else{
            foreach($messages as $messageDate){
        ?>
        <div class="card my-2 mx-5">
            <div class="card-header">
                Message: <?= $messageDate[0] ?>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= ucwords($messageDate[1]) ?></h5>
                <p class="card-text ms-5"><i class="fas fa-envelope-open-text text-primary mx-2"></i> <?= ucfirst($messageDate[2]) ?></p>
                <p class="text-small text-muted"><?= $messageDate[3] ?></p>
                <?php
                if($messageDate[4] == '')
                {?>
                <p class="card-text shadow p-3 fs-5 text-danger ms-3">No Replay</p>
                <?php
                }else{ ?>
                <p class="fw-bold fst-italic ">Replay: </p>
                <p class="card-text text-muted fs-6 ms-5"><i class="fas fa-reply text-success mx-2"></i> <?= ucfirst($messageDate[4]) ?></p>
                <p class="text-small text-muted"><?= $messageDate[5] ?></p>
                <?php }
                ?>
                <a href="my_messages.php?delete=<?= $messageDate[0] ?>" class="btn btn-outline-danger">Delete</a>
            </div>
        </div>
        <?php } }?>
    </div>
</section>










<?php





include "templates/footer.php";