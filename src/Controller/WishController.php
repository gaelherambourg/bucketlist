<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use http\Client;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WishController extends AbstractController
{

    /**
     * @Route("/list", name="wish_list")
     */
    public function list(WishRepository $wishRepository)
    {
        //aller chercher tous les wishes dans la BDD
        //$wishes = $wishRepository->findAll();
        $wishes = $wishRepository->findBy(["isPublished"=>true], ["dateCreated"=>"DESC"], 200,0);
        //->findOneBy();
        //dd($wishes);
        //$a = $wishRepository->findByIsPublished(1);
        //dd($a);
        //$wish1 = $wishRepository->find(1);


        return $this->render('wish/list.html.twig', ['wishes'=>$wishes]);
    }

    /**
     * @Route("/list/detail/{id}", name="wish_detail", requirements={"id": "\d+"})
     */
    public function detail($id, WishRepository $wishRepository)
    {
        //aller chercher dans la BDD le souhait dont l'id est dans l'url
        $w = $wishRepository->find($id);

        //qu'est ce qu'on fait si ce wish n'existe pas en Bdd
        if(!$w){
            //alors on déclenche une 404
            throw $this->createNotFoundException('This wish is gone.');
        }

        return $this->render('wish/detail.html.twig',['id' => $id, 'wish1'=>$w]);
    }

    /**
     * @Route("/create", name="wish_create")
     */
    public function create(Request $request, EntityManagerInterface $entityManager):Response
    {
        //Création d'une instance de notre entité, qi sera eventuellementsauvegarder en base de données
        $wish = new Wish();

        //Créer une instance du form, en lui associant notre entité
        $form = $this->createForm(WishType::class, $wish);

        //prends les données du formulaire et les hydrates dans mon entité
        $form->handleRequest($request);

        //est ce que le formulaire est soumis et valide
        if($form->isSubmitted() && $form->isValid()){
            //hydrater les propriétés manquantes
            $wish->setDateCreated(new \DateTime());


            //déclenche l'insert en bdd
            $entityManager->persist($wish);
            $entityManager->flush();

            //Créer un message en session
            $this->addFlash('success', 'Votre souhait a bien été ajouté !');

            //Créer une redirection vers une autre page
            return $this->redirectToRoute('wish_detail',['id'=> $wish->getId()]);
        }

        //Affichage de la page Twig
        return $this->render('wish/create.html.twig', [
            "wish_form"=> $form->createView()
        ]);
    }

    /**
     * @Route("/testapi", name="wish_testapi")
     */
    public function appelAPI(HttpClientInterface $client){

        $response = $client->request('GET', 'https://restcountries.eu/rest/v2/all', [
            'headers' => [
                'Accept' => 'application/json',
            ]]);
//        $statusCode = $response->getStatusCode();
//        var_dump($statusCode);
        $content = $response->toArray();
//        for ($i = 0; $i < count($content); $i++):
//            $pays = $content[$i]['name'];
//            var_dump($pays);
//        endfor;
//        $lang = $content[0]['languages'];
//        var_dump($lang);
        //var_dump($pays);
        //var_dump($content);
        //var_dump($response);



        return $this->render('wish/testapi.html.twig', [
            "response"=>$content
        ]);

        }
}