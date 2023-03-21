<?php

include 'db.php';

if (isset($_SESSION['Kullanici'])){

    if(isset($_POST['update_cart'])){
        $update_quantity = $_POST['cart_quantity'];
        $update_id = $_POST['cart_id'];
        if($update_quantity > 10000){
            $update_quantity = 10000;
        }
        mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
        echo '<div class="text-center alert alert-success">Sepetinizdeki Ürün Sayısı Güncellenmiştir</div>';

    }

    if(isset($_POST['delete_product'])){
        $remove_product = $_POST['id'];
        mysqli_query($conn, "DELETE FROM `cart` WHERE product_id = '$remove_product' and user_id = '$KullaniciId'") or die('query failed');
        
    }

    if(isset($_POST['delete_cart'])){
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$KullaniciId'") or die('query failed');
        
    }

    if(isset($_POST['buy'])){
        $total_price = 0;
        $cart_query = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
        $aciklama = $_POST['aciklama'];
        if(mysqli_num_rows($cart_query) > 0){
            while($fetch_cart = mysqli_fetch_assoc($cart_query)){
            $total = 0;
            $total = $fetch_cart['price']*$fetch_cart['quantity'];

        $KayıtSorgusu = $DBConnection->prepare("INSERT INTO orders (user_id, product_id, quantity, total_price) VALUES (?,?,?,?)");
        $KayıtSorgusu->execute([$KullaniciId, $fetch_cart['product_id'], $fetch_cart['quantity'], $total]);
        $KayıtSorgusuSayisi = $KayıtSorgusu->rowCount();
        $total_price = $total_price + $fetch_cart['price']*$fetch_cart['quantity'];

        }

        if($KayıtSorgusuSayisi > 0){
            $total_xmr = $total_price / $xmr;
            $yenibakiye = $KullaniciBakiye-$total_xmr;
            mysqli_query($conn, "UPDATE `users` SET balance = '$yenibakiye' WHERE id = '$KullaniciId'") or die('query failed');
            mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$KullaniciId'") or die('query failed');
            echo '<div class="text-center alert alert-success">Satın Alma İşlemi Başarılı! Yönlendiriliyorsunuz...</div>';
			header("refresh:3, url=index.php?page=17");
        }
    }
}

}

?>