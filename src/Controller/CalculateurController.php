<?php

namespace App\Controller;

use App\Form\MBFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculateurController extends AbstractController
{
    #[Route('/calculateurs', name: 'calculateur.list')]
    public function index(Request $request): Response
    {
        $calculDone = false;
        $form = $this->createForm(MBFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $sexe = $form->get('sexe')->getData();
            $taille = (float)$form->get('taille')->getData() / 100;
            $poids = $form->get('poids')->getData();
            $age = $form->get('age')->getData();
            $coef = $form->get('coef')->getData();

            $kcalBenedict =  14.2 * $poids + 593;
            if($sexe === 1){
                $kcalOxford =  ($poids * 13.707) + ($taille * 492.3) - ($age * 6.673) + 77.607;
                $kcal = 259 * pow($poids, 0.48) * pow($taille, 0.5) * pow($age, -0.13);
                $calculDone = true;
            }else{
                $kcalOxford =  ($poids * 9.740) + ($taille * 172.9) - ($age * 4.737) + 667.051;
                $kcal = 230 * pow($poids, 0.48) * pow($taille, 0.5) * pow($age, -0.13);
                $calculDone = true;
            }

            switch ($coef){
                case 0:
                    $coef = 1;
                    break;
                case 1:
                    $coef = 1.2;
                    break;
                case 2:
                    $coef = 1.4;
                    break;
                case 3:
                    $coef = 1.5;
                    break;
                case 4:
                    $coef = 1.6;
                    break;
                case 5:
                    $coef = 1.7;
                    break;
                case 6:
                    $coef = 1.9;
                    break;
            }

            $moy = ($kcal + $kcalBenedict + $kcalOxford) / 3;
            $kcalNeeded = $moy * $coef;
        }

        return $this->render('calculateur/index.html.twig', [
            'form' => $form->createView(),
            'calculDone' => $calculDone,
            'moy' => $calculDone ? $moy : null,
            'kcalNeeded' => $calculDone ? $kcalNeeded : null
        ]);
    }
}
