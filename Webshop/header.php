<?php
include('controller.php');
include('order_controller.php');
include('manage_items_controller.php');
session_start();
//$cart_count = 0;
// if(isset($_SESSION["shopping_cart"])) {
//     $cart_count = count($_SESSION["shopping_cart"]);
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" style="text/css" href="style.css">
    <link rel="icon" href="images/logo.png"/>
    <script src="https://kit.fontawesome.com/00bec71c4e.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <title>Cosmetic shop</title>
</head>
<body>
    <div class="new_navbar">
        <div class="nav"></div>
            <ul class="nav nav-tabs">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="index.php" role="button" aria-expanded="false">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="new_product.php" role="button" aria-expanded="false">Toevoegen</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="basket.php" role="button" aria-expanded="false">Winkelmandje</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="fas fa-shopping-basket"></i>
               
                    <span><a href="basket.php">
                    <?php //echo $cart_count; ?></span></a>
                <?php
                    
                    ?></a>
                    <ul class="dropdown-menu">
                        <?php
                            $oc = new Order_controller("localhost", "webshop", "root", "");
                            $oc->show_session();
                        ?>
                    </ul>
                </li>
                    <ul>
                        <form method="POST">
                            <input type="submit" name='btnClean' value='clean'>
                        </form>
                        <?php
                        if(isset($_POST['btnClean']))
                        {
                            $cl = new Controller("localhost", "webshop", "root", "");
                            $cl->clean();
                        ?>
                            <script>window.alert('session is leeg');</script>
                        <?php
                        }
                            
                        ?>
                    </ul>
            </ul>
        </div>
    </div>