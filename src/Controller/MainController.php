<?php

namespace App\Controller;

use App\Entity\Wish;
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

    /**
     * @Route("/test", name="main_testData")
     */
    public function testData()
    {
        //Créer une instance de la classe
        $wish = new Wish();

        //hydrate chacune de ses propriété requises
        $wish->setTitle('South America');
        $wish->setDescription('Partir en famille 1 an minimum en Amérique du sud en itinérant');
        $wish->setAuthor('Gael H.');
        $wish->setIsPublished(false);
        $wish->setDateCreated(new \DateTime());

        //on appelle l'entity manager de doctrine (on peut également le faire avec le passage en parametre de la fonction)
        $entityManager = $this->getDoctrine()->getManager();

        //On demande à doctrine de sauvegarder notre instance
        $entityManager->persist($wish);
        //On execute la requete sql maintenant
        $entityManager->flush();

        return $this->render('main/testData.html.twig');
    }
}