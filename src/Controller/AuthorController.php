<?php

namespace OSW3\Blog\Controller;

use OSW3\Blog\Repository\AuthorRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use OSW3\Blog\DependencyInjection\Configuration;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

#[Route('/', name: 'author:')]
final class AuthorController extends AbstractController
{
    private array $config;

    public function __construct(
        private ParameterBagInterface $params
    ){
        $this->config = $params->get(Configuration::NAME)['authors'];
    }
    
    #[Route('/author', name: 'index')]
    public function index(AuthorRepository $authorRepository): Response
    {
        return $this->render($this->config['template'], [
            'authors' => $authorRepository->findAll(),
        ]);
    }
}
