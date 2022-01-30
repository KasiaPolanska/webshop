<?php
include('header.php');
?>
    <div class="container">
        <form method="POST">
            <input type="text" name="txtName" placeholder="Product name">
            <input type="text" name="txtType" placeholder="Product type">
            <input type="text" name="txtPrice" placeholder="Price">
            <input type="text" name="txtImage">
            <input type="submit" name="btnSave" value="Opslaan">
        </form>

        <?php

        if(isset($_POST['btnSave'])) {
            $name = $_POST['txtName'];
            $type = $_POST['txtType'];
            $price = $_POST['txtPrice'];
            $image = $_POST['txtImage'];
        
            $cl = new Controller("localhost", "webshop", "root", "");
            $cl->save_items($name, $type, $price, $image);
            $cl->show_last_one($name, $type, $price, $image);
        }
        ?>
    </div>
</body>




</html>

