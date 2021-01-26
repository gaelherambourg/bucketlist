<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    /**
     * @Route("/", name="main_home")
     */
    public function home()
    {
        $username = "jean";
        return $this->render('main/home.html.twig', [
            "username" => $username,
            "producte" => "pifpaf"
        ]);
    }

    /**
     * @Route("/abousus", name="main_aboutUs")
     */
    public function aboutUs()
    {
        return $this->render('main/aboutUs.html.twig');
    }
}