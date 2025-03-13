<?php

namespace OSW3\Blog\Controller;

use OSW3\Blog\Entity\Post;
use OSW3\Blog\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use OSW3\Blog\DependencyInjection\Configuration;
use OSW3\Blog\Service\PostService;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/', name: 'post:')]
final class BlogController extends AbstractController
{
    private array $config;

    public function __construct(
        private ParameterBagInterface $params
    ){
        $this->config = $params->get(Configuration::NAME)['posts'];
    }

    #[Route('/posts', name: 'index', methods: ['HEAD', 'GET'])]
    public function index(PostService $postService): Response
    {
        $posts = $postService->getPaged();
        $total = $postService->count();
        $pages = $postService->getPages();

        return $this->render($this->config['index']['template'], [
            'posts' => $posts,
            'total' => $total,
            'pages' => $pages,
        ]);
    }

    #[Route('/post/{id}', name: 'single', methods: ['HEAD', 'GET'])]
    public function single(Post $post, PostService $postService): Response
    {
        $postService->updateOpenCounter($post);
        
        return $this->render($this->config['single']['template'], [
            'post' => $post
        ]);
    }

    #[Route('/post/r/{id}', name: 'update-read-counter', methods:['POST'])]
    public function reading(Post $post, PostService $postService): JsonResponse
    {
        $postService->updateReadCounter($post);

        return $this->json([]);
    }

    #[Route('/post/u/{id}', name: 'upvote', methods:['POST'])]
    public function upvote(Post $post, PostService $postService): JsonResponse
    {
        return $this->json($postService->addVote($post, 'upvote'));
    }

    #[Route('/post/d/{id}', name: 'downvote', methods:['POST'])]
    public function downvote(Post $post, PostService $postService): JsonResponse
    {
        return $this->json($postService->addVote($post, 'downvote'));
    }
}
