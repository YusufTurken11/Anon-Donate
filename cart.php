<?php 
if (isset($_SESSION['Kullanici'])){


?>


<link rel="stylesheet" href="../styles/cart.css">

<div class="container">

    <br>


    <br><br>

    <div class="row">
        <div class=".col-md-8 .offset-md-2">

            <table class="table table-hover table-bordered table-striped">

                <thead>
                    <th style="background-color: darkgreen; color: white;" class="text-center">Ürün Resmi</th>
                    <th style="background-color: darkgreen; color: white;" class="text-center">Ürün Adı</th>
                    <th style="background-color: darkgreen; color: white;" class="text-center">Fiyatı</th>
                    <th style="background-color: darkgreen; color: white;" class="text-center">Adedi</th>
                    <th style="background-color: darkgreen; color: white;" class="text-center">Toplam Fiyat</th>
                    <th style="background-color: darkgreen; color: white;" class="text-center">Sepetten Çıkar</th>
                </thead>

                <tbody>

                <?php
                    $grand_total = 0;
                    $grand_total_xmr = 0;
                    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` where user_id = $KullaniciId") or die('query failed');
                    if(mysqli_num_rows($cart_query) > 0){
                    while($fetch_cart = mysqli_fetch_assoc($cart_query)){
                        $product_id = $fetch_cart['product_id'];
                        $select_product = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$product_id' LIMIT 1") or die('query failed');
                        $fetch_product = mysqli_fetch_assoc($select_product);
                ?>

                        <tr>
                        <td class="text-center" width="300px">
                            <img src="<?= $fetch_product['img_url']; ?>" alt="" width="120px">
                        </td>

                        <td class="text-center"><?= $fetch_product['product_name']; ?></td>
                        <td class="text-center"><strong><?= $fetch_product['price']; ?>$</strong></td>
                        <td class="text-center">
                    <form action="" method="post">
                        <input type = "hidden" name = "cart_id" value="<?= $fetch_cart['id']; ?>">
                        <input class="text-center" type = "number" min="1" name="cart_quantity" value="<?= $fetch_cart['quantity']; ?>">
                        <input type = "submit" name="update_cart" value="Güncelle" class="btn btn-secondary">
                        <input type="hidden" name="id" value="<?= $fetch_product['id']; ?>">

                        <td class="text-center">
                        <?php echo $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'] ?>$
                        </td>

                        <td class="text-center"><input type = "submit" name="delete_product" value="Sepetten Kaldır" class="btn btn-warning" onclick="return confirm('Sepetinizdeki <?= $fetch_product['product_name']; ?> ürününü kaldırmak istediğinize emin misiniz?')"></td>    

                    </form>
                    </td>
                        
                </tr>
                        
                <?php
                        $grand_total += $sub_total;
                        $grand_total_xmr = $grand_total / $xmr;
                    };
                    };
                ?>

                </tbody>

                <tfoot>

                    <th colspan="1" class="text-center">
                        <big>Bakiyeniz: <?= $KullaniciBakiye; ?> XMR</big>
                    </th>
                    
                    <th colspan="3" class="text-center">
                    <big>Toplam Tutar: <?= $grand_total; ?></big><span class="text-secondary"><big>$</big></span><br><big>Toplam Tutar: <?= $grand_total_xmr; ?> </big><span class="text-secondary"><big>XMR</big></span>
                    </th>

                    <form action="" method="post">
                    <th colspan="2" class="text-center">
                    <input type = "submit" name="delete_cart" value="Sepeti Temizle" class="btn btn-danger" onclick="return confirm('Sepetinizdeki tüm ürünleri silmek istediğinizden emin misiniz?')">
                    </th>
                    </form>
                    
                    
                </tfoot>
                
                

            </table>

            <?php
                if($grand_total_xmr == 0 or $grand_total_xmr > $KullaniciBakiye){
            ?>
            <div class="cart-btn text-center" >
            <input class="text-center btn btn-primary btn-lg" type = "button" value="Satın Al" disabled>
            <p class="mt-3 text-center text-danger"><big><b>Toplam XMR tutarınız toplam tutardan fazla olunca veya sepet tutarı 0$'ın üstünde olduğu zaman<br> Satın Al butonu açılacaktır!</b></big></p>
            </div>
            <?php
            }else{?>
                <form action="" method="post";>
                <div class="cart-btn text-center" >
                <input name="buy" class="text-center btn btn-primary btn-lg" type="submit" value="Satın Al">
                <p class="mt-3 text-center text-danger"><big><b>Dikkat! Satın Al butonuna bastıktan sonra işlem farklı bir aşama olmadan tamamlanacaktır.</b></big></p>
                </div>
                </form>
            <?php
            }
            ?>

        </div>
    </div>
</div>

<?php }else{
    header('location:index.php');
}?>