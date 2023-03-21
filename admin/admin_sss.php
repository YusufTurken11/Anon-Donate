<form action="" method="post">
<div class="container">
    <h2 class="text-center mt-3"><u><b>Soru Ekle</b></u></h2>
    <input type="text" class="form-control mt-3" placeholder="Soru" name="soru">
    <input type="text" class="form-control mt-3" placeholder="Cevap" name="cevap">
    <div class="text-center">
        <input type="submit" class="btn btn-warning btn-lg mt-3" name="add_to_sss" value="Soruyu Ekle">
    </div>

    <?php

    if(isset($_POST['add_to_sss'])){
        $soru = $_POST['soru'];
        $cevap = $_POST['cevap'];

        if($soru == "" or $cevap == ""){
            echo '<div class="text-center alert alert-danger mt-2">Soru eklemek için formu eksiksiz doldurun!</div>';
        }else{
            $KayıtSorgusu = $DBConnection->prepare("INSERT INTO sss (title, description) VALUES (?,?)");
            $KayıtSorgusu->execute([$soru, $cevap]);
            $KayıtSorgusuSayisi = $KayıtSorgusu->rowCount();
            if($KayıtSorgusuSayisi > 0){
                echo '<div class="text-center alert alert-success mt-2">Soru Eklendi</div>';
            }
        }
    }

?>

</div>



</form>

<hr>

<form action="" method="post">
<div class="row m-auto mt-4">
    <div class=".col-md-8 .offset-md-2">
        <table class="table table-hover table-bordered table-striped">
            <thead>
                <th style="background-color: darkblue; color: white;" class="text-center">Id</th>
                <th style="background-color: darkgreen; color: white;" class="text-center">Soru</th>
                <th style="background-color: darkblue; color: white;" class="text-center">Cevap</th>
                <th style="background-color: darkgreen; color: white;" class="text-center"></th>
            </thead>

            <tbody>
                <?php
                    $sss_query = mysqli_query($conn, "SELECT * FROM `sss`") or die('query failed');
                    if(mysqli_num_rows($sss_query) > 0){
                        while($fetch_sss = mysqli_fetch_assoc($sss_query)){
                            $id = $fetch_sss['id'];
                            $title = $fetch_sss['title'];
                            $description = $fetch_sss['description'];
                ?>
                <tr>
                    <td class="text-center"><?= $id ?></td>
                    <td class="text-center"><?= $title ?></td>
                    <td class="text-center"><?= $description ?></td>
                    <td class="text-center"><input type="submit" class="btn btn-danger" value="Sil" name="delete_button"></button></td>
                    <input type="hidden" value="<?= $id ?>" name="gelen_id">
                </tr>
                <?php
                    if(isset($_POST['delete_button'])){
                        $gelen_id = $_POST['gelen_id'];
                        mysqli_query($conn, "DELETE FROM sss WHERE `sss`.`id` = $gelen_id") or die('query failed');
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