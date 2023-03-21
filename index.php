<?php
session_start(); ob_start();


include 'ayarlar/db.php';
include 'ayarlar/sayfalar.php';


if (isset($_SESSION['Kullanici'])){//Değer Çekme
    //echo $KullaniciWallet;
}


if (isset($_REQUEST['page'])){
    $RequestedPageNumber = $_REQUEST['page'];
}else{
    $RequestedPageNumber = "";
}

if ($RequestedPageNumber != 3){
    include 'ayarlar/cart_db.php';
}

if ($RequestedPageNumber != 3){
    include 'ayarlar/main_db.php';
}




if ($RequestedPageNumber != 3 and $RequestedPageNumber != 4 and $RequestedPageNumber != 5){
    include 'partials/head.php';
}

if($RequestedPageNumber == 18 or $RequestedPageNumber == 14 or $RequestedPageNumber == 15 or $RequestedPageNumber == 19 or $RequestedPageNumber == 20 or $RequestedPageNumber == 21){
    include 'admin/admin_categories.php';
}

if ($RequestedPageNumber != 1 and $RequestedPageNumber != 3 and $RequestedPageNumber != 4 and $RequestedPageNumber != 5 and $RequestedPageNumber != 6 and $RequestedPageNumber != 8 and $RequestedPageNumber != 2 and $RequestedPageNumber != 9 and $RequestedPageNumber != 7 and $RequestedPageNumber != 11 and $RequestedPageNumber != 12 and $RequestedPageNumber != 13 and $RequestedPageNumber != 16 and $RequestedPageNumber != 17 and $RequestedPageNumber != 18 and $RequestedPageNumber != 14 and $RequestedPageNumber != 15 and $RequestedPageNumber != 19 and $RequestedPageNumber != 20 and $RequestedPageNumber != 21){
    include 'partials/categories.php';
}

if ($RequestedPageNumber == 0 or $RequestedPageNumber == "" or $RequestedPageNumber > 20 or $RequestedPageNumber < 0){//Sayfa Sayısına Göre Değiştirmeyi UNUTMAAAA!!!
    include "main.php";
}else {
    include "$page[$RequestedPageNumber]";
}

if($RequestedPageNumber == 7 or $RequestedPageNumber == 11 or $RequestedPageNumber == 12 or $RequestedPageNumber == 13){
    include 'partials/categories.php';
}

if ($RequestedPageNumber != 3 and $RequestedPageNumber != 4 and $RequestedPageNumber != 5 and $RequestedPageNumber != 6 and $RequestedPageNumber != 16 and $RequestedPageNumber != 17 and $RequestedPageNumber != 18 and $RequestedPageNumber != 14 and $RequestedPageNumber != 15 and $RequestedPageNumber != 19 and $RequestedPageNumber != 20 and $RequestedPageNumber != 21){
    include 'partials/foot.php';
}
ob_end_flush();
?>