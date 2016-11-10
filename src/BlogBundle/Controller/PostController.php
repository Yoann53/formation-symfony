<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use BlogBundle\Entity\Post;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


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
    	$favoritePosts = $repository->findBy(
    		array(),
    		array(
    			'created' => 'DESC'
    		), 2);

    	$query = $em->createQuery("
    		SELECT p 
    		FROM BlogBundle:Post p
    		WHERE p.created LIKE :date_create
    		ORDER BY p.created DESC"
    	)->setParameter('date_create', '2016-11-09%');

        //$specialPosts = $query->getResult();

    	$qb = $em->createQueryBuilder();
        $qb->select('p');
        $qb->from('BlogBundle:Post', 'p');
        $qb->where(
            $qb->expr()->like('p.created', ':date_create')
        );
    	$qb->orderBy('p.created', 'DESC');
        $qb->setParameter('date_create', '2016-11-09%');

    	$specialPosts = $qb->getQuery()->getResult();

        //Insertion de nouveaux posts
        /*
        $tabValeur = array(
            array(
                'title' => 'Salut la compagnie',
                'content' => '1er Exemple de contenu de la mort qui tue.'
            ),array(
                'title' => 'Salut les copains',
                'content' => '2ème Exemple de contenu de la mort qui tue.'
            ),array(
                'title' => 'Salut les filles',
                'content' => '3ème Exemple de contenu de la mort qui tue.'
            )
        );
        */

        /*
        foreach ($tabValeur as $data) {
            $post = new Post();
            $post->setTitle($data['title']);
            $post->setContent($data['content']);
            */  
            /* 
             * Instruction permettant d'ajouter un objet, à la liste des objets à 
             * persister par l'entity manager (Aucune requête en bdd n'est exécuté 
             * pour le moment).
             */
            /*
            $em->persist($post);  
        }
        */

        /* Instruction permettant de persister (enregistrer) tous les objets présents 
         * dans la liste des objets à persister. L'ORM va effectuer autant d'insert que 
         * d'objets à persister
         */
        //$em->flush();

        return $this->render('BlogBundle:Post:index.html.twig', array(
        	'menuActif' => 3,
        	'posts' => $posts,
        	'favorite_posts' => $favoritePosts,
        	'special_posts' => $specialPosts
        ));
    }

    /**
     * @Route("/onglet4", name="create-post")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $post = new Post();

        $form = $this->createFormBuilder($post)
            ->add('title', TextType::class, array('label' => 'Titre', 'required' => false))
            ->add('content', TextareaType::class, array('label' => 'Contenu', 'required' => false))
            ->add('save', SubmitType::class, array('label' => 'Enregistrer'))
            ->getForm();

        // Permet à l'objet form de prendre en compte la request renvoyée lors de la soumission de notre formulaire
        $form->handleRequest($request);

        //Vérifie si le formulaire à bien été renvoyé (vérifie les paramètres POST dans l'objet $request)
        if($form->isSubmitted()) {
            //Vérifie si tous les champs renvoyés sont valides
            if($form->isValid()) {
                $hydratedPost = $form->getData();

                $em->persist($hydratedPost);
                $em->flush();
            }
        }



        return $this->render('BlogBundle:Post:new.html.twig', array(
            'menuActif' => 4,
            'form' => $form->createView()
        ));

    }

}
