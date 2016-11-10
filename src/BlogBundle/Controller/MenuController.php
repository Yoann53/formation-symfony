<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MenuController extends Controller
{
    public function displayAction($numMenu)
    {
        return $this->render('BlogBundle:Menu:display.html.twig', array(
        	'menu' => array(
        		array('onglet1','main'),
        		array('onglet2','page_image'),
        		array('onglet3','posts'),
                array('onglet4','create-post')
        	),
        	'menuActif' => $numMenu
        ));
    }

}
