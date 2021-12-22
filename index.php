<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Cars</title>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
              <h1 class="text-center">Cars</h1>
              <hr style="height: 1px; color:black;background-color:black;">
            </div>
        </div>
        <div class="row">
          <div class="col-md-5 mx-auto">
            <h2 class="text-center">Insert car:</h2>
            <form action="" method="post" id="form">
              <div id="result"></div>
              <div class="form-group">
                <label for="">Car brand:</label>
                <input type="text" id="car_brand" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Price</label>
                <input type="text" id="price" class="form-control">
              </div>
              <div class="form-group">
                <label for="car_models">Choose an car_model:</label>
                <select id="selectedcar_modelId">
                  <?php
                    include "model.php";
                    $model = new Model();
                    $car_models = $model->fetchcar_models();
                    foreach ($car_models as $car_model) {
                        echo "<option value='{$car_model['id']}'>{$car_model['car_model']}</option>";
                    }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <button type="submit" id="submit" class="btn btn-outline-primary">Submit</button>
              </div>
            </form>
            <h2 class="text-center">Insert a car model:</h2>
            <form action="" method="post" id="formcar_model">
              <div id="resultcar_model"></div>
              <div class="form-group">
                <label for="">Model name</label>
                <input type="text" id="car_model" class="form-control">
              </div>
              <div class="form-group">
                <button type="submit" id="submitcar_model" class="btn btn-outline-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mt-1">
            <div id="show"></div>
            <div id="fetch"></div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="readModal" tabindex="-1" aria-labelledby="readModalTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="readModalTitle">Record</h5>
          </div>
          <div class="modal-body">
            <div id="read_data"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalTitle">Edit Record</h5>
          </div>
          <div class="modal-body">
            <div id="edit_data"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="update">Update</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    <script>
      $(document).on("click", "#submit", function(e) {
        e.preventDefault();
        var car_brand = $("#car_brand").val();
        var price = $("#price").val();
        var selectedcar_modelId = $("#selectedcar_modelId").val();
        var submit = $("#submit").val();
        $.ajax({
          url: "insert.php",
          type: "post",
          data: {
            car_brand:car_brand,
            price:price,
            submit:submit,
            selectedcar_modelId:selectedcar_modelId
          },
          success: function(data) {
            fetch();
            $("#result").html(data);
          }
        });
        $("#form")[0].reset();
        $("#form")[1].reset();
      });

      $(document).on("click", "#submitcar_model", function(e) {
        e.preventDefault();
        var car_model = $("#car_model").val();
        var submitcar_model = $("#submitcar_model").val();
        $.ajax({
          url: "insertcar.php",
          type: "post",
          data: {
            car_model:car_model,
            submitcar_model:submitcar_model
          },
          success: function(data) {
            fetch();
            $("#resultcar_model").html(data);
          }
        });
        $("#formcar_model")[0].reset();
        $("#formcar_model")[1].reset();
      });

      // Fetch cars
      function fetch() {
        $.ajax({
          url: 'fetch.php',
          type: 'post',
          success: function(data) {
            $("#fetch").html(data)
          }
        });
      }

      // Delete car
      $(document).on('click', '#delete', function(e) {
        e.preventDefault();
        if (window.confirm('Do you want to delete the record?')) {
          var id = $(this).attr('value');
          $.ajax({
            url: "delete.php",
            type: "post",
            data: {
              id:id
            },
            success: function(data) {
              fetch();
              $("#show").html(data);
            }
          });
        }
        else {
          return false;
        }
      });

      // Read cars
      $(document).on('click', '#read', function(e) {
        e.preventDefault();
        var id = $(this).attr('value');
        $.ajax({
          url: 'read.php',
          type: 'post',
          data: {
            id:id
          },
          success: function(data) {
            $('#read_data').html(data);
          }
        })
      });

      // Edit Cars
      $(document).on('click', '#edit', function(e) {
        e.preventDefault();
        var id = $(this).attr('value');
        $.ajax({
          url: 'edit.php',
          type: 'post',
          data: {
            id:id
          },
          success: function(data) {
            $('#edit_data').html(data);
          }
        });
      });

      // Update cars
      $(document).on("click", "#update", function(e){
        e.preventDefault();
        var edit_id = $("#edit_id").val();
        var edit_car_brand = $("#edit_car_brand").val();
        var edit_price = $("#edit_price").val();
        var edit_car_modelId = $("#edit_car_modelId").val();
        var update = $("#update").val();
        $.ajax({
          url: "update.php",
          type: "post",
          data: { 
            edit_id:edit_id,
            edit_car_brand:edit_car_brand,
            edit_price:edit_price,
            edit_car_modelId:edit_car_modelId,
            update:update
          },
          success: function(data){
            fetch();
            $("#show").html(data);
          }
        });
      });
    </script>
  </body>
</html>