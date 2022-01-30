<?php
include('header.php');

$mc = new Manage_items_controller("localhost", "webshop", "root", "");

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $mc->show_details($id);
}
?>
    

<?php

if(isset($_POST['btnUpdate'])) {

    $id=$_POST['txtId'];
    $name = $_POST['txtName'];
    $type = $_POST['txtType'];
    $price = $_POST['txtPrice'];
    $image = $_POST['txtImage'];
    $mc->update($id, $name, $type, $price, $image);
}

if(isset($_POST['btnDelete'])) {

    $mc->delete();
}
?>

</body>
</html>

