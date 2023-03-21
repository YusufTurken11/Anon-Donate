<?php
    session_start(); ob_start();
    include 'ayarlar/db.php';
    include 'ayarlar/main_db.php';
    include 'partials/head.php';
    include 'ayarlar/sayfalar.php';

    if(isset($_GET["id"])){
        $id = $_GET["id"];
    

    $select_product = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $id") or die('query failed');
    if(mysqli_num_rows($select_product) > 0){
    while($fetch_product = mysqli_fetch_assoc($select_product)){
    
?>

<div style="box-shadow: 0 0 8px rgba(5,5,5,.3);" class="container">
    <form method="post" action="">

        <div class="row">
            <div class="text-center col-md-5 mt-5 mb-5">
                <img style="max-width: 500px; margin-left: 5%;" name="product_img"
                    class="bd-placeholder-img img-responsive" src="<?= $fetch_product['img_url']; ?>">
            </div>

            <div class="col-md-7">
                <h1 name="product_name" style="text-align: center; margin-top: 3%; ">
                    <b><?= $fetch_product['product_name']; ?></b>
                </h1>

                <h3 class="mt-4" style="text-align: center;"><u>Açıklama</u></h3>
                <p name="detail" style="text-align: center; margin-left: 5%; margin-right: 5%;" class="mt-4 mb-4">
                    <?= $fetch_product['detail']; ?></p>
                <h3 name="product_price" style="color: darkgreen; text-align: center;">
                    <b><?= $fetch_product['price']; ?>$</b>
                </h3>
                <input type="submit" value="Sepete Ekle" name="add_to_cart"
                    style="display: block; margin: auto; width: 250px; background-color: darkgreen; color:white"
                    class="btn btn-lg addToCartBtn mb-3"></input>

            </div>

        </div>

        <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>"></input>

    </form>

</div>

<?php
    }
  }
    }else{
        header('location:index.php');
    }
?>