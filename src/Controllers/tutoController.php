<?php

namespace tutoAPI\Controllers;

use tutoAPI\Models\TutoManager;
use tutoAPI\Models\Tuto;
use tutoAPI\Controllers\abstractController;

class tutoController extends abstractController
{

    public function show($id)
    {

        // Données issues du Modèle

        $manager = new TutoManager();

        $tuto = $manager->find($id);

        // Template issu de la Vue

        return $this->jsonResponse($tuto, 200);
    }

    public function index()
    {

        $tutos = [];

        $manager = new TutoManager();

        $tutos = $manager->findAll();

        return $this->jsonResponse($tutos, 200);
    }

    public function page($currentPage)
    {
      $tutos = [];

      $manager = new TutoManager();
      $tutos = $manager->findPerPage($currentPage);

      return $this->jsonResponse($tutos,200);

    }

    public function add()
    {
        // Ajout d'un tuto
      $tuto = new Tuto();
      $tuto->setTitle($_POST['title']);
      $tuto->setDescription($_POST['description']);
      $now = new \DateTime();
      $dateString = strtotime('%Y-%m-%d' , $now->getTimestamp());
      $tuto->setCreatedAt(strtotime('%Y-%m-%d' , $dateString));

      $manager = new TutoManager();
      $tuto = $manager->add($tuto);

      return $this->jsonResponse($tuto, 201);
    }

    public function update($id)
    {
      parse_str(file_get_contents('php://input'), $_PATCH);
      var_dump($_PATCH);
      $manager = new TutoManager();
      $tuto = $manager->find($id);

      foreach ($_PATCH as $key => $value){
        if (!empty($key) and $key == "title"){
          $value = $tuto ->setTitle($_PATCH['title']);
        }
        elseif (!empty($key) and $key == "description"){
          $value = $tuto ->setDescription($_PATCH['description']);
        }

      }

      $newTuto = $manager->update($tuto);
      return $this->jsonResponse($newTuto, 200);
    }

    public function delete($id)
    {

        // Données issues du Modèle

        $manager = new TutoManager();
        $tuto = $manager->find($id);
        $manager->delete($id);

        // Template issu de la Vue

        return $this->jsonResponse($tuto, 200);
    }


}
