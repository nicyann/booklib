<?php
/**
 * Created by PhpStorm.
 * User: PcAssus-Yann
 * Date: 22/11/2018
 * Time: 16:08
 */

namespace App\Controller;


use App\Entity\Author;
use App\Form\AuthorType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AuthorController
 * @package App\Controller
 * @Route("/author")
 */
class AuthorController extends BaseController
{
    /**
     * @Route("/new"), name="author_new"
     */
    public function  new(Request $request)
    {
        $author = new Author();
        
        $form = $this->createForm(AuthorType::class,$author);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em =$this->getDoctrine()->getManager();
            $em->persist($author);
            $em->flush();
            
            return$this->redirectToRoute('homepage');
        }
        
        
        return $this->render('author/new.html.twig', ['form' => $form->createView()]);
        
        
        
    }
}