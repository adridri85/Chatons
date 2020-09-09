<?php

namespace App\Controller;
use App\Entity\Cat;
use App\Form\CatType;
use App\Repository\CatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Chaton", name="chaton_")
 * Class ChatonController
 * @package App\Controller
 */
class ChatonController extends AbstractController
{
    /**
     * @Route("/", name="list")
     */
    public function getChatonList(CatRepository $catRepository) {

        $listCar = $catRepository->findAll();

        return $this->render('chaton/index.html.twig', [
            'title' => 'ChatonController',
            'list_cat' => $listCar,
        ]);
    }

    /**
     * @Route("/detail/{id}", name="detailByid")
     */
    public function getCatById($id, CatRepository $catRepository){

        $catbyId = $catRepository->findBy(array('id' => $id));

        return $this->render('chaton/detail.html.twig',[
            'detailId' => $catbyId,
        ]);
    }

    /**
     * @Route("/new", name="add_NewCat")
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function insertCat(EntityManagerInterface $entityManager, Request $request){

        $cat = new Cat();

        $catForm = $this->createForm(CatType::class,$cat);
        $catForm->handleRequest($request);

        if($catForm->isSubmitted() && $catForm->isValid()){

            /** @var UploadedFile $picture */
            $picture = $catForm->get('picture')->getData();

            $newfilename = sha1(uniqid()) . "." . $picture->guessExtension();

            try {
                $picture->move($this->getParameter('uplode_dir'), $newfilename);
            }catch (FileException $fe){
                die($fe);
            }

            $cat->setFilename($newfilename);
            $cat->setDatecreated(new \DateTime());
            $cat->setIsSold(false);

            $entityManager->persist($cat);
            $entityManager->flush();

            $this->addFlash("succes", "le chaton est bien enregistrer");

            return $this->redirectToRoute("chaton_list");

        }

        return $this->render("formCat/insertCat.html.twig", ['form_cat' => $catForm->createView()]);

    }
}
