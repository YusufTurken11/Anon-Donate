<?php

  if(isset($_SESSION['Kullanici'])){

    if(isset($_POST['add_to_cart'])){
      $product_id = $_POST['product_id'];

      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE product_id = '$product_id' AND user_id = '$KullaniciId'") or die('query failed');
      
      if(mysqli_num_rows($select_cart)){
        echo '<div class="text-center alert alert-danger">Bu Ürün Zaten Sepetinizde Bulunmaktadır!</div>';
      }else{
        $select_product = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$product_id' LIMIT 1") or die('query failed');
        $fetch_product = mysqli_fetch_assoc($select_product);
        $product_price = $fetch_product['price'];
        mysqli_query($conn, "INSERT INTO `cart` (user_id, product_id, price) VALUES('$KullaniciId', '$product_id', '$product_price')") or die('query failed');
        echo '<div class="text-center alert alert-success">Ürününüz Sepete Eklendi!</div>';
      }
      

    }

  }else if(isset($_POST['add_to_cart'])){
    echo '<div class="text-center alert alert-danger">Giriş yapmadan ürünlerinizi sepete ekleyemezsiniz! Yönlendiriliyorsunuz...</div>';
    header("refresh:2, url=index.php?page=3");
  }

?>