<?php

namespace BlogBundle\Controller;

use BlogBundle\BlogBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BlogBundle\Entity\Category;
use BlogBundle\Entity\Post;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    private $router;

    public function indexAction(Request $request)
    {

        $task = new Category();
        $task->setName('testCategory');
        $task->setDescription('testDescription');
        

        $form = $this->createFormBuilder($task)
            ->add('Name', TextType::class)
            ->add('Description', TextareaType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Category'))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('category_success');
        }
        return $this->render('BlogBundle:Default:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param $productId
     *
     *
     */
    public function showAction($productId = 1)
    {
        $product = $this->getDoctrine()
            ->getRepository('BlogBundle:Post')
            ->find($productId);
        dump($product); die();
        $categoryName = $product->getCategory()->getName();

        dump($categoryName);
        die();
    }

    public function createAction()
    {
        $category = new Category();
        $category->setName('Computer Peripherals');
        $category->setDescription('test category description');
        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->flush();

        $post = new Post();
        $post->setTitle('testTitle');
        $post->setDescription('sdfsdfsadfa');
        $post->setStatus(1);
        $post->setAuthorId(1);
        $post->setContent('sdfasdfasfsadfasfdasfacfwedfrw');
        $post->setCreateAt(new \DateTime('now'));
        $post->setPublicAt(new \DateTime('now'));
        $post->setSlug('sdfsf'.rand(0, 9999));
        $post->setUpdateAt(new \DateTime('now'));

        // relate this product to the category
        $post->setCategory($category);

        $em = $this->getDoctrine()->getManager();
//        $em->persist($category);
        $em->persist($post);
//        dump($post);
//        die;
        $em->flush();


//        die;
        return new Response(
            'Saved new product with id: '.$post->getId()
            .' and new category with id: '.$category->getId()
        );
    }
}
