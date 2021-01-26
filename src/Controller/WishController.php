<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{

    /**
     * @Route("/list", name="list")
     */
    public function list()
    {
        return $this->render('main/list.html.twig');
    }

    /**
     * @Route("/detail", name="detail")
     */
    public function detail()
    {
        return $this->render('main/detail.html.twig');
    }


}