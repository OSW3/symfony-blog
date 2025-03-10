<?php 
namespace OSW3\Blog\Trait\Entity;

use OSW3\Blog\Trait\Entity\Properties\Id\IdTrait;
use OSW3\Blog\Trait\Entity\Properties\Name\NameTrait;
use OSW3\Blog\Trait\Entity\Properties\Slug\SlugTrait;
use OSW3\Blog\Trait\Entity\Properties\Color\Nullable\ColorTrait;
use OSW3\Blog\Trait\Entity\Properties\Description\Nullable\DescriptionTrait;

trait CategoryTrait
{
    use IdTrait;
    use SlugTrait;
    use NameTrait;
    use DescriptionTrait;
    use ColorTrait;

    const SLUG_ATTRIBUTES = [
        'properties' => ['name'],
        'length' => 120
    ];

    const NAME_ATTRIBUTES = [
        'length' => 120
    ];
}