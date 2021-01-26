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
        return $this->render('wish/list.html.twig');
    }

    /**
     * @Route("/detail/{id}", name="wish_detail", requirements={"id": "[0-9]+"})
     */
    public function detail($id)
    {
        return $this->render('wish/detail.html.twig',['id' => $id]);
    }


}