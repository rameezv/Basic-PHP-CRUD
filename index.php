<?php
    require_once 'controller/CardsController.php';
    require_once 'model/CardsService.php';

    $title="Take It To The Top";

    include 'view/header.php';
    echo '<a class="crBtn" href="create.php?type=0">Create Human<a><a class="crBtn" href="create.php?type=1">Create Dog<a>';
    include 'view/CardsView.php';
    include 'view/footer.php';
?>