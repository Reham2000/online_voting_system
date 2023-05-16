<?php
if(! isset($_SESSION['admin'])){
    header('location:login.php');die;
}
