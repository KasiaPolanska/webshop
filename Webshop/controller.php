<?php

class Controller {
    private $conn;

    public function __construct($host, $dbname, $username, $password)
    {

        $conn = new PDO("mysql:host=".$host.";dbname=".$dbname.";",$username, $password);

        $this->conn = $conn;

    }

    public function clean()
    {
        session_destroy();
    }
    
    //Show all products from db
    public function show_all_products()
    {
        $query = "SELECT * FROM product";

        $stm = $this -> conn -> prepare($query);

        if($stm->execute()) {
            $result = $stm -> fetchAll(PDO::FETCH_OBJ);
            foreach($result as $i) {
                ?>
                <div class='card'>
                    <img src='images/<?php echo $i->image ?>' class='card-img-top' alt='<?php echo $i->name?>'>
                    <div class='card-body'>
                        <h4><a href='details.php?id=<?php echo $i->id ?>'><?php echo $i->name ?></a></h4>
                        
                        <p class='card-text'><?php echo $i->type ?></p>
                        <h5>$<?php echo $i->price ?></h5>
                        <hr>
                        <form method='POST' action='index.php?action=add&id=<?php echo $i->id ?>'>
                            <input type='number' name='quantity' value='1'>
                            <input type='submit' name='btnAdd' value='Add'>
                            <input type='hidden' name='txtName' value='<?php echo $i->name ?>'>
                            <input type='hidden' name='txtPrice' value='<?php echo $i->price ?>'>
                        </form>
                    <a href='edit.php?id=<?php echo $i->id ?>'><i class='far fa-edit'></i></a>
                    
                    </div>
                </div><?php
               
            }
        }
    }

    // SHOW DETAILS PER PRODUCT
    public function show_one_product()
    {
        $id = $_GET['id'];

        $query = "SELECT * FROM product WHERE $id = :id";
        $stm = $this->conn->prepare($query);
        $stm->bindparam(":id", $id);

        if($stm->execute() == true) {
            $i = $stm->fetch(PDO::FETCH_OBJ);

            if($i != null)
            {
                
                ?>
                <div class='card'>
                    <img src='images/<?php echo $i->image?>' class='card-img-top' alt='<?php echo $i->name?>'>
                    <div class='card-body'>
                    <h4><a href='details.php?id=<?php echo $i->id ?>'><?php echo $i->name;?></a></h4>
                    
                    <p class='card-text'><?php echo $i->type?></p>
                    <h5>$<?php echo $i->price?></h5>
                    <hr>
                    <form method='POST'>
                        <input type='submit' name='btnAdd' value='Add'>
                    </form>
                    <a href='edit.php?id=".$i->id."'><i class='far fa-edit'></i></a>
                
                    </div>
                </div>
            <?php
            }
        }

    }

    // SEARCH
    public function geefOverzicht() 
    {

        $zoek = "%".$_POST['txtZoek']."%";
        $query = "SELECT * FROM product WHERE name LIKE :name";
        $stm = $this -> conn -> prepare($query);
        $stm->bindparam(":name", $zoek);
        if($stm->execute() == true) {
            $item = $stm-> fetchAll(PDO::FETCH_OBJ);
            foreach($item as $i) {
                ?>
                <div class='card'>
                    <img src='images/<?php echo $i->image ?>' class='card-img-top' alt='<?php echo $i->name?>'>
                    <div class='card-body'>
                        <h4><a href='details.php?id=<?php echo $i->id ?>'><?php echo $i->name ?></a></h4>
                        
                        <p class='card-text'><?php echo $i->type ?></p>
                        <h5>$<?php echo $i->price ?></h5>
                        <hr>
                        <form method='POST' action='index.php?action=add&id=<?php echo $i->id ?>'>
                            <input type='submit' name='btnAdd' value='Add'>
                            <input type='number' name='quantity' value='1'>  
                            <input type='hidden' name='txtName' value='<?php echo $i->name ?>'>
                            <input type='hidden' name='txtPrice' value='<?php echo $i->price ?>'>
                        </form>
                    <a href='edit.php?id=<?php echo $i->id ?>'><i class='far fa-edit'></i></a>
                    
                    </div>
                </div><?php
              
            }
        }
    }

    // SHOW LAST ADDED ITEM 
    public function show_last_one() 
    {
        $query = "SELECT * FROM product ORDER BY id DESC LIMIT 1";
        $stmt = $this->conn -> prepare($query);
        if($stmt->execute() == true) {
            $i = $stmt->fetch(PDO::FETCH_OBJ);
            ?>
                <div class='card'>
                    <img src='images/<?php echo $i->image ?>' class='card-img-top' alt='<?php echo $i->name?>'>
                    <div class='card-body'>
                        <h4><a href='details.php?id=<?php echo $i->id ?>'><?php echo $i->name ?></a></h4>
                        
                        <p class='card-text'><?php echo $i->type ?></p>
                        <h5>$<?php echo $i->price ?></h5>
                        <hr>
                        <form method='POST' action='index.php?action=add&id=<?php echo $i->id ?>'>
                            <input type='submit' name='btnAdd' value='Add'>
                            <input type='number' name='quantity' value='1'>  
                            <input type='hidden' name='txtName' value='<?php echo $i->name ?>'>
                            <input type='hidden' name='txtPrice' value='<?php echo $i->price ?>'>
                        </form>
                    <a href='edit.php?id=<?php echo $i->id ?>'><i class='far fa-edit'></i></a>
                    
                    </div>
                </div><?php
        }
    }

    public function save_items($name, $type, $price, $image) {
       
    
        $query = "INSERT INTO product (name, type, price, image) VALUES ('$name', '$type', $price, '$image')";
        $stm = $this->conn->prepare($query);
    
        if($stm->execute() == true) {
            header('Location: index.php');
        }
    }
}
?>