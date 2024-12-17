<?php 
namespace OSW3\Blog\Twig\Runtime;

use Twig\Extension\RuntimeExtensionInterface;
use OSW3\Blog\Service\BlogService;

class BaseExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct(
        private BlogService $blogService
    ){}

    /**
     * @see BlogService::getAll()
     * 
     * @return array
     */
    public function getAll(): array
    {
        return $this->blogService->getAll();
    }
}