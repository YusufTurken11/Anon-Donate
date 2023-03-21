<?php
if (isset($_SESSION['Kullanici'])){

}else{
    header('location:index.php');
}
?>

<div class="container">
    <h1 class="text-center"><p class="mt-4" style="font-size: 40px;"><strong><u>Siparişler</u></strong></p></h1>
    <?php
        $select_siparisler = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = $KullaniciId") or die('query failed');
        if(mysqli_num_rows($select_siparisler) > 0){
    ?>

    <div class="row">
        <div class=".col-md-8 .offset-md-2">
            <table class = "table table-hover table-bordered table-striped">
                <thead>
                    <th style="background-color: darkgreen; color: white;" class="text-center">Sipariş Numarası</th>
                    <th style="background-color: darkgreen; color: white;" class="text-center">Ürün Adı</th>
                    <th style="background-color: darkgreen; color: white;" class="text-center">Sipariş Adedi</th>
                    <th style="background-color: darkgreen; color: white;" class="text-center">Fiyatı</th>
                    <th style="background-color: darkgreen; color: white;" class="text-center">Sipariş Durumu</th>
                </thead>
                <tbody>

                <?php
                    while($fetch_siparis = mysqli_fetch_assoc($select_siparisler)){
                        $product_id = $fetch_siparis['product_id'];
                        $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $product_id") or die('query failed');
                        $select_product = mysqli_fetch_assoc($select_products);
                ?>
                    
                    <tr>
                        <td class="text-center"><?= $fetch_siparis['id']; ?></td>
                        <td class="text-center"><?= $select_product['product_name']; ?></td>
                        <td class="text-center"><?= $fetch_siparis['quantity']; ?></td>           
                        <td class="text-center"><?= $fetch_siparis['total_price']; ?>$</td>    
                        <td class="text-center"><?= $fetch_siparis['order_status']; ?></td>
                    </tr>
        

                <?php
                }
                }else{
                    echo '<div class="text-center alert alert-danger">Henüz Bir Siparişiniz Bulunmamaktadır!</div>';
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>

</div>