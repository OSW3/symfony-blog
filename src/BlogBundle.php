<?php 
namespace OSW3\Blog;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use OSW3\Blog\DependencyInjection\Configuration;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class BlogBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        $projectDir = $container->getParameter('kernel.project_dir');


        // Generate the YAML bundle configuration file in the project
        // --
        
        (new Configuration)->generateProjectConfig($projectDir);
    }
}