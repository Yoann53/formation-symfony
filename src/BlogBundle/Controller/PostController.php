<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PostController extends Controller
{
    /**
     * @Route("/onglet3", name="posts")
     */
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();

    	$repository = $this->getDoctrine()->getRepository('BlogBundle:Post');
    	$posts = $repository->findAll(); 

        return $this->render('BlogBundle:Post:index.html.twig', array(
        	'menuActif' => 3,
        	'posts' => $posts
        ));
    }

}
