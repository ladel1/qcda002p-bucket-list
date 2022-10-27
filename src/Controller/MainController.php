<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController{


    /**
     * @Route("/",name="app_home")
     */
    function index(MailerInterface $mailer):Response{
        // $email = (new Email())
        //     ->from('hello@example.com')
        //     ->to('you@example.com')
        //     //->cc('cc@example.com')
        //     //->bcc('bcc@example.com')
        //     //->replyTo('fabien@example.com')
        //     //->priority(Email::PRIORITY_HIGH)
        //     ->subject('Time for Symfony Mailer!')
        //     ->text('Sending emails is fun again!')
        //     ->html('<p>See Twig integration for better HTML integration!</p>');

        // $mailer->send($email);        
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