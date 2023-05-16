<?php
if($_SESSION['admin']->role == 2){
?>
<div class="bg-danger rounded text-center fs-2 p-3 w-50 my-5 mx-auto"><i class="fas fa-exclamation-triangle mx-2"></i>You Can’t Access This Page</div>

<?php
    header("refresh: 5 ; url=index.php");die;
}
