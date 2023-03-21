<div class="row m-auto mt-4">
    <div class=".col-md-8 .offset-md-2">
        <table class="table table-hover table-bordered table-striped">
            <thead>
                <th style="background-color: darkblue; color: white;" class="text-center">Id</th>
                <th style="background-color: darkgreen; color: white;" class="text-center">Kullanıcı Id</th>
                <th style="background-color: darkblue; color: white;" class="text-center">Ürün Id</th>
                <th style="background-color: darkgreen; color: white;" class="text-center">Miktar</th>
                <th style="background-color: darkblue; color: white;" class="text-center">Toplam Tutar</th>
                <th style="background-color: darkgreen; color: white;" class="text-center">Sipariş Durumu</th>
                <th style="background-color: darkblue; color: white;" class="text-center">Sipariş Tarihi</th>
                <th style="background-color: darkgreen; color: white;" class="text-center"></th>
            </thead>

            <form action="" method="post">
                <tbody>
                    <?php
                    $order_query = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
                    if(mysqli_num_rows($order_query) > 0){
                        while($fetch_order = mysqli_fetch_assoc($order_query)){
                            $gelen_id = $fetch_order['id'];
                            $user_id = $fetch_order['user_id'];
                            $product_id = $fetch_order['product_id'];
                            $quantity = $fetch_order['quantity'];
                            $total_price = $fetch_order['total_price'];
                            $order_status = $fetch_order['order_status'];
                            $time = $fetch_order['time'];
                ?>
                    <tr>
                        <td class="text-center"><?= $gelen_id ?></td>
                        <td class="text-center"><?= $user_id ?></td>
                        <td class="text-center"><?= $product_id ?></td>
                        <td class="text-center"><?= $quantity ?></td>
                        <td class="text-center"><?= $total_price ?></td>
                        <td class="text-center">
                            <select class="form-select mb-2 text-center" aria-label="Default select example"
                                name="order_status">
                                <option selected><?= $order_status ?></option>
                                <option value="2">Onaylandı</option>
                                <option value="3">Alıcıya Ulaştırıldı</option>
                            </select>
                        </td>
                        <td class="text-center"><?= $time ?></td>
                        <td class="text-center">
                            <input type="submit" class="btn btn-success" name="update_button" value="Güncelle">
                            <input type="hidden" value=<?= $gelen_id ?> name="gelen_id">
                        </td>
                    </tr>
                    <?php

                if(isset($_POST['update_button'])){
                    $new_order_status = $_POST['order_status'];
                    $second_option = "Onaylandı";
                    $third_option = "Alıcıya Ulaştırıldı";
                    $gelen_id = $_POST['gelen_id'];
                    echo $gelen_id;
                    if($new_order_status == "2"){
                        mysqli_query($conn, "UPDATE `orders` SET `order_status` = '$second_option' WHERE `id` = '$gelen_id'") or die('query failed');
                        header("refresh:0");
                    }else if($new_order_status == "3"){
                        mysqli_query($conn, "UPDATE `orders` SET `order_status` = '$third_option' WHERE `orders`.`id` = '$gelen_id'") or die('query failed');
                        header("refresh:0");
                    }else{
                        header("refresh:0");
                    }
                }
                        }
                    }
                    
                    
            ?>
                </tbody>
            
        </table>
    </div>
</div>
</form>