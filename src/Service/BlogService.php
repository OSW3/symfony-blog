<?php 
namespace OSW3\Blog\Service;

use OSW3\Blog\Entity\Post;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use OSW3\Blog\DependencyInjection\Configuration;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BlogService
{
    private array $params;
    private EntityRepository $repository;

    public function __construct(
        #[Autowire(service: 'service_container')] private ContainerInterface $container,
        private EntityManagerInterface $entityManager
    )
    {
        $this->params = $container->getParameter(Configuration::NAME);
        $this->repository = $this->entityManager->getRepository(Post::class);
    }

    public function getAll(): array
    {
        return $this->repository->findAll();
    }
}