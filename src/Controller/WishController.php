<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{

    /**
     * @Route("/list", name="wish_list")
     */
    public function list()
    {
        //todo: aller chercher tous les wishes dans la BDD
        return $this->render('wish/list.html.twig');
    }

    /**
     * @Route("/list/detail/{id}", name="wish_detail", requirements={"id": "\d+"})
     */
    public function detail($id)
    {
        //todo: aller chercher dans la BDD le souhait dont l'id est dans l'url
        return $this->render('wish/detail.html.twig',['id' => $id]);
    }


}