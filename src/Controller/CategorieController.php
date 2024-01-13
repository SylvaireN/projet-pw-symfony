<?php

namespace App\Controller;

use App\Entity\Educateur;
use App\Entity\MailEdus;
use App\Entity\Categorie;
use App\Entity\Contact;
use App\Entity\Licencie;
use App\Form\MailEduFormType;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategorieController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }
    private $mr;
    #[Route('/listCategorie', name: 'app_categorie_list')]
    public function listCategorie(ManagerRegistry $mr): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $allCategorie = $mr->getRepository(Categorie::class)->findAll();
        
        return $this->render('categorie/index.html.twig', [
            'allCategorie' => $allCategorie,
        ]);
    }

   
    #[Route('/listLicencie/{id}', name: 'app_categorie_show_licencie')]
    public function show(ManagerRegistry $mr, $id) : Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $categorieShow = $mr->getRepository(Categorie::class)->find($id);
        $contactBycategorieShow = $mr->getRepository(Categorie::class)->findAllContactsCategorie($id);
        $licencieShow = $mr->getRepository(Licencie::class)->findAll();
  
        return $this->render('categorie/show.html.twig', ['categorieShow' => $categorieShow,
                                                          'contactBycategorieShow' => $contactBycategorieShow,
                                                          'licencieShow' => $licencieShow]);
      }

    
    #[Route('/listContact/{id}', name: 'app_categorie_show_contact')]
    public function showContact(ManagerRegistry $mr, $id) : Response
    {
    if (!$this->getUser()) {
        return $this->redirectToRoute('app_login');
    }
        $categorieShow = $mr->getRepository(Categorie::class)->find($id);
        $contactBycategorieShow = $mr->getRepository(Categorie::class)->findAllContactsCategorie($id);
        $licencieShow = $mr->getRepository(Licencie::class)->findAll();

        return $this->render('categorie/showcontact.html.twig', ['categorieShow' => $categorieShow,
                                                        'contactBycategorieShow' => $contactBycategorieShow,
                                                        'licencieShow' => $licencieShow]);
    }

    private $em;
    #[Route('/writeMailEducateur', name: 'app_write_mail_educateur')]
    public function writeMailEducateur(Request $request, EntityManagerInterface $em, ManagerRegistry $mr) : Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $mailedu = new MailEdus();   

        $mailEduForm = $this->createForm(MailEduFormType::class, $mailedu);
        $educateur = $mr->getRepository(Educateur::class)->findAll();
        $maileducateur = $mr->getRepository(MailEdus::class)->findAll();

        $mailEduForm->handleRequest($request);
        if($mailEduForm->isSubmitted() && $mailEduForm->isValid()){

            $em->persist($mailedu);
            $em->flush();

            return $this->redirectToRoute('app_home');
        }
       
        return $this->render('Mail/sendEdu.html.twig', ['controller_name' => 'CategorieController',
                                                        'mailEduForm' => $mailEduForm->createView(),
                                                        'educateur' => $educateur,
                                                        'maileducateur' => $maileducateur,
                                                    ]);
    }
}
