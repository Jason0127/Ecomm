<?php
    include_once 'schema.php';

    $obj = new Model();

    if(isset($_GET['getProduct'])){
        echo json_encode($obj->getProduct($_GET['limit'], $_GET['skip']));
    }

    if(isset($_GET['getPrductPerUser'])){
        if(isset($_GET['auth'])){
            if(!empty($_GET['auth'])){
                $id = $_GET['auth'];
                echo json_encode($obj->getProductPerUser($id));
            }
        }
    }

    if(isset($_POST['AdminLogin'])){
        $email = (isset($_POST['email'])) ? $_POST['email'] : '';
        $pword = (isset($_POST['pword'])) ? $_POST['pword'] : '';
        if(empty($email) || empty($pword)){
            echo '0';
        }else{
            $result = $obj->loging($email, $pword);
            if(empty($result) || !$result || $result == ''){
                echo 'invalid';
            }else{
                setcookie('username', $result['id'], time() + 3600, '/');
                echo json_encode($result);
            }
        }
    }
    

    if(isset($_POST['add_prod'])){
        $owner_id = (isset($_POST['data']['auth'])) ? $_POST['data']['auth'] : '';
        $product_name = (isset($_POST['data']['product_name'])) ? $_POST['data']['product_name'] : '';
        $price = (isset($_POST['data']['price'])) ? $_POST['data']['price'] : '';
        $stocks = (isset($_POST['data']['stocks'])) ? $_POST['data']['stocks'] : '';
        $desc =  (isset($_POST['data']['desc'])) ? $_POST['data']['desc'] : '';
        $image =  (isset($_POST['data']['image'])) ? $_POST['data']['image'] : '';

        $data = array(
            'owner_id' => $owner_id,
            'product_name' => $product_name,
            'price' => $price,
            'stocks' => $stocks,
            'desc' => $desc,
            'image' => $image
        );

        echo  $obj->insertProduct($data);
    }
    
    if(isset($_POST['login'])){
        $email = (isset($_POST['data']['email'])) ? $_POST['data']['email'] : '';
        $pword = (isset($_POST['data']['pword'])) ? $_POST['data']['pword'] : '';

        $data = array(
            'email' => $email,
            'pword' => $pword
        );

        if(empty($email) && empty($pword)){
            echo false;
        }else{
            $result = $obj->logInUser($data);
            if($result == '' || empty($result) || !$result){
                echo 'invalid';
            }else{
                setcookie('userAuth', $result['id'], time() + 3600, '/');
                echo json_encode($result);
            }
        }
        
    }

    if(isset($_GET['isAuth'])){
        $id = (isset($_GET['id'])) ? $_GET['id'] : '';
        if(empty($id) || $id == ''){
            echo false;
        }else{
            $result = $obj->auth($id);
            echo json_encode($result);
        }
    }

    if(isset($_POST['logoutUser'])){
        $id = (isset($_POST['id'])) ? $_POST['id'] : '';

        if(empty($id) || $id == ''){
            echo 'failed to logout';
        }else{
            setcookie('userAuth', $id, time() - 900000, '/');
        }
    }

    if(isset($_POST['addtocart'])){
        $item = (isset($_POST['item'])) ? $_POST['item'] : '';
        $item_json = json_encode($item);
        $id = (isset($_POST['id'])) ? $_POST['id'] : '';
        $result = $obj->addToCart($item_json, $id);
        print_r($result);
    }

    if(isset($_GET['getCart'])){
        $id = (isset($_GET['id'])) ? $_GET['id'] : '';
        if(empty($id) || $id == '' || !$id){
            echo false;
        }else{
            $result = $obj->getUserCart($id);
            echo $result['cart_tbl'];
        }
    }
?>