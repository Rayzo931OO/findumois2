<?php

namespace App\Controller;

use App\Entity\Depense;
use App\Form\DepenseType;
use App\Repository\DepenseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $depense = new Depense();
        $form = $this->createForm(DepenseType::class, $depense);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($depense);
            $entityManager->flush();

            return $this->redirectToRoute("app_result");
        }

        return $this->render('accueil/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/result', name: 'app_result')]
    public function result(DepenseRepository $depenseRepository)
    {

        $depenses = $depenseRepository->findAll();

        $sommes = 0;

        foreach($depenses as $depense){
            $sommes += $depense->getPrix();
        }
        // dd($depenses);

        return $this->render('result/index.html.twig', [
            'depenses' => $depenses,
            'sommes' => $sommes,

            
    ]);


}
}


