<?php

namespace App\Controller;

use App\Entity\Staff;
use App\Form\StaffFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StaffController extends AbstractController
{
    #[Route('/staffs', name: 'staff.list')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $staff = new Staff();
        $staff->setPdp('img/asyjan.png');
        $staff->setName('Asyjan');
        $staff->setRank('Équipe fondatrice');
        $staff->setText1('Discipline, humble et franc');
        $staff->setText2('20 ans, 1.76m, 83kg');
        $staff->setText3('Bat toi');
        $staff->setExperience('5 ans');

        $staff2 = new Staff();
        $staff2->setPdp('img/benj.png');
        $staff2->setName('Benjos');
        $staff2->setRank('Équipe fondatrice');
        $staff2->setText1('Généreux, attentif, passionné');
        $staff2->setText2('1m71, 56kg, 16 ans');
        $staff2->setText3("L'aide est ma plus grande passion");
        $staff2->setExperience('1 ans');

        $staff3 = new Staff();
        $staff3->setPdp('img/nessimo.png');
        $staff3->setName('Nessimo');
        $staff3->setRank('Équipe communicative');
        $staff3->setText1("Patient, à l'écoute, solidaire");
        $staff3->setText2("1m82, 73kg 17 ans ");
        $staff3->setText3("À l'écoute de tout le monde");
        $staff3->setExperience('1 ans');

        $staff4 = new Staff();
        $staff4->setPdp('img/clement.png');
        $staff4->setName('Clément');
        $staff4->setRank('Équipe communicative');
        $staff4->setText1('Discipline, persévérance');
        $staff4->setText2('174cm, 69kg, 20 ans');
        $staff4->setText3('"Ici pour vous aider"');
        $staff4->setExperience('1 ans');

        $staff5 = new Staff();
        $staff5->setPdp('img/zelpal.png');
        $staff5->setName('Zelpal');
        $staff5->setRank('Équipe communicative');
        $staff5->setText1("focus sur l'esthétique, poids du corps, street lifting");
        $staff5->setText2("73kg 179cm, 25 ans");
        $staff5->setText3("C'est une honte pour un homme de vieillir sans voir la beauté et la force dont son corps est capable.");
        $staff5->setExperience('6 ans');

        $staff6 = new Staff();
        $staff6->setPdp('img/natha.png');
        $staff6->setName('Natha');
        $staff6->setRank('Équipe administrative');
        $staff6->setText1("Gentil, courageux, attentionné, volontaire et intelligent");
        $staff6->setText2("1.79m, 16 ans");
        $staff6->setText3("Echouer c'est pas grave, l'important c'est de continuer.");

        $staff7 = new Staff();
        $staff7->setPdp('img/ikariu.png');
        $staff7->setName('Ikariu');
        $staff7->setRank('Équipe administrative');
        $staff7->setText1("Actif, Disponible, Généreux");
        $staff7->setText2("17 ans");
        $staff7->setText3("Un problème ? Une question ? Je suis là pour vous !");

        $staffs = array($staff, $staff2, $staff3, $staff4, $staff5, $staff6, $staff7);

        return $this->render('staff/index.html.twig', [
            'staffs' => $staffs,
        ]);
    }

    #[Route('/staffs/detail/{id}', name: 'staff.detail')]
    public function detail(Staff $staff = null, $id): Response
    {
        return $this->render('exercise/detail.html.twig', [
            'staff' => $staff
        ]);
    }

    #[Route('/staffs/add/', name: 'staff.add')]
    public function addStaff(Request $request, ManagerRegistry $doctrine): Response
    {
        $manager = $doctrine->getManager();
        $staff = new Staff();
        $form = $this->createForm(StaffFormType::class, $staff);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($staff);
            $manager->flush();
            $this->addFlash('success', "Le staff a été ajouté avec succès");

            return $this->redirectToRoute('staff.list');
        }

        return $this->render('staff/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/staffs/update/{id?0}', name: 'staff.edit')]
    public function updateStaff(Staff $staff = null, ManagerRegistry $doctrine, Request $request, $id): Response
    {
        $form = $this->createForm(StaffFormType::class, $staff);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager = $doctrine->getManager();

            $manager->persist($staff);
            $manager->flush();
            $this->addFlash('success', "Le staff a été édité avec succès");

            return $this->redirectToRoute('staff.list');
        }

        return $this->render('staff/new.html.twig', [
            'form' => $form->createView(),
            'isCreating' => false,
        ]);
    }

    #[Route('/staffs/delete/{id}', name: 'staff.delete')]
    public function deleteStaff(Staff $staff = null, $id, ManagerRegistry $doctrine): RedirectResponse
    {
        $entityManager = $doctrine->getManager();
        $entityManager->remove($staff);
        $entityManager->flush();
        $this->addFlash('success', "Le staff à été supprimé avec succès");

        return $this->redirectToRoute('staff.list');
    }
}
