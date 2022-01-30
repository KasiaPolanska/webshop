<?php
include('header.php');


?>
<div class="container">

    <table class="table table-bordered">
        <tr>
            <th width="40%">Name</th>
            <th width="20%">Price</th>
            <th width="20%">Quantity</th>
            <th width="15%">Total</th>
            <?php 
                $oc = new Order_controller("localhost", "webshop", "root", "");
                $oc -> basket();
            ?>
        </tr>
    </table>

    <div class="container">
        <form method="POST">
            <input type="text" name="txtName" placeholder="First name">
            <input type="text" name="txtlastName" placeholder="Last name">
            <input type="text" name="txtStreet" placeholder="Street">
            <input type="text" name="txtPostcode" placeholder="Postcode">
            <input type="text" name="txtCity" placeholder="City">
            <input type="submit" name="btnSave" value="Verder">
        </form>
    </div>
    <?php
    if(isset($_POST['btnSave'])) {
        $name = $_POST['txtName'];
        $lastName = $_POST['txtlastName'];
        $street = $_POST['txtStreet'];
        $postcode = $_POST['txtPostcode'];
        $city = $_POST['txtCity'];

        $oc = new Order_controller("localhost", "webshop", "root", "");
        $oc -> save_customer($name, $lastName, $street, $postcode, $city);
        $oc -> save_order();    
    }
    ?>
</div>