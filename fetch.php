<?php 

    include 'model.php';
    $model = new Model();
    $rows = $model->fetch();

?>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Car brand</th>
            <th>Price</th>
            <th>Car model</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $i = 1;
            if (!empty($rows)) {
                foreach ($rows as $row) { ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['car_brand']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['car_model']; ?></td>
                        <td>
                            <a href='#' id='read' class='btn btn-primary' value='<?php echo $row['id'] ?>' data-bs-toggle="modal" data-bs-target="#readModal">Read</a>
                            <a href='#' id='delete' class='btn btn-danger' value='<?php echo $row['id'] ?>'>Delete</a>
                            <a href='#' id='edit' class='btn btn-warning' value='<?php echo $row['id'] ?>' data-bs-toggle="modal" data-bs-target="#editModal">Edit</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "
                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        No data to show!
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                ";
            }
        ?>
    </tbody>
</table>