<?php
    if(isset($KullaniciTipi) and $KullaniciTipi == "admin"){
?>

<form action="" method="post">
<div class="container mt-3 mb-5">
    <h2 class="text-center"><u><b>Ürün Ekle</b></u></h2>
    <input type="text" class="form-control mt-3" placeholder="Ürün Adı" name="product_name">
    <div class="input-group mt-2">
        <span class="input-group-text">Detaylar</span>
        <textarea class="form-control" aria-label="With textarea" name="detail"></textarea>
    </div>
    <input type="text" class="form-control mt-2" placeholder="Fiyat" name="price">
    <input type="text" class="form-control mt-2" placeholder="Resim Kaynağı" name="image_source">
    <input type="text" class="form-control mt-2" placeholder="Kategori" name="categorie">
    <div class="text-center">
        <input type="submit" class="btn btn-warning btn-lg mt-3" name="add_to_products" value="Ürünü Ekle">
    </div>
</div>

<?php
    if(isset($_POST['add_to_products'])){
        $product_name = $_POST['product_name'];
        $details = $_POST['detail'];
        $price = $_POST['price'];
        $image_source = $_POST['image_source'];
        $categorie = $_POST['categorie'];

        if($product_name == "" and $details == "" and $price == "" and $image_source == "" and $categorie == ""){
            echo '<div class="text-center alert alert-danger">Ürün eklemek için formu eksiksiz doldurun!</div>';
        }else{
            $KayıtSorgusu = $DBConnection->prepare("INSERT INTO products (product_name, detail, price, img_url, categorie) VALUES (?,?,?,?,?)");
            $KayıtSorgusu->execute([$product_name, $details, $price, $image_source, $categorie]);
            $KayıtSorgusuSayisi = $KayıtSorgusu->rowCount();
            if($KayıtSorgusuSayisi > 0){
                echo '<div class="text-center alert alert-success">Ürün Eklendi</div>';
            }
        } 
    }
?>
</form>

<hr>

<div class="container text-center mt-5">
        <h2><b><u>Ürünler</u></b></h2>
</div>

<form action="" method="post">
<div class="row m-auto mt-4">
        <div class=".col-md-8 .offset-md-2">
            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <th style="background-color: darkblue; color: white;" class="text-center">Id</th>
                    <th style="background-color: darkgreen; color: white;" class="text-center">Ürün Adı</th>
                    <th style="background-color: darkblue; color: white;" class="text-center">Detaylar</th>
                    <th style="background-color: darkblue; color: white;" class="text-center">Fiyat</th>
                    <th style="background-color: darkgreen; color: white;" class="text-center">Resim Kaynağı</th>
                    <th style="background-color: darkblue; color: white;" class="text-center">Kategori</th>
                    <th style="background-color: darkgreen; color: white;" class="text-center"></th>
                </thead>

                <tbody>
                <?php
                    $product_query = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                    if(mysqli_num_rows($product_query) > 0){
                        while($fetch_product = mysqli_fetch_assoc($product_query)){
                            $id = $fetch_product['id'];
                            $urun_adi = $fetch_product['product_name'];
                            $detay = $fetch_product['detail'];
                            $fiyat = $fetch_product['price'];
                            $resim_kaynagi = $fetch_product['img_url'];
                            $kategori = $fetch_product['categorie'];
                ?>
                <tr>
                    <td class="text-center"><?= $id ?></td>
                    <td class="text-center"><?= $urun_adi ?></td>
                    <td class="text-center" style="font-size: 10px;"><?= $detay ?></td>
                    <td class="text-center"><?= $fiyat ?></td>
                    <td class="text-center"><?= $resim_kaynagi ?></td>
                    <td class="text-center"><?= $kategori ?></td>
                    <td class="text-center">
                        <input type="submit" class="btn btn-danger" name="delete_button" value="Sil">
                        <input type="hidden" value="<?= $id ?>" name="id">
                    </td>
                </tr>
                <?php
                if(isset($_POST['delete_button'])){
                    $gelen_id = $_POST['id'];
                    mysqli_query($conn, "DELETE FROM products WHERE `products`.`id` = $gelen_id") or die('query failed');
                    header("refresh:0");
                }
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
</form>

<?php
    }else{
        header("refresh:0, url=index.php");
    }
?>
