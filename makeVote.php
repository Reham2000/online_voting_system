<?php 


include "templates/header.php";
include "templates/navbar.php";


?>



<section class="messages py-5 container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5 col-sm-10 p-3 mt-5">
            <img src="layouts/images/vote2.png" alt="" class="w-100 h-100">
        </div>
        <form action="" class="col-sm-7 p-3 ">
            <h2 class="text-center col-12 pt-5  pb-3">Create A Vote</h2>
            <div class="col-12 form-group mb-3">
                <input class="form-control" type="text" placeholder="Title...">
            </div>

            <div class="col-12 form-group mb-5">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a description here" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Description</label>
                </div>
            </div>
            <div class="col-12 form-group mb-5">
                    <div class="input-group">
                        <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    </div>
                </div>
            <div class="col-12 form-group mb-3 text-center ">
                <button type="submit" class="btn btn-outline-dark py-2 px-4">Create</button>
            </div>
        </form>
    </div>
</section>



<?php
include "templates/footer.php";
