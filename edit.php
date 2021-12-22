<?php
    include 'model.php';
    $id = $_POST['id'];
    $model = new Model();
    $row = $model->edit($id);
    if (!empty($row)) { ?>
        <form id="form" action="post">
            <div>
                <input type="hidden" id="edit_id" value="<?php echo $row['id'] ?>">
            </div>
            <div class="form-group">
                <label for="">Car brand</label>
                <input type="text" id="edit_car_brand" class="form-control" value="<?php echo $row['car_brand']; ?>">
            </div>
            <div class="form-group">
                <label for="">Price</label>
                <input type="text" id="edit_price" class="form-control" value="<?php echo $row['price']; ?>">
            </div>
            <div class="form-group">
                <label for="edit_car_modelId">Choose a car:</label>
                <select id="edit_car_modelId">
                  <?php
                    $car_models = $model->fetchcar_models();
                    foreach ($car_models as $car_model) {
                        echo "<option value='{$car_model['id']}'>{$car_model['car_model']}}</option>";
                    }
                  ?>
                </select>
              </div>
        </form>
    <?php
    }
?>