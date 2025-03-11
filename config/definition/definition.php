<?php 

return static function($definition)
{
    $definition->rootNode()->children()
        // Post list template
        // Post list per page
        // Post single template
        // Is comment allowed (default for all post / override on post create )
        // Post default state
        // Author entity
    ->end();
};