<?php 

return static function($definition)
{
    $definition->rootNode()->children()

        ->append( (include __DIR__."/parts/authors.php")() )
        ->append( (include __DIR__."/parts/categories.php")() )
        ->append( (include __DIR__."/parts/posts.php")() )
        ->append( (include __DIR__."/parts/tags.php")() )

    ->end();
};