<?php 

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

return function (): ArrayNodeDefinition {

$builder = new TreeBuilder('posts');
$node = $builder->getRootNode();

$node
    ->info("xxx.")
    ->addDefaultsIfNotSet()->children()

        ->arrayNode('create')->addDefaultsIfNotSet()->children()

            ->scalarNode('state')
                ->info("xxx.")
                ->defaultValue('draft')
            ->end()

            ->booleanNode('comment_allowed')
                ->info("xxx.")
                ->defaultTrue()
            ->end()

        ->end()->end()

        ->arrayNode('index')->addDefaultsIfNotSet()->children()

            ->scalarNode('template')
                ->info("xxx.")
                ->defaultValue('blog/posts/index.html.twig')
            ->end()

            ->integerNode('per_page')
                ->info("xxx.")
                ->defaultValue(10)
            ->end()

        ->end()->end()


        ->arrayNode('single')->addDefaultsIfNotSet()->children()

            ->scalarNode('template')
                ->info("xxx.")
                ->defaultValue('blog/posts/single.html.twig')
            ->end()

        ->end()->end()
        
    ->end();

    return $node;
};