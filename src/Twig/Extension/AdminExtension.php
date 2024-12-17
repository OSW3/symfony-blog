<?php 
namespace OSW3\Blog\Twig\Extension;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use OSW3\Blog\DependencyInjection\Configuration;
use OSW3\Blog\Twig\Runtime\AdminExtensionRuntime;

class AdminExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction(Configuration::NAME."_get_admin", [AdminExtensionRuntime::class, 'getAdmin']),
        ];
    }
}
