<?php 

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

return function (): ArrayNodeDefinition {

$builder = new TreeBuilder('tags');
$node = $builder->getRootNode();

$node
    ->info("xxx.")
    ->addDefaultsIfNotSet()->children()

        // ->arrayNode('list')
        // ->addDefaultsIfNotSet()->children()

            ->scalarNode('template')
                ->info("xxx.")
                ->defaultValue('blog/authors/index.html.twig')
            ->end()

            ->scalarNode('entity')
                ->info("xxx.")
                ->defaultNull()
            ->end()

        // ->end()->end()
        
    ->end();

    return $node;
};