<?php 
namespace OSW3\Blog\Twig\Runtime;

use Twig\Extension\RuntimeExtensionInterface;
use OSW3\Blog\Service\BlogService;
use Twig\Environment;

class AdminExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct(
        private BlogService $blogService,
        private Environment $environment
    ){}

    public function getAdmin()
    {
        return $this->environment->render("@Blog/admin/index.html.twig");
    }
}