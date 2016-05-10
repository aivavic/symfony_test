<?php

namespace BlogBundle\Controller;

use BlogBundle\BlogBundle;
use BlogBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BlogBundle\Entity\Category;
use BlogBundle\Entity\Post;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{


    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('BlogBundle:Post');
        $posts = $repository->findAll();
        $title = 'Posts';
        return $this->render('BlogBundle:Post:index.html.twig', array(
            'posts' => $posts,
            'title' => $title
        ));
    }

    public function filterAction($filter)
    {
        dump($filter); die();
    }
    public function newAction(Request $request)
    {

        $post = new Category();
//        $post->setName('testCategory');
//        $post->setDescription('testDescription');
        
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('post_success');
        }
        
        return $this->render('BlogBundle:Post:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function successAction()
    {
        return $this->render('BlogBundle:Category:success.html.twig');
    }
}
