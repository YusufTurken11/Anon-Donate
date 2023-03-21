<div class="container mt-4">
<div class="accordion" id="accordionExample">
<?php
    $select_sss = mysqli_query($conn, "SELECT * FROM `sss`") or die('query failed');
    if(mysqli_num_rows($select_sss) > 0){
    while($fetch_product = mysqli_fetch_assoc($select_sss)){
?>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $fetch_product['id']; ?>" aria-expanded="false">
        <?= $fetch_product['title']; ?>
      </button>
    </h2>
    <div id="collapse<?= $fetch_product['id']; ?>" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body text-center">
        <?= $fetch_product['description']; ?>
      </div>
    </div>
  </div>
<?php
    };
  };
?>
  </div>
</div>

<br><br><br><br><br><br>