<?php

namespace OSW3\Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use OSW3\Media\Trait\Entity\MediaTrait;
use OSW3\Blog\Repository\MediaRepository;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
#[ORM\Table(name: 'blog_media')]
class Media
{
    use MediaTrait;
}
