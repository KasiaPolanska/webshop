<?php

class Manage_items_controller {
    private $conn;

    public function __construct($host, $dbname, $username, $password)
    {

        $conn = new PDO("mysql:host=".$host.";dbname=".$dbname.";",$username, $password);

        $this->conn = $conn;

    }

    public function save_items() 
    {
        $name = $_POST['txtName'];
        $type = $_POST['txtType'];
        $price = $_POST['txtPrice'];
        $image = $_POST['txtImage'];
    
        $query = "INSERT INTO product (name, type, price, image) VALUES (:name, :type, :price, :image)";
        $stm = $this->conn->prepare($query);
        $stm->bindparam(':name', $name);
        $stm->bindparam(':type', $type);
        $stm->bindparam(':price', $price);
        $stm->bindparam(':image', $image);
    
        if($stm->execute() == true) {
            echo "Artikel sucesvol toegevoegd.";
        }
        else {
            echo "Er is iets mis.";
        }
    }

    public function update($id, $name, $type, $price, $image)
    {
        $query = "UPDATE product SET name=:name, type=:type, price=:price, image=:image WHERE id = :id";
        $stm = $this->conn->prepare($query);
        $stm->bindparam("id:", $id);
        $stm->bindparam("name:", $name);
        $stm->bindparam(":type", $type);
        $stm->bindparam(":price", $price);
        $stm->bindparam(":image", $image);

        if($stm->execute() == true) {
            echo "Update gelukt.";
        }
        else {
            echo "Probeer nog een keer.";
        }
    }


    public function delete()
    {
        $id = $_GET['id'];
        $query = "DELETE FROM product WHERE id = $id";
        $stm = $this->conn -> prepare($query);
        if($stm->execute()) {
            echo "Product verwijderd.";
            header("Location: index.php", TRUE, 301);
            // exit();
        }
    }

    public function show_details($id)
    {
        
        $query = "SELECT * FROM product WHERE $id = :id";
        $stm = $this->conn->prepare($query);
        $stm->bindparam(":id", $id);
        if($stm->execute() == true) {
            $i = $stm->fetch(PDO::FETCH_OBJ);
            
            
            if($i != null)
            {
            ?>
            <div class="container">
                <form method="POST">
                    <input value="<?php echo $i->id; ?>" hidden type="text" name="txtId"/>
                    <input type="text" name="txtName" value="<?php echo $i->name;?>">
                    <input type="text" name="txtType" value="<?php echo $i->type;?>">
                    <input type="text" name="txtPrice" value="<?php echo $i->price;?>">
                    <input type="text" name="txtImage" value="<?php echo $i->image;?>">
                    <input type="submit" name="btnUpdate" value="Update">
                    <input type="submit" name="btnDelete" value="Delete">
                </form>
            </div>
            <?php
            }
        }
    } 
}
    ?>
