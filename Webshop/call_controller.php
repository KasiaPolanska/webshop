<?php
require('controller.php');
    $cl = new Controller("localhost", "webshop", "root", "");

require('order_controller.php');
    $oc = new Order_controller("localhost", "webshop", "root", "");

require('manage_items_controller.php');
    $mc = new Manage_items_controller("localhost", "webshop", "root", "");
?>