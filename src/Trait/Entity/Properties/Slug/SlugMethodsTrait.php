<?php 
namespace OSW3\Blog\Trait\Entity\Properties\Slug;

trait SlugMethodsTrait
{
    public function getSlug(): string
    {
        return $this->slug;
    }
}