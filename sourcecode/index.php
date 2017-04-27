<?php
if (isset($_GET['action'])) {
    $request = explode('/', $_GET['action']);

    $action = $request[1];

    $controller = str_replace(' ', '', ucwords(str_replace('-', ' ', $request[0]))) . 'Controller';

    if (file_exists(__DIR__ . '/Controllers/' . $controller . '.php')) {
        require(__DIR__ . '/Controllers/' . $controller . '.php');

        if (class_exists($controller)) {
            $data = new $controller();

            if (method_exists($controller, $action)) {
                $_POST = (array)json_decode(file_get_contents('php://input'));
                $response = @call_user_func_array([$controller, $action], $_REQUEST);
                echo json_encode($response);
                die;
            } else {
                echo 'Action not found';
            }
        } else {
            echo 'Controller class not found';
        }
    } else {
        echo 'Controller file not found';
    }
} else {
    echo "Kindly specify the action";
}
