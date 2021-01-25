<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $username = "jean";
        return $this->render('main/home.html.twig', [
            "username" => $username,
            "producte" => "pifpaf"
        ]);
    }
}