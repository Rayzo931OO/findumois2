<?php

namespace App\Controller;

use App\Repository\TypeDepenseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DepenseController extends AbstractController
{
    #[Route('/depense', name: 'app_depense')]
    public function index(TypeDepenseRepository $typeDepenseRepository): Response
    {
        
        $type = $typeDepenseRepository->findAll();

        //dump($type);


        return $this->render('depense/index.html.twig', [
            'types' => $type,
        ]);
    }

    #[Route('/details/{id}', name: 'app_details')]
    public function detailType(TypeDepenseRepository $typeDepenseRepository, int $id): Response
    {
        $type = $typeDepenseRepository->findBy(['id' => $id]);

         //dd($type);

        // $types = $typeDepenseRepository->findAll();

        //dump($type);


        return $this->render('depense/details.html.twig',[
            "types" => $type
        ]);
}

public function depenseType(TypeDepenseRepository $typeDepenseRepository, int $id): Response
{
    $type = $typeDepenseRepository->findBy(['id' => $id]);

     //dd($type);

    // $types = $typeDepenseRepository->findAll();

    //dump($type);


    return $this->render('depense/details.html.twig',[
        "types" => $type
    ]);
}
}