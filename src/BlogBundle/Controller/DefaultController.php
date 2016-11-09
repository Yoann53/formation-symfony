<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="main")
     */
    public function indexAction(Request $request)
    {
    	//$name = $request->get('name');
    	//return new Response('<h1> Salut la compagnie ! '. $name .'</h1>');
        return $this->render(
        	'BlogBundle:Default:content.html.twig', 
        	array(
        		'menuActif' => 1,
	        	'post' => 'Voici mon premier post',
	        	'author' => 'Jessica',
	        	'date' => new \DateTime(),
	        	'comments' => array(
	        		'first' => array(
	        			'1er commentaire', 
	        			array(
	        				'author' => 'Yoann', 
	        				'age' => 29
	        			)
	        		),
	        		'second' => array(
	        			'2eme commentaire', 
	        			array(
	        				'author' => 'Mouhammad',
	        				'age' => 18
	        			)
	        		),
	        		'third' => array(
	        			'3eme commentaire', 
	        			array(
	        				'author' => 'Cindy',
	        				 'age' => 29
	        			)
	        		)
	        	)
	        )
        );
    }

    /**
     * @Route("/onglet2/{id}", name="page_image", requirements={"id": "[0-9]+"})
     */
    public function onglet2Action(Request $request, $id = null)
    {
        // if(!$id) {
        //     throw $this->createNotFoundException();
        // }
    	
        // if(empty($id) || $id > 2){
        //     throw new \Exception("Erreur : l'id indiqué est incorrect");
        // }

        //return $this->redirect('http://google.com');
        //return $this->redirectToRoute('main');

        // $response = new Response('<h1>Salut la compagnie !</h1>');
        // $response->setStatusCode(500);
        // return $response;
        //$session = $request->getSession();
        //$session->set('name', 'coucou');

        //$idSession = $request->cookies->get('PHPSESSID');
        //$addr = $request->server->get('REMOTE_ADDR');

        //$browser = $request->headers->get('user-Agent');
        //var_dump($request->getMethod());
        //die();

        return $this->render('BlogBundle:Default:content2.html.twig', array(
    		'menuActif' => 2,
            'id' => $id
    	));
    }
}
