<?php 
    include_once 'panier/Cart.class.php'; 
    $cart = new Cart; 

    // Include the database config file 
    require_once 'inc/dbConfig.php';

    require 'header.php';
?>
<?php require 'carousel.php';?>
<div class="container">
    <h2 class="text-center">- <span class="text-danger">SOLDES</span> -</h2>
    <?php require 'item2.php';?>
</div>
<div class="container my-5">
    <img class="container image-fluid" src="assets/longue.png" alt="">
</div>
<div class="container">
    <h2 class="text-center">- CATEGORIES -</h2>
    <?php require 'category.php';?>
</div>




<?php 
    require 'footer.php';
?>









    