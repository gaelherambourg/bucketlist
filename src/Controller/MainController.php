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
        $wish1 = new Wish();
        $wish2 = new Wish();
        $wish3 = new Wish();
        $wish4 = new Wish();

        //hydrate chacune de ses propriété requises
        $wish1->setTitle('Nager avec les dauphins');
        $wish1->setDescription('blaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa a a a a aaaaa a aaaaa');
        $wish1->setAuthor('Gael H.');
        $wish1->setIsPublished(true);
        $wish1->setDateCreated(new \DateTime());

        $wish2->setTitle('Surfer au Mexique');
        $wish2->setDescription('gfzjfezkjnflkrezjfkrezj flkehjzfozehfez');
        $wish2->setAuthor('Gael H.');
        $wish2->setIsPublished(true);
        $wish2->setDateCreated(new \DateTime());

        $wish3->setTitle('Faire du canyoning');
        $wish3->setDescription('fezkhzfiuyoiezfoirezf');
        $wish3->setAuthor('Gael H.');
        $wish3->setIsPublished(true);
        $wish3->setDateCreated(new \DateTime());

        $wish4->setTitle('Parachute');
        $wish4->setDescription('Sauter en parachute');
        $wish4->setAuthor('Gael H.');
        $wish4->setIsPublished(true);
        $wish4->setDateCreated(new \DateTime());

        //on appelle l'entity manager de doctrine (on peut également le faire avec le passage en parametre de la fonction)
        $entityManager = $this->getDoctrine()->getManager();

        //On demande à doctrine de sauvegarder notre instance
        $entityManager->persist($wish1);
        $entityManager->persist($wish2);
        $entityManager->persist($wish3);
        $entityManager->persist($wish4);
        //On execute la requete sql maintenant
        $entityManager->flush();

        return $this->render('main/testData.html.twig');
    }
}