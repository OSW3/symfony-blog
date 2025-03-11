<?php

namespace OSW3\Blog\Controller;

use OSW3\Blog\Repository\TagRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use OSW3\Blog\DependencyInjection\Configuration;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

#[Route('/', name: 'tag:')]
final class TagController extends AbstractController
{
    private array $config;

    public function __construct(
        private ParameterBagInterface $params
    ){
        $this->config = $params->get(Configuration::NAME)['tags'];
    }
    
    #[Route('/tag', name: 'index')]
    public function index(TagRepository $tagRepository): Response
    {
        return $this->render($this->config['template'], [
            'tags' => $tagRepository->findAll(),
        ]);
    }
}
