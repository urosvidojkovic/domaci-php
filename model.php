<?php

    Class Model{
        private $server = "localhost";
        private $username = "root";
        private $password;
        private $db = "phphomework";
        private $conn;

        public function __construct(){
            try {
                $this->conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            } catch (Exception $e) {
                echo "Connection failed" . e.getMessage();
            }
        }

        public function ret(){
            return $this->conn;
        }

        public function insert(){
            if (isset($_POST['submit'])) {
                if (isset($_POST['car_brand']) && isset($_POST['price']) && isset($_POST['selectedcar_modelId'])) {
                    if (!empty($_POST['car_brand']) && !empty($_POST['price']) && !empty($_POST['selectedcar_modelId'])) {
                        $car_brand = $_POST['car_brand'];
                        $price = $_POST['price'];
                        $selectedcar_modelId = $_POST['selectedcar_modelId'];
                        $query = "INSERT INTO cars (car_brand, price, car_model) VALUES ('$car_brand', '$price', '$selectedcar_modelId')";
                        if ($sql = $this->conn->exec($query)) {
                            echo "
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    car added successfully!
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>
                            ";
                        }
                        else {
                            echo "
                                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    Failed to add the car!
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>
                            ";
                        }
                    } else {
                        echo "
                            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                Empty field(s)!
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                        ";
                    }
                }
            }
        }

        public function insertcar(){
            if (isset($_POST['submitcar_model'])) {
                if (isset($_POST['car_model'])) {
                    if (!empty($_POST['car_model'])) {
                        $car_model = $_POST['car_model'];
                        $query = "INSERT INTO car_models (car_model) VALUES ('$car_model')";
                        if ($sql = $this->conn->exec($query)) {
                            echo "
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    car model added successfully!
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>
                            ";
                        }
                        else {
                            echo "
                                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    Failed to add the car model!
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>
                            ";
                        }
                    } else {
                        echo "
                            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                Empty field(s)!
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                        ";
                    }
                }
            }
        }

        public function fetch() {
            $data = null;
            $stmt = $this->conn->prepare("SELECT cars.id, cars.car_brand, cars.price, car_models.car_model FROM cars JOIN car_models on cars.car_model = car_models.id");
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;
        }

        public function fetchcar_models() {
            $data = null;
            $stmt = $this->conn->prepare("SELECT * FROM car_models");
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;
        }

        public function read($id) {
            $data = null;
            $stmt = $this->conn->prepare("SELECT cars.id, cars.car_brand, cars.price, car_models.car_model FROM cars JOIN car_models on cars.car_model = car_models.id WHERE cars.id='$id'");
            $stmt->execute();
            $data = $stmt->fetch();
            return $data;
        }

        public function delete($id){
            $query = "DELETE FROM cars WHERE id = '$id' ";
            if ($sql = $this->conn->exec($query)) {
                echo "
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        car deleted successfully!
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                    ";
            } else {
                echo "
                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        car not deleted!
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                ";
            }
        }

        public function edit($id) {
            $data = null;
            $stmt = $this->conn->prepare("SELECT * FROM cars WHERE id='$id'");
            $stmt->execute();
            $data = $stmt->fetch();
            return $data;
        }

        public function update($data) {
            $query = "UPDATE cars SET car_brand = '$data[edit_car_brand]', price = '$data[edit_price]', car_model = '$data[edit_car_modelId]'
            WHERE id='$data[edit_id]'";
      
            if ($sql = $this->conn->exec($query)) {
              echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    car updated successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <script>$("#editModal").modal("hide")</script>
                ';
            }else {
              echo '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    car not updated!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ';
            }
          }
    }

?>