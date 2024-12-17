<?php

namespace OSW3\Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use OSW3\Blog\Repository\TagRepository;
use OSW3\Blog\Trait\Entity\Properties\Color\Nullable\ColorTrait;
use OSW3\Blog\Trait\Entity\Properties\Description\Nullable\DescriptionTrait;
use OSW3\Blog\Trait\Entity\Properties\Id\IdTrait;
use OSW3\Blog\Trait\Entity\Properties\Name\NameTrait;
use OSW3\Blog\Trait\Entity\Properties\Slug\SlugTrait;

#[ORM\Entity(repositoryClass: TagRepository::class)]
#[ORM\Table(name: 'blog_tag')]
class Tag
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
