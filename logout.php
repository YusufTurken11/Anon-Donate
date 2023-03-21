<?php
if (isset($_SESSION['Kullanici'])){
    session_destroy();
    header("Location:index.php");
}else{
    header("Location:index.php?page=3");
    exit();
}