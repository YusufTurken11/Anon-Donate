<div class="row m-auto mt-4">
    <div class=".col-md-8 .offset-md-2">
        <table class="table table-hover table-bordered table-striped">
            <thead>
                <th style="background-color: darkblue; color: white;" class="text-center">Id</th>
                <th style="background-color: darkgreen; color: white;" class="text-center">Kullanıcı Id</th>
                <th style="background-color: darkblue; color: white;" class="text-center">Mesaj</th>
                <th style="background-color: darkgreen; color: white;" class="text-center">Oluşturulma Tarihi</th>
            </thead>

            <tbody>
                <?php
                    $message_query = mysqli_query($conn, "SELECT * FROM `contact_us`") or die('query failed');
                    if(mysqli_num_rows($message_query) > 0){
                        while($fetch_message = mysqli_fetch_assoc($message_query)){
                            $id = $fetch_message['id'];
                            $user_id = $fetch_message['user_id'];
                            $message = $fetch_message['message'];
                            $time = $fetch_message['time'];
                ?>
                <tr>
                    <td class="text-center"><?= $id ?></td>
                    <td class="text-center"><?= $user_id ?></td>
                    <td class="text-center" style="font-size: 15px;"><?= $message ?></td>
                    <td class="text-center"><?= $time ?></td>
                </tr>
                <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>