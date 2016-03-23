<?php

    require_once 'controller/CardsController.php';
    require_once 'model/CardsService.php';

    $controller = new CardsController();


    $method = $_SERVER['REQUEST_METHOD'];
    $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
    $input = json_decode(file_get_contents('php://input'),true);

    switch ($method) {
        case 'GET':
            if ($request[0] == "users") {
                if (isset($request[1])) {
                    echo json_encode($controller->getHumanFromId($request[1]));
                } else {
                    $controller->displayUsersAsJSON();
                }
            }
            if ($request[0] == "dogs") {
                if (isset($request[1])) {
                    echo json_encode($controller->getDogFromId($request[1]));
                } else {
                    $controller->displayDogsAsJSON();
                }
            }
            break;
        case 'POST':
            if ($request[0] == "users") {
                if ( isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["job"]) && isset($_POST["phone"]) ) {
                    $controller->addHuman( $_POST["id"], $_POST["name"], $_POST["job"], $_POST["phone"] );
                } else {
                    echo "Invalid Parameters.";
                }
            }
            if ($request[0] == "dogs") {
                if ( isset($_POST["id"]) && isset($_POST["ownerId"]) && isset($_POST["name"]) && $_POST["ownerId"] < 10000 ) {
                    $controller->addDog( $_POST["id"], $_POST["ownerId"], $_POST["name"] );
                } else {
                    echo "Invalid Parameters.";
                }
            }
            break;
        case 'DELETE':
            if ($request[0] == "users" && isset($request[1])) {
                $controller->removeHuman( $request[1] );
            } elseif ($request[0] == "dogs" && isset($request[1])) {
                $controller->removeDog( $request[1] );
            } else {
                echo json_encode("Invalid User.");
            }
            break;
        case 'PUT':
            $put = array();
            parse_str(file_get_contents('php://input'), $put);
            /*if ($request[0] == "users" && isset($request[1]) {
                if (isset($))
                $controller->updateHuman( $id, $name, $job, $phone );
            } elseif ($request[0] == "dogs" && isset($request[1]) {
                $controller->removeDog( $request[1] );
            } else {
                echo 'Invalid User.'
            }*/
            break;
        default:
            echo "Invalid Request Method";
    }

?>