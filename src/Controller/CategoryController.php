<?php

namespace OSW3\Blog\Controller;

use OSW3\Blog\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use OSW3\Blog\DependencyInjection\Configuration;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

#[Route('/', name: 'category:')]
final class CategoryController extends AbstractController
{
    private array $config;

    public function __construct(
        private ParameterBagInterface $params
    ){
        $this->config = $params->get(Configuration::NAME)['categories'];
    }
    
    #[Route('/category', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {        
        return $this->render($this->config['template'], [
            'categories' => $categoryRepository->findAll(),
        ]);
    }
}
