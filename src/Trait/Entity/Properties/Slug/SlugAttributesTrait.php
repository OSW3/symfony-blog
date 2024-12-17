<?php 
namespace OSW3\Blog\Trait\Entity\Properties\Slug;

use Doctrine\DBAL\Types\Types;

trait SlugAttributesTrait
{
    const SLUG_SERIALIZER_GROUP = "slug";
    const SLUG_ATTRIBUTE_NAME   = "slug";
    const SLUG_ATTRIBUTE_TYPE   = Types::STRING;
}