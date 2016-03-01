<?php
    require_once 'controller/CardsController.php';
    require_once 'model/CardsService.php';

    $title="Create Item";

    include 'view/header.php';

    $controller = new CardsController();

    if (($_GET["type"]) == 1) { //dog
        include 'view/CreateDogForm.php';
    } else { // else human
        include 'view/CreateHumanForm.php';
    }

    include 'view/footer.php';
?>