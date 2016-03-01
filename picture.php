<?php
    require_once 'controller/CardsController.php';
    require_once 'model/CardsService.php';

    $title="View Picture";

    include 'view/header.php';

    $controller = new CardsController();

    echo "<h2>Image for ID ".$_GET["id"]."</h2>";

    $data = $controller->getPicFromId($_GET["id"]);
    if ($data == NULL) {
        $cururl = "";
        echo "No Image Found for ID ".$_GET["id"].".";
    } else {
        $cururl = $data[0]["pic"];
        echo '<img class="dispimg" src="'.$cururl.'" />';
    }

    include 'view/PictureForm.php';

    include 'view/footer.php';

?>