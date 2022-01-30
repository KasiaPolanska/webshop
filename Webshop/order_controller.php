<?php

class Order_controller {
    private $conn;

    public function __construct($host, $dbname, $username, $password)
    {

        $conn = new PDO("mysql:host=".$host.";dbname=".$dbname.";",$username, $password);

        $this->conn = $conn;

    }

    // ADD ITEM TO THE BASKET
    public function add_to_basket()
    {
        if(isset($_SESSION['shopping_cart']))
        {
            echo count($_SESSION["shopping_cart"]);
                $count = count($_SESSION["shopping_cart"]);
                $item_array = array(
                    'item_id' => $_GET['id'],
                    'name' => $_POST['txtName'],
                    'price' => $_POST['txtPrice'],
                    'quantity' => $_POST['quantity']
                );
                $_SESSION["shopping_cart"][$count] = $item_array;
                echo '<script>alert("Item added to the shopping cart")</script>';
        }
        else
        {
            $item_array = array (
                'item_id' => $_GET['id'],
                'name' => $_POST['txtName'],
                'price' => $_POST['txtPrice'],
                'quantity' => $_POST['quantity']
            );
            $_SESSION["shopping_cart"][0] = $item_array;
        }
    }

    // SHOW PRODUCTS IN BASKET
    public function basket()
    {
        if(!empty($_SESSION["shopping_cart"]))
        {
            $total = 0;
            foreach($_SESSION["shopping_cart"] as $key => $i)
            {
                
                ?>
                <tr>
                    <td width="25%"><?php echo $i['name']?></th>
                    <td width="15%"><?php echo $i['price']?></th>
                    <td width="5%"><?php echo $i['quantity']?></th>
                    <td width="15%"><?php $price = $i['quantity'] * $i['price'];
                    echo number_format($price, 2)?></th>
                    <td width="10%"><a href="basket.php?action=delete&id=<?php echo $i['item_id'];?>"><span class="text-danger">Remove</span></a></td>
                </tr>
                 
                <?php
                $this->remove_item();
            }           
            ?>

            <tr> 
                <?php foreach($_SESSION['shopping_cart'] as $item) 
                {
                    $total = $total + ($item['quantity'] * $item['price']);
                }
                ?>
                <?php  // $total = $total + ($i["quantity"] * $i["price"]);  ?> 
                <td colspan="3" align="right">Total</td>  
                <td align="right">$ <?php echo number_format($total, 2); ?></td>  
            </tr> 
            
            <?php
        }
        else
        {
            echo "Winkelmaandje is leeg.";
        }
    }

    // REMOVE ITEM FROM BASKET
    private function remove_item() {
        
        if(isset($_GET["action"])) {
            if($_GET["action"] == "delete")
            {
                foreach($_SESSION["shopping_cart"] as $key => $v)
                {
                    if($v["item_id"] == $_GET['id'])
                    {
                        unset($_SESSION["shopping_cart"][$key]);
                    }
                }
            }
        }
    }

    //SHOW CONTEN OF THE BASKET IN DROP DOWN MENU
    public function show_session() 
    {
        $total = 0;
        if(!empty($_SESSION["shopping_cart"]))
        {
            foreach($_SESSION["shopping_cart"] as $key => $i)
            {
                echo $i['name']."  ".$i['price']."</br>";
            }
        
            foreach($_SESSION['shopping_cart'] as $item)
            {
                $total = $total + ($item['quantity'] * $item['price']);
            }
            ?>
            <hr>
            <td colspan="4" align="right">Total</td>  
            <td align="right">$ <?php echo number_format($total, 2); ?></td>  
            <td></td>  
            <?php
        }

    }

    //SAVE ORDER
    public function save_customer($name, $lastName, $street, $postcode, $city)
    {
        $oid = session_id();
        $query = "INSERT INTO customer (name, lastName, street, postcode, city, orderId) VALUES ('$name', '$lastName', '$street', '$postcode', '$city', '$oid')";
        $stm = $this->conn->prepare($query);

        if($stm->execute() == true) 
        {
            echo "uw bestelling wordt verzonden naar: </br>"
            .$street."</br>".$postcode."</br>".$city;
        }
    }

    public function save_order()
    {
        
        foreach($_SESSION["shopping_cart"] as $i)
        {
            $oid = session_id();
            $iid = $i['item_id'];
            $q = $i['quantity'];
            $query = "INSERT INTO items (orderId, productId, quantity) VALUES ('$oid', $iid, $q)";
            $stm = $this->conn->prepare($query);
            $stm->execute();
        }
        echo "<i class='fas fa-shipping-fast'></i>";
        
    }

}

?>