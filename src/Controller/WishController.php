<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use App\Service\Censurator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/wish", name="app_wish_")
 */
class WishController extends AbstractController
{

    private $wishRepository;

    function __construct(WishRepository $wr)
    {
        $this->wishRepository = $wr;
    }

    /**
     * @Route("/{id}", name="detail",requirements={"id"="\d+"})
     */
    public function detail(Wish $wish): Response
    {
        return $this->render('wish/detail.html.twig',compact("wish"));
    }

    /**
     * @Route("/list", name="list")
     */
    public function list(): Response
    {
        $wishes = $this->wishRepository->findBy(["isPublished"=>true],
                                                ["dateCreated"=>"DESC"]);
        return $this->render('wish/list.html.twig', compact("wishes"));
    }    

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/add", name="add")
     */
    public function add(Request $request,Censurator $censurator): Response
    {
        
        $wish = new Wish();
        $wish->setAuthor($this->getUser()->getUserIdentifier());
        $wishForm = $this->createForm(WishType::class,$wish);
        $wishForm->handleRequest($request);

        if($wishForm->isSubmitted() && $wishForm->isValid()){
            $wish->setDescription( $censurator->purify2($wish->getDescription())  );
            $this->wishRepository->add($wish,true);
            $this->addFlash("success","Idea successfully added!");
            return $this->redirectToRoute("app_wish_detail",["id"=>$wish->getId()]);
        }
        return $this->render('wish/add.html.twig',["wishForm"=>$wishForm->createView()]);
    }
    
    
    /**
     * @Route("/update/{id}", name="update",requirements={"id"="\d+"})
     */
    public function update(Wish $wish,Request $request): Response
    {

        $wishForm = $this->createForm(WishType::class,$wish);
        $wishForm->handleRequest($request);

        if($wishForm->isSubmitted() && $wishForm->isValid()){
            $this->wishRepository->update();
            return $this->redirectToRoute("app_wish_list");
        }

        return $this->render('wish/update.html.twig',["wishForm"=>$wishForm->createView()]);
    }
    
    /**
     * @Route("/delete/{id}", name="delete",requirements={"id"="\d+"})
     */
    public function delete(Wish $wish): Response
    {
        $this->wishRepository->remove($wish,true);
        return $this->redirectToRoute("app_wish_list");
    }    
}
