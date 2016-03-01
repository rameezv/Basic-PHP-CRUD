<?php
    require_once 'controller/CardsController.php';
    require_once 'model/CardsService.php';

    $title="Update Item";

    include 'view/header.php';

    $controller = new CardsController();

    if (($_GET["id"]) > 100000) {
        $data = $controller->getDogFromId($_GET["id"]);
        include 'view/UpdateDogForm.php';
    } else {
        $data = $controller->getHumanFromId($_GET["id"]);
        include 'view/UpdateHumanForm.php';
    }

    include 'view/footer.php';
?>