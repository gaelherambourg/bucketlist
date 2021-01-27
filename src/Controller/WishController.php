<?php

namespace App\Controller;

use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{

    /**
     * @Route("/list", name="wish_list")
     */
    public function list(WishRepository $wishRepository)
    {
        //todo: aller chercher tous les wishes dans la BDD
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
        //todo: aller chercher dans la BDD le souhait dont l'id est dans l'url
        $w = $wishRepository->find($id);
        return $this->render('wish/detail.html.twig',['id' => $id, 'wish1'=>$w]);
    }


}