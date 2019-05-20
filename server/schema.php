<?php

    class Model{
        private $dsn = "mysql:host=localhost; port=3306; dbname=ecomm";
        public $username = "root";
        public $db;
        private $pwd = "";

        public function __construct(){
            $this->db = new PDO($this->dsn, $this->username, $this->pwd, array(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            ));
        }

        function getProduct($limit, $skip){
            $limitval = (int)$limit;
            $skipval = (int)$skip;
            $stmt = $this->db->prepare("SELECT * FROM product_tbl limit $skipval, $limitval");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        function getProductPerUser($id){
            $stmt = $this->db->prepare("SELECT product_name, descr, price, stocks FROM product_tbl where owner_id = :id");
            $stmt->execute(array(
                ':id' => $id
            ));
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        function loging($email, $pword){
            $stmt = $this->db->prepare("SELECT * FROM admin_users Where email=:email and pword=:pword");
            $stmt->execute(array(
                ':email' => $email,
                ':pword' => $pword
            ));
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        function insertProduct($data){
            $owner_id = (isset($data['owner_id'])) ? $data['owner_id'] : '';
            $product_name = (isset($data['product_name'])) ? $data['product_name'] : '';
            $price = (isset($data['price'])) ? $data['price'] : '';
            $stocks = (isset($data['stocks'])) ? $data['stocks'] : '';
            $desc = (isset($data['desc'])) ? $data['desc'] : '';
            $image = (isset($data['image'])) ? $data['image'] : '';
            $stmt = $this->db->prepare("INSERT INTO product_tbl (owner_id, product_name, descr, price, stocks, img) VALUES(:owner_id, :product_name, :descr, :price, :stocks, :img)");
            $result = $stmt->execute(array(
                ':owner_id' => $owner_id,
                ':product_name' => $product_name,
                ':descr' => $desc,
                ':price' => $price,
                ':stocks' => $stocks,
                ':img' => $image
            ));
             return $result;
        }

        function logInUser($data){
            $email = (isset($data['email'])) ? $data['email'] : '';
            $pword = (isset($data['pword'])) ? $data['pword'] : '';

            $stmt = $this->db->prepare("SELECT * FROM cosumer_tbl where email = :email and pword = :pword");
            $stmt->execute(array(
                ':email' => $email,
                ':pword' => $pword
            ));
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

?>
