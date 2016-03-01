<?php
    require_once 'controller/CardsController.php';
    require_once 'model/CardsService.php';

    $controller = new CardsController();

    //print_r($_POST);

    if (($_POST["act"]) == "delete") {
        if (($_POST["id"]) > 100000) {
            $controller->removeDog($_POST["id"]);
            $controller->removePic($_POST["id"]);
        } else {
            $controller->removeHuman($_POST["id"]);
            $controller->removePic($_POST["id"]);
        }
    } elseif (($_POST["act"]) == "update") {
        if (($_POST["id"]) > 100000) {
            $controller->updateDog(($_POST["id"]), ($_POST["ownerId"]), ($_POST["name"]));
        } else {
            $controller->updateHuman(($_POST["id"]), ($_POST["name"]), ($_POST["job"]), ($_POST["phone"]));
        }
    } elseif (($_POST["act"]) == "createHuman") {
        $id = rand(10000,99999);
        echo $id;
        while ($controller->checkIDInUseHuman($id)) {
            $id = rand(10000,99999);
        }
        $controller->addHuman($id, ($_POST["name"]), ($_POST["job"]), ($_POST["phone"]));
    } elseif (($_POST["act"]) == "createDog") {
        $id = rand(100000,999999);
        echo $id;
        while ($controller->checkIDInUseDog($id)) {
            $id = rand(100000,999999);
        }
        $controller->addDog($id, ($_POST["ownerId"]), ($_POST["name"]));
    } elseif (($_POST["act"]) == "upPic") {
        if ($cururl == "") {
            $controller->addPic(($_POST["id"]), ($_POST["url"]));
        } else {
            $controller->updatePic(($_POST["id"]), ($_POST["url"]));
        }
    }
    echo "<script>window.location = 'index.php'</script>";

?>