<div class='basket'>
<?php

include("header.php");

?>
<div class="container">
<table class="table table-bordered">
    <tr>
        <th width="25%">Name</th>
        <th width="15%">Price</th>
        <th width="5%">Quantity</th>
        <th width="15%">Total</th>
        <th width="1%"></th>
        <?php 
            $oc = new Order_controller("localhost", "webshop", "root", "");
            $oc -> basket();
        ?>
    </tr>
</table>
    <a href="complete_order.php">Verder</a>
</div>
</div>

