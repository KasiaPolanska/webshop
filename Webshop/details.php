<?php
include("header.php");
?>
    <div class="container">
    <?php
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $cl =  new Controller("localhost", "webshop", "root", "");
                $cl->show_one_product();
            }
        ?>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</html>

