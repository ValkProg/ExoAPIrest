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

    case preg_match('#^tutos((?)|$)#', $uri) && $method == 'GET':

<<<<<<< HEAD
        if (isset($_GET["page"]) && $_GET["page"] > 0){
            $page = $_GET["page"];
            $controller=new tutoController();
            return $controller->page($page);
        }
        else{
            $controller = new tutoController();
            return $controller->index();
        }
=======
        $controller = new tutoController();
        $currentPage = $matches[1];
        
        // if(isset($_GET['page']) && !empty($_GET['page'])){
        //     $currentPage = (int) strip_tags($_GET['page']);
        // }else{
        //     $currentPage = 1;
        // }

        return $controller->page($currentPage);

        break;

    case preg_match('#^tutos((\?)|$)#', $uri) && $method == 'GET':

        $controller = new tutoController();

        return $controller->index();
>>>>>>> 7231b4266b9786055da2abd295d53aff3db5f9b0

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
