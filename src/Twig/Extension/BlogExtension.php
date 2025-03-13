<?php 
namespace OSW3\Blog\Twig\Extension;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use OSW3\Blog\DependencyInjection\Configuration;
use OSW3\Blog\Twig\Runtime\BlogExtensionRuntime;

class BlogExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction(Configuration::NAME."_vote", [BlogExtensionRuntime::class, 'vote'], ['is_safe' => ['html']]),
            new TwigFunction(Configuration::NAME."_read", [BlogExtensionRuntime::class, 'read'], ['is_safe' => ['html']]),
        ];
    }
}
