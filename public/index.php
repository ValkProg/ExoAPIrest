<?php

require('../src/init.php');

use tutoAPI\Controllers\tutoController;

// Evaluation de la requête
$length = strlen(BASE_PATH) + 1;
$uri = substr($_SERVER['REQUEST_URI'], $length) ;
$method = $_SERVER['REQUEST_METHOD'];

switch(true) {

    case preg_match('#^tutos/(\d+)$#', $uri, $matches) && $method == 'GET':

        $id = $matches[1];

        $controller = new tutoController();

        return $controller->show($id);

        break;

    case preg_match('#^tutos/pages/(\d+)$#', $uri, $matches) && $method == 'GET':

        $controller = new tutoController();
        $currentPage = $matches[1];
        
        // if(isset($_GET['page']) && !empty($_GET['page'])){
        //     $currentPage = (int) strip_tags($_GET['page']);
        // }else{
        //     $currentPage = 1;
        // }

        return $controller->index();

        break;

    case preg_match('#^tutos((\?)|$)#', $uri) && $method == 'GET':

        $controller = new tutoController();

        return $controller->index();

        break;

    case preg_match('#^tutos((\?)|$)#', $uri) && $method == 'POST':

        $controller = new tutoController();

        return $controller->add();

        break;
    case preg_match('#^tutos/(\d+)$#', $uri, $matches) && $method == 'PATCH':
        $id = $matches[1];
        $controller = new tutoController();

        return $controller->update($id);

        break;
    case preg_match('#^tutos/(\d+)$#', $uri, $matches) && $method == 'DELETE':
        $id = $matches[1];

        $controller = new tutoController();

        return $controller->delete($id);

        break;

    default:

    http_response_code(404);

    echo json_encode('erreur 404');

}
