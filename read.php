<?php

    include 'model.php';
    $model = new Model();
    $row = $model->read($_POST['id']);
    if (!empty($row)) { ?>
        <p>Car brand - <?php echo $row['car_brand']; ?></p>
        <p>Price - <?php echo $row['price']; ?></p>
        <p>Car model - <?php echo "{$row['car_model']}}" ?></p>
    <?php
    }

?>