<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController{


    /**
     * @Route("/",name="app_home")
     */
    function index():Response{
        
        return $this->render("main/index.html.twig");
    }

    /**
     * @Route("/about-us",name="app_about_us")
     */
    function aboutUs(){
        return $this->render("main/about-us.html.twig");
    }

    /**
     * @Route("/legal-stuff",name="app_legal_stuff")
     */
    function legalStuff(){
        return $this->render("main/legal-stuff.html.twig");
    }

}