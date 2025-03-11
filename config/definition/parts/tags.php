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
                ->defaultValue('blog/tags/index.html.twig')
            ->end()

            // ->integerNode('per_page')
            //     ->info("xxx.")
            //     ->defaultValue(10)
            // ->end()

        // ->end()->end()
        
    ->end();

    return $node;
};