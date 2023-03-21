<?php
    if(isset($_SESSION['Kullanici'])){
        if($KullaniciTipi == 'admin'){
            ?>

<link rel="stylesheet" href="admin/admin.css">

<body>
    <div class="row m-auto mt-4">
        <div class=".col-md-8 .offset-md-2">
            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <th style="background-color: darkblue; color: white;" class="text-center">Id</th>
                    <th style="background-color: darkgreen; color: white;" class="text-center">E Posta</th>
                    <th style="background-color: darkblue; color: white;" class="text-center">Kullanıcı Adı</th>
                    <th style="background-color: darkblue; color: white;" class="text-center">Cüzdan Numarası</th>
                    <th style="background-color: darkgreen; color: white;" class="text-center">Bakiye</th>
                    <th style="background-color: darkblue; color: white;" class="text-center">Kullanıcı Tipi</th>
                    <th style="background-color: darkgreen; color: white;" class="text-center">Kayıt Tarihi</th>
                    <th style="background-color: darkgreen; color: white;" class="text-center">Kullanıcıyı Sil</th>
                </thead>

                <form method="post" action="">
                <tbody>
                <?php
                    $users_query = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
                    if(mysqli_num_rows($users_query) > 0){
                        while($admin_fetch_users = mysqli_fetch_assoc($users_query)){
                            $id = $admin_fetch_users['id'];
                            $email = $admin_fetch_users['email'];
                            $username = $admin_fetch_users['username'];
                            $wallet_number = $admin_fetch_users['wallet'];
                            $balance = $admin_fetch_users['balance'];
                            $user_type = $admin_fetch_users['user_type'];
                            $register_time = $admin_fetch_users['time'];
                ?>

                <tr>
                    <td class="text-center"><?= $id ?></td>
                    <td class="text-center"><?= $email ?></td>
                    <td class="text-center"><?= $username ?></td>
                    <td class="text-center"><?= $wallet_number ?></td>
                    <td class="text-center"><?= $balance ?></td>
                    <td class="text-center"><?= $user_type ?></td>
                    <td class="text-center"><?= $register_time ?></td>
                    
                        <td class="text-center">
                            <input type="submit" class="btn btn-danger" name="delete_button" value="Sil">
                        </td>
                    
                </tr>
                
                <?php
                        }
                    }
                    if(isset($_POST['delete_button'])){
                        if($user_type == "admin"){
                            echo '<div class="alert alert-danger text-center container">Admin Kullanıcıları Silmek İçin Yetkiniz Bulunmamaktadır!</div>';
                        }else{
                            mysqli_query($conn, "DELETE FROM users WHERE `users`.`id` = $id") or die('query failed');
                            header("refresh:0");
                        }
                    }
                ?>

                </tbody>
                </form>

            </table>

        </div>
        </div>
</body>

<?php
        }else{
            header("refresh:0, url=index.php?page=0");
        }
    }else{
        header("refresh:0, url=index.php?page=0");
    }
?>