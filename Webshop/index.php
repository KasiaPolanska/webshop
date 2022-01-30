<?php
include('header.php');
// require("controller.php");
$cc = new Controller("localhost", "webshop","root","");
$oc = new Order_Controller("localhost", "webshop","root","");
 if(isset($_POST['btnAdd']))
 {
    $oc->add_to_basket();
    echo count($_SESSION["shopping_cart"]);
 }
        
    ?> 
<header>
    <div class="header">
     
    </div>
</header>
<div class="search-container">
    <form method="POST">
        <input type="text" name="txtZoek">
        <input type="submit" name="btnZoek" value="Zoek"></i>
    </form> 
</div>

<div class="container">       
        <h6>Alle producten</h6>
        
    <div class="items">
        <?php
            $cl =  new Controller("localhost", "webshop", "root", "");
            if(empty($_POST['btnZoek']))
            {
                
                $cl->show_all_products();
            }
            

            if(isset($_POST['btnZoek'])) {

                $cl->geefOverzicht();
            }
        ?>
        
    </div>
</div>
</body>
</html>

